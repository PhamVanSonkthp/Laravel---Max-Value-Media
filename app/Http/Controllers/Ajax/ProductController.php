<?php

namespace App\Http\Controllers\Ajax;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeOption;
use App\Models\ProductAttributeOptionSKU;
use App\Models\ProductSKU;
use App\Traits\BaseControllerTrait;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function redirect;
use function view;

class ProductController extends Controller
{
    use BaseControllerTrait;

    public function __construct(Product $model)
    {
        $this->initBaseModel($model);
        $categories = Category::all();
        $this->shareBaseModel($model);
        View::share('categories', $categories);
    }

    public function search(Request $request)
    {
        $results = $this->model->search($request);

        $html = View::make('administrator.orders.result_search', compact('results'))->render();

        $results = $results->toArray();

        $results['search_query'] = $request->search_query;
        $results['html'] = $html;


        return response()->json($results);
    }

    public function index(Request $request)
    {
        $query = $this->model->searchByQuery($request, ['product_visibility_id' => 2], null, null, true);

        if (isset($request->min_inventory) && strlen($request->min_inventory)) {
            $query = $query->where('inventory', '>=', $request->min_inventory);
        }

        if (isset($request->min_inventory) && strlen($request->min_inventory)) {
            $query = $query->where('inventory', '<=', $request->max_inventory);
        }

        $items = $query->latest()->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        return view('administrator.' . $this->prefixView . '.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        return view('administrator.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {

        $product = $this->model->create([
            'name' => $request->name,
            'slug' => $request->name,
            'description' => $request->description,
            'is_variant' => $request->is_variant,
        ]);


        if (!$request->is_variant) {
            ProductSKU::create([
                'product_id' => $product->id,
                'sku' => $request->sku,
                'price' => Formatter::formatNumberToDatabase($request->price),
                'price_import' => Formatter::formatNumberToDatabase($request->price_import),
                'price_agent' => Formatter::formatNumberToDatabase($request->price_agent),
                'price_partner' => Formatter::formatNumberToDatabase($request->price_partner),
                'inventory' => Formatter::formatNumberToDatabase($request->inventory),
            ]);
        } else {
            $header1 = $request->header_vari_1;
            $header2 = $request->header_vari_2;
            $values1 = $request->values_1;
            $values2 = $request->values_2;

            if (is_array($values1)) {
                $values1 = array_filter($values1);
            } else {
                $values1 = [];
            }


            if (is_array($values2)) {
                $values2 = array_filter($values2);
            } else {
                $values2 = [];
            }

            $productAttribute1 = ProductAttribute::create([
                'name' => $header1
            ]);

            if ($header2 && count($values2) > 0) {
                $productAttribute2 = ProductAttribute::create([
                    'name' => $header2
                ]);

                $index = 0;

                foreach ($values1 as $index1 => $value1) {
                    foreach ($values2 as $index2 => $value2) {
                        $productAttributeOption1 = ProductAttributeOption::create([
                            'attribute_id' => $productAttribute1->id,
                            'value' => $value1,
                        ]);

                        $productAttributeOption2 = ProductAttributeOption::create([
                            'attribute_id' => $productAttribute2->id,
                            'value' => $value2,
                        ]);

                        $productSKU = ProductSKU::create([
                            'product_id' => $product->id,
                            'sku' => $request->skus[$index],
                            'price' => Formatter::formatNumberToDatabase($request->prices[$index]),
                            'inventory' => Formatter::formatNumberToDatabase($request->inventories[$index]),
                        ]);

                        ProductAttributeOptionSKU::create([
                            'sku_id' => $productSKU->id,
                            'product_attribute_option_id' => $productAttributeOption1->id,
                        ]);

                        ProductAttributeOptionSKU::create([
                            'sku_id' => $productSKU->id,
                            'product_attribute_option_id' => $productAttributeOption2->id,
                        ]);

                        $index++;
                    }
                }
            } else {
                foreach ($values1 as $index => $value) {
                    $productAttributeOption = ProductAttributeOption::create([
                        'attribute_id' => $productAttribute1->id,
                        'value' => $value,
                    ]);

                    $productSKU = ProductSKU::create([
                        'product_id' => $product->id,
                        'sku' => $request->skus[$index],
                        'price' => Formatter::formatNumberToDatabase($request->prices[$index]),
                        'inventory' => Formatter::formatNumberToDatabase($request->inventories[$index]),
                    ]);

                    ProductAttributeOptionSKU::create([
                        'sku_id' => $productSKU->id,
                        'product_attribute_option_id' => $productAttributeOption->id,
                    ]);
                }
            }
        }

        return response()->json($product);
    }

    public function edit($id)
    {
        $item = $this->model->find($id);
        return view('administrator.' . $this->prefixView . '.edit', compact('item'));
    }

    public function update(Request $request)
    {
        $item = $this->model->find($request->id);

        if (!empty($item)) {
            $dataUpdate = [];

            if (isset($request->inventory) && $request->inventory != "") {
                $dataUpdate['inventory'] = Formatter::formatNumberToDatabase($request->inventory);
            }
            if (isset($request->price_client) && $request->price_client != "") {
                $dataUpdate['price_client'] = Formatter::formatNumberToDatabase($request->price_client);
            }
            if (isset($request->price_agent) && $request->price_agent != "") {
                $dataUpdate['price_agent'] = Formatter::formatNumberToDatabase($request->price_agent);
            }
            if (isset($request->price_partner) && $request->price_partner != "") {
                $dataUpdate['price_partner'] = Formatter::formatNumberToDatabase($request->price_partner);
            }
            if (isset($request->is_feature) && $request->is_feature != "") {
                $dataUpdate['is_feature'] = Formatter::formatNumberToDatabase($request->is_feature);
            }

            $item->update($dataUpdate);
        }

        return response()->json([
            'a' => $item,
            'b' => $request->inventory,
            'c' => $request->id,
        ]);
    }

    public function updateV2(Request $request)
    {
        $product = $this->model->findOrFail($request->product_id);

        $product->skus()->delete();

        $product->is_variant = $request->is_variant;
        $product->save();

        if ($request->is_variant == 1) {
            $header1 = $request->header_vari_1;
            $header2 = $request->header_vari_2;
            $values1 = $request->values_1;
            $values2 = $request->values_2;

            if (is_array($values1)) {
                $values1 = array_filter($values1);
            } else {
                $values1 = [];
            }


            if (is_array($values2)) {
                $values2 = array_filter($values2);
            } else {
                $values2 = [];
            }

            $productAttribute1 = ProductAttribute::create([
                'name' => $header1
            ]);

            if ($header2 && count($values2) > 0) {
                $productAttribute2 = ProductAttribute::create([
                    'name' => $header2
                ]);

                $index = 0;

                foreach ($values1 as $index1 => $value1) {
                    foreach ($values2 as $index2 => $value2) {
                        $productAttributeOption1 = ProductAttributeOption::create([
                            'attribute_id' => $productAttribute1->id,
                            'value' => $value1,
                        ]);

                        $productAttributeOption2 = ProductAttributeOption::create([
                            'attribute_id' => $productAttribute2->id,
                            'value' => $value2,
                        ]);

                        $productSKU = ProductSKU::create([
                            'product_id' => $product->id,
                            'sku' => $request->skus[$index],
                            'price' => Formatter::formatNumberToDatabase($request->prices[$index]),
                            'inventory' => Formatter::formatNumberToDatabase($request->inventories[$index]),
                        ]);

                        ProductAttributeOptionSKU::create([
                            'sku_id' => $productSKU->id,
                            'product_attribute_option_id' => $productAttributeOption1->id,
                        ]);

                        ProductAttributeOptionSKU::create([
                            'sku_id' => $productSKU->id,
                            'product_attribute_option_id' => $productAttributeOption2->id,
                        ]);

                        $index++;
                    }
                }
            } else {
                foreach ($values1 as $index => $value) {
                    $productAttributeOption = ProductAttributeOption::create([
                        'attribute_id' => $productAttribute1->id,
                        'value' => $value,
                    ]);

                    $productSKU = ProductSKU::create([
                        'product_id' => $product->id,
                        'sku' => $request->skus[$index],
                        'price' => Formatter::formatNumberToDatabase($request->prices[$index]),
                        'inventory' => Formatter::formatNumberToDatabase($request->inventories[$index]),
                    ]);

                    ProductAttributeOptionSKU::create([
                        'sku_id' => $productSKU->id,
                        'product_attribute_option_id' => $productAttributeOption->id,
                    ]);
                }
            }
        } else {
            ProductSKU::create([
                'product_id' => $product->id,
                'sku' => $request->sku,
                'price' => Formatter::formatNumberToDatabase($request->price),
                'inventory' => Formatter::formatNumberToDatabase($request->inventory),
            ]);
        }

        return response()->json([
            'message' => 'ok'
        ]);
    }

    public function delete(Request $request, $id)
    {
        return $this->model->deleteByQuery($request, $id, $this->forceDelete);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function import(Request $request)
    {
        set_time_limit(36000);

        $path = storage_path() . '/app/' . request()->file('import_file')->store('tmp');


        $reader = ReaderEntityFactory::createReaderFromFile($path);

        $reader->open($path);

        $slug = "";
        $name = "";
        $category = "";
        $description = "";
        $group_product_id = 2;
        $images = [];
        $products = [];

        $productAdded = 0;

        $tmpProduct = Product::latest()->first();

        if (!empty($tmpProduct)) {
            $group_product_id = $tmpProduct->group_product_id;
            $group_product_id++;
        }

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $index => $row) {
                if ($index > 1) {
                    $cells = $row->getCells();

                    if (count($cells) == 0 || $cells[0]->getValue() == "") {
                        return response()->json($productAdded);
                    }

                    $images[] = [
                        'path' => Formatter::trimer($cells[23]->getValue()),
                        'name' => Formatter::trimer($cells[24]->getValue()),
                    ];

                    if ($cells[18]->getValue() == "") {
                        continue;
                    }

                    $item = [];
                    $item['slug'] = Formatter::trimer($cells[0]->getValue());

                    $item['name'] = Formatter::trimer($cells[1]->getValue());
                    if (empty($item['name'])) {
                        $item['name'] = $name;
                    } else {
                        $name = $item['name'];
                    }

                    $item['category_id'] = Formatter::trimer($cells[4]->getValue());
                    if (empty($item['category_id'])) {
                        $item['category_id'] = $category;
                    } else {
                        $category = $item['category_id'];
                    }

                    if (!empty($category)) {
                        $itemCategory = Category::firstOrCreate([
                            'name' => $category
                        ], [
                            'name' => $category,
                            'slug' => Helper::addSlug(new Category, 'slug', $category),
                        ]);
                        $item['category_id'] = $itemCategory->id;
                    } else {
                        $item['category_id'] = 0;
                    }

                    $item['description'] = Formatter::trimer($cells[2]->getValue());
                    if (empty($item['description'])) {
                        $item['description'] = $description;
                    } else {
                        $description = $item['description'];
                    }

                    $shortDescription = Formatter::getShortDescriptionAttribute($description, 30);

                    $item['short_description'] = $shortDescription;
                    $item['product_visibility_id'] = Formatter::trimer($cells[6]->getValue()) == 'TRUE' ? 2 : 1;
                    $item['sku'] = Formatter::trimer($cells[13]->getValue());
                    $item['inventory'] = Formatter::formatNumberToDatabase(Formatter::trimer($cells[15]->getValue()));
                    $item['product_buy_empty_id'] = Formatter::trimer($cells[16]->getValue()) == 'continue' ? 2 : 1;
                    $item['price_import'] = Formatter::formatNumberToDatabase(Formatter::trimer($cells[18]->getValue()));
                    $item['price_client'] = Formatter::formatNumberToDatabase(Formatter::trimer($cells[18]->getValue()));
                    $item['price_agent'] = Formatter::formatNumberToDatabase(Formatter::trimer($cells[18]->getValue()));
                    $item['price_partner'] = Formatter::formatNumberToDatabase(Formatter::trimer($cells[18]->getValue()));
                    $item['request_devilvery_id'] = Formatter::trimer($cells[20]->getValue()) == 'TRUE' ? 2 : 1;
                    $item['bar_code'] = Formatter::trimer($cells[22]->getValue());
                    $item['feature_image_path'] = Formatter::trimer($cells[23]->getValue());
                    $item['seo_title'] = Formatter::trimer($cells[25]->getValue());
                    $item['seo_description'] = Formatter::trimer($cells[26]->getValue());
                    $item['weight'] = Formatter::trimer($cells[27]->getValue());
                    $item['type_weight'] = Formatter::trimer($cells[28]->getValue());

                    if ($item['slug'] != $slug) {
                        $slug = Formatter::trimer($cells[0]->getValue());

                        foreach ($products as $productItem) {
                            foreach ($images as $itemImage) {
                                Image::create([
                                    'uuid' => Helper::randomString(),
                                    'table' => 'products',
                                    'image_path' => $itemImage['path'],
                                    'image_name' => $itemImage['name'],
                                    'relate_id' => $productItem->id,
                                ]);
                            }
                        }
                        $products = [];
                        $images = [];
                        $group_product_id++;
                    }

                    $item['group_product_id'] = $group_product_id;

                    $product = Product::create($item);

                    $products[] = $product;

                    $attr1 = Formatter::trimer($cells[8]->getValue());
                    $attr2 = Formatter::trimer($cells[10]->getValue());

                    $attr = [];

                    if (!empty($attr1)) {
                        $attr['size'] = $attr1;
                    }

                    if (!empty($attr2)) {
                        $attr['color'] = $attr2;
                    }
                    $product->fill($attr)->save();

                    $productAdded++;
                }
            }
        }

        return response()->json($productAdded);
    }

    function renderTableVari(Request $request)
    {
        $product = null;

        if (!empty($request->product_id)) {
            $product = Product::findOrFail($request->product_id);
        }

        $header1 = $request->header_vari_1;
        $header2 = $request->header_vari_2;
        $values1 = $request->values_1;
        $values2 = $request->values_2;
        $atrributes_id_vari_1 = $request->atrributes_id_vari_1;
        $atrributes_id_vari_2 = $request->atrributes_id_vari_2;

        $productSKUs1 = [];
        $productSKUs2 = [];


        if (is_array($values1)) {
            $values1 = array_filter($values1);

            if (is_array($atrributes_id_vari_1)) {
                foreach ($atrributes_id_vari_1 as $index => $atrribute_id_vari_1) {
                    if (count($values1) > $index) {
                        $productAttributeOption = ProductAttributeOption::find($atrribute_id_vari_1);
                        $productSKUs1[] = optional($productAttributeOption)->productSKU();
                    }
                }
            }
        } else {
            $values1 = [];
        }


        if (is_array($values2)) {
            $values2 = array_filter($values2);

            if (is_array($atrributes_id_vari_2)) {
                foreach ($atrributes_id_vari_2 as $index => $atrribute_id_vari_2) {
                    if (count($values2) > $index) {
                        $productAttributeOption = ProductAttributeOption::find($atrribute_id_vari_2);
                        $productSKUs2[] = optional($productAttributeOption)->productSKU();
                    }
                }
            }
        } else {
            $values2 = [];
        }

        $indexSKU = 0;

        $productSKUs = [];

        if (!empty($product)) {
            $productSKUs = $product->skus->toArray();
        }

        if (count($productSKUs) > 1) {
            $array1 = array_slice($productSKUs, 0, count($productSKUs) / 2);
            $array2 = array_slice($productSKUs, count($productSKUs) / 2, count($productSKUs) / 2);

            while (count($array1) < (count($productSKUs1) * count($productSKUs2)) / 2) {
                $array1[] = null;
            }

            while (count($array2) < (count($productSKUs1) * count($productSKUs2)) / 2) {
                $array2[] = null;
            }

            $productSKUs = array_merge($array1, $array2);
        }

        $html = View::make(
            'administrator.products.table_vari',
            compact(
                'header1',
                'header2',
                'values1',
                'values2',
                'product',
                'atrributes_id_vari_1',
                'atrributes_id_vari_2',
                'productSKUs1',
                'productSKUs2',
                'indexSKU',
                'productSKUs'
            )
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    function renderContainerInventory(Request $request)
    {
        $product = $this->model->findOrFail($request->id);

        $html = View::make(
            'administrator.products.container_inventory',
            compact(
                'product'
            )
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    function renderContainerPrice(Request $request)
    {
        $product = $this->model->findOrFail($request->id);

        $html = View::make(
            'administrator.products.container_price',
            compact(
                'product'
            )
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    function updateInventory(Request $request)
    {

        $item = $this->model->findOrFail($request->product_id);

        foreach ($request->skus as $index => $sku) {
            $productSKU = ProductSKU::find($sku);
            if (!empty($productSKU)) {
                $productSKU->inventory = Formatter::formatNumberToDatabase($request->values[$index]);
                $productSKU->save();
            }
        }

        $html = View::make('administrator.products.row', ['item' => $item, 'index' => $request->index])->render();

        return response()->json([
            'html' => $html
        ]);
    }

    function updatePrice(Request $request)
    {

        $item = $this->model->findOrFail($request->product_id);

        foreach ($request->skus as $index => $sku) {
            $productSKU = ProductSKU::find($sku);
            if (!empty($productSKU)) {
                $productSKU->price = Formatter::formatNumberToDatabase($request->values[$index]);
                $productSKU->save();
            }
        }

        $html = View::make('administrator.products.row', ['item' => $item, 'index' => $request->index])->render();

        return response()->json([
            'html' => $html
        ]);
    }
}
