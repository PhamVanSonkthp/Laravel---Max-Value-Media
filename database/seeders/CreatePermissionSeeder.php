<?php

namespace Database\Seeders;

use App\Models\Helper;
use App\Models\Permission;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(config('permissions.table_module') as $index => $module_item){
            $permision = Permission::firstOrCreate([
                'name' => $module_item,
                'display_name' => config('permissions.table_module_name')[$index],
                'parent_id' => 0,
            ]);

            Permission::firstOrCreate([
                'name' => 'list',
                'display_name' => 'list',
                'parent_id' => $permision->id,
                'key_code' => $module_item . '_' . 'list',
            ]);

            if ($index != 3){
                if ($index != 4){
                    Permission::firstOrCreate([
                        'name' => 'add',
                        'display_name' => 'add',
                        'parent_id' => $permision->id,
                        'key_code' => $module_item . '_' . 'add',
                    ]);

                    Permission::firstOrCreate([
                        'name' => 'delete',
                        'display_name' => 'delete',
                        'parent_id' => $permision->id,
                        'key_code' => $module_item . '_' . 'delete',
                    ]);
                }

                Permission::firstOrCreate([
                    'name' => 'edit',
                    'display_name' => 'edit',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'edit',
                ]);

            }


            if ($index == 2){

                Permission::firstOrCreate([
                    'name' => 'View zone',
                    'display_name' => 'list_zone',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_zone',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Add zone',
                    'display_name' => 'add_zone',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'add_zone',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Edit zone',
                    'display_name' => 'edit_zone',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'edit_zone',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Delete zone',
                    'display_name' => 'delete_zone',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'delete_zone',
                ]);
            }else if ($index == 3){

                Permission::firstOrCreate([
                    'name' => 'View demand',
                    'display_name' => 'list_demand',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_demand',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View website',
                    'display_name' => 'list_website',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_website',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View zone_website',
                    'display_name' => 'list_zone_website',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_zone_website',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View d_request',
                    'display_name' => 'list_d_request',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_d_request',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View d_impression',
                    'display_name' => 'list_d_impression',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_d_impression',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View d_impressions_us_uk',
                    'display_name' => 'list_d_impressions_us_uk',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_d_impressions_us_uk',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View d_fill_rate',
                    'display_name' => 'list_d_fill_rate',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_d_fill_rate',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View d_ecpm',
                    'display_name' => 'list_d_ecpm',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_d_ecpm',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View d_revenue',
                    'display_name' => 'list_d_revenue',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_d_revenue',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View count',
                    'display_name' => 'list_count',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_count',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View share',
                    'display_name' => 'list_share',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_share',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Edit count',
                    'display_name' => 'edit_count',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'edit_count',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Edit share',
                    'display_name' => 'edit_share',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'edit_share',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View p_impression',
                    'display_name' => 'list_p_impression',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_p_impression',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View p_ecpm',
                    'display_name' => 'list_p_ecpm',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_p_ecpm',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View p_revenue',
                    'display_name' => 'list_p_revenue',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_p_revenue',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View profit',
                    'display_name' => 'list_profit',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_profit',
                ]);

                Permission::firstOrCreate([
                    'name' => 'View status',
                    'display_name' => 'list_status',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_status',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Export',
                    'display_name' => 'list_export',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'list_export',
                ]);

                Permission::firstOrCreate([
                    'name' => 'Import',
                    'display_name' => 'edit_import',
                    'parent_id' => $permision->id,
                    'key_code' => $module_item . '_' . 'edit_import',
                ]);

            }

        }
    }
}
