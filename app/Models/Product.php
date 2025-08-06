<?php

namespace App\Models;

use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use DeleteModelTrait;
    use StorageImageTrait;
    use SoftDeletes;

    protected $searchable = [
        'name'
    ];

    protected $guarded = [];

    // begin

    public function textRangePrice()
    {
        $skus = $this->skus->pluck('price')->toArray();

        if (count($skus) == 0) {
            return "";
        }
        if (count($skus) == 1) {
            return Formatter::formatMoney($skus[0]);
        }

        $min = min($skus);
        $max = max($skus);

        if ($min != $max) {
            return Formatter::formatMoney($min) . " - " . Formatter::formatMoney($max);
        }

        return Formatter::formatMoney($min);
    }

    public function numberSell()
    {
        $skus = $this->skus;

        $counter = 0;
        foreach ($skus as $sku) {
            $counter += $sku->sell;
        }
        return $counter;
    }

    public function numberInventory()
    {
        $skus = $this->skus;

        $counter = 0;
        foreach ($skus as $sku) {
            $counter += $sku->inventory;
        }
        return $counter;
    }

    public function skus()
    {
        return $this->hasMany(ProductSKU::class);
    }

    public function attributeOptions($attribute_id = null)
    {
        $attributeOptions = [];

        $skus = $this->skus;

        foreach ($skus as $sku) {
            $attributeOptionSKUs = $sku->productAttributeOptionSKUs;

            foreach ($attributeOptionSKUs as $attributeOptionSKU) {
                $attributeOptionNew = $attributeOptionSKU->productAttributeOption;

                if ($attributeOptionNew) {
                    if ($attribute_id) {
                        if ($attributeOptionNew->attribute_id != $attribute_id) {
                            continue;
                        }
                    }

                    $isNew = true;
                    foreach ($attributeOptions as $attributeOption) {
                        if ($attributeOption->value == $attributeOptionNew->value) {
                            $isNew = false;
                            break;
                        }
                    }

                    if ($isNew) {
                        $attributeOptions[] = $attributeOptionNew;
                    }
                }
            }
        }


        return $attributeOptions;
    }

    public function attributes()
    {
        $attributes = [];

        $skus = $this->skus;

        foreach ($skus as $sku) {
            $attributeOptionSKUs = $sku->productAttributeOptionSKUs;

            foreach ($attributeOptionSKUs as $attributeOptionSKU) {
                $attributeOption = $attributeOptionSKU->productAttributeOption;

                if ($attributeOption) {
                    $attributeNew = $attributeOption->productAttribute;

                    if ($attributeNew) {
                        $isNew = true;
                        foreach ($attributes as $attribute) {
                            if ($attribute->id == $attributeNew->id) {
                                $isNew = false;
                                break;
                            }
                        }

                        if ($isNew) {
                            $attributes[] = $attributeNew;
                        }
                    }
                }
            }
        }

        return $attributes;
    }

    public function parent()
    {
        $item = $this->hasOne(Product::class, 'group_product_id', 'group_product_id')->where('product_visibility_id', 2);

        if (empty($item)) {
            return $this;
        }

        return $item;
    }

    public function isProductVariation()
    {
        return false;
    }

    public static function search($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {

        $results = Product::query();

        if (isset($request->category_id) && !empty($request->category_id)) {
            $results = $results->where('category_id', $request->category_id);
        }

        if (!empty($request->search_query)) {
            $results = $results->where(function ($query) use ($request) {
                $words = explode(" ", $request->search_query);

                $query = $query->where(function ($results) use ($words) {
                    foreach ($words as $word) {
                        $results = $results->where('name', 'LIKE', "%{$word}%");
                    }
                });

                $query = $query->orWhere("name", "LIKE", "%{$request->search_query}%");

                $query = $query->orWhere(function ($results) use ($words) {
                    foreach ($words as $word) {
                        $results = $results->orWhere('name', 'LIKE', "%{$word}%");
                    }
                });
            });


            $words = explode(" ", $request->search_query);
            $sort1 = "";
            foreach ($words as $index => $word) {
                $sort1 .= "name LIKE '%{$word}%'";

                if ($index != count($words) - 1) {
                    $sort1 .= " AND ";
                }
            }

            $sort = "CASE WHEN name LIKE '%{$request->search_query}%' THEN 1 WHEN {$sort1} THEN 2 ELSE 3 END, name";

            $results = $results->orderByRaw($sort);
        }

        if (isset($request->sort_by_price)) {
            if ($request->sort_by_price == "asc") {
                $results = $results->orderBy('price_client', 'asc');
            } else if ($request->sort_by_price == "desc") {
                $results = $results->orderBy('price_client', 'DESC');
            }
        }

        if (!empty($request->is_feature)) {
            $results = $results->where('is_feature', $request->is_feature);
        }

        if (isset($request->is_best) && $request->is_best == 1) {
            $results = $results->orderBy('sold', 'DESC');
        } else {
            $results = $results->latest('updated_at');
        }

//        if (isset($request->min_inventory) && strlen($request->min_inventory)) {
//            $results = $results->where('inventory', '>=', $request->min_inventory);
//        }
//
//        if (isset($request->min_inventory) && strlen($request->min_inventory)) {
//            $results = $results->where('inventory', '<=', $request->max_inventory);
//        }

        if ($request->trash) {
            $results = $results->onlyTrashed();
        }

        $results = $results->latest('updated_at')->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        return $results;
    }

    public function star()
    {
        return 5;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['description'] = str_replace("src=\"/storage", "src=\"" . env('APP_URL') . "/storage", $array['description']);
        $array['description'] = str_replace("src=\"//bizweb", "src=\"" . "https://bizweb", $array['description']);
        $array['attributes'] = $this->attributes();
        $array['skus'] = $this->skus;

        $array['image_path_avatar'] = $this->avatar();
        $array['path_images'] = $this->images;

        $array['star'] = $this->star();
        $array['category'] = $this->category;

        return $array;
    }

    public function isEmptyInventory()
    {
        return $this->inventory <= 0;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    function firstOrCreateCategory($category_id)
    {
        if (!empty($category_id) && !is_numeric($category_id)) {
            $category = Category::firstOrCreate([
                'name' => $category_id,
            ], [
                'name' => $category_id,
                'slug' => Helper::addSlug($this, 'slug', $category_id),
            ]);

            return $category->id;
        }

        return $category_id ?? 0;
    }

    // end

    public function getTableName()
    {
        return Helper::getTableName($this);
    }

    public function avatar($size = "1000x1000")
    {
        return Helper::getDefaultIcon($this, $size);
    }

    public function image()
    {
        return Helper::image($this);
    }

    public function images()
    {
        return Helper::images($this);
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by_id');
    }

    public function searchByQuery($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }

    public function storeByQuery($request)
    {

        $group_product_id = 2;

        $productLatest = Product::latest()->first();

        if (!empty($productLatest)) {
            $group_product_id = $productLatest->id + 1;
        }

        $product_visibility_id = 2;

        if (isset($request->_headers) && isset($request->_attributes) && !empty($request->_headers) && !empty($request->_attributes)) {
            $_headers = json_decode($request->_headers);
            $_attributes = json_decode($request->_attributes);

            if (count($_headers) == 1) {
                for ($i = 0; $i < count($_attributes[0]); $i++) {
                    $dataInsert = [
                        'name' => $request->name,
                        'short_description' => $request->short_description,
                        'description' => $request->description,
                        'slug' => Helper::addSlug($this, 'slug', $request->name),
                        'price_import' => Formatter::formatMoneyToDatabase($request->import_prices[$i]),
                        'price_client' => Formatter::formatMoneyToDatabase($request->client_prices[$i]),
                        'price_agent' => Formatter::formatMoneyToDatabase($request->agent_prices[$i]),
                        'price_partner' => Formatter::formatMoneyToDatabase($request->partner_prices[$i]),
                        'category_id' => $this->firstOrCreateCategory($request->category_id),
                        'inventory' => Formatter::formatNumberToDatabase($request->inventories[$i]),
                        'sku' => $request->skus[$i],
                        'group_product_id' => $group_product_id,
                        'product_visibility_id' => $product_visibility_id,
                    ];

                    $product_visibility_id = 1;

                    $item = Helper::storeByQuery($this, $request, $dataInsert);

                    $attr = [];
                    $attr['size'] = $_attributes[0][$i];

                    $item->fill($attr)->save();
                }
            } else {
                $pointer = 0;

                for ($i = 0; $i < count($_attributes[0]); $i++) {
                    for ($j = 0; $j < count($_attributes[1]); $j++) {
                        $dataInsert = [
                            'name' => $request->name,
                            'short_description' => $request->short_description,
                            'description' => $request->description,
                            'slug' => Helper::addSlug($this, 'slug', $request->name),
                            'price_import' => Formatter::formatMoneyToDatabase($request->import_prices[$pointer]),
                            'price_client' => Formatter::formatMoneyToDatabase($request->client_prices[$pointer]),
                            'price_agent' => Formatter::formatMoneyToDatabase($request->agent_prices[$pointer]),
                            'price_partner' => Formatter::formatMoneyToDatabase($request->partner_prices[$pointer]),
                            'category_id' => $this->firstOrCreateCategory($request->category_id),
                            'inventory' => Formatter::formatNumberToDatabase($request->inventories[$pointer]),
                            'sku' => $request->skus[$pointer],
                            'group_product_id' => $group_product_id,
                            'product_visibility_id' => $product_visibility_id,
                        ];

                        $product_visibility_id = 1;

                        $item = Helper::storeByQuery($this, $request, $dataInsert);

                        $attr = [];
                        $attr['size'] = $_attributes[0][$i];
                        $attr['color'] = $_attributes[1][$j];

                        $item->fill($attr)->save();

                        $pointer++;
                    }
                }
            }
        } else {
            $dataInsert = [
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'slug' => Helper::addSlug($this, 'slug', $request->name),
                'price_import' => Formatter::formatMoneyToDatabase($request->price_import),
                'price_client' => Formatter::formatMoneyToDatabase($request->price_client),
                'price_agent' => Formatter::formatMoneyToDatabase($request->price_agent),
                'price_partner' => Formatter::formatMoneyToDatabase($request->price_partner),
                'category_id' => $this->firstOrCreateCategory($request->category_id),
                'inventory' => Formatter::formatNumberToDatabase($request->inventory),
                'product_visibility_id' => $product_visibility_id,
                'group_product_id' => $group_product_id,
                'sku' => $request->sku,
            ];

            $item = Helper::storeByQuery($this, $request, $dataInsert);

            return $this->findById($item->id);
        }
    }

    public function updateByQuery($request, $id)
    {
        $dataUpdate = [
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'slug' => Helper::addSlug($this, 'slug', $request->name, $id),
            'price_import' => Formatter::formatMoneyToDatabase($request->price_import),
            'price_client' => Formatter::formatMoneyToDatabase($request->price_client),
            'price_agent' => Formatter::formatMoneyToDatabase($request->price_agent),
            'price_partner' => Formatter::formatMoneyToDatabase($request->price_partner),
            'category_id' => $this->firstOrCreateCategory($request->category_id),
            'inventory' => Formatter::formatNumberToDatabase($request->inventory),
            'sku' => $request->sku,
            'is_feature' => $request->is_feature ?? 0,
        ];
        $item = Helper::updateByQuery($this, $request, $id, $dataUpdate);
        return $this->findById($item->id);
    }

    public function deleteByQuery($request, $id, $forceDelete = false)
    {
        return Helper::deleteByQuery($this, $request, $id, $forceDelete);
    }

    public function deleteManyByIds($request, $forceDelete = false)
    {
        return Helper::deleteManyByIds($this, $request, $forceDelete);
    }

    public function findById($id)
    {
        $item = $this->find($id);
        return $item;
    }
}
