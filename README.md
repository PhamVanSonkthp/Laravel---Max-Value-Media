-- Begin --
** Create Model, Migration, Seeder, Controller, Policy and View **

* Chạy file batch "mcv.bat"
Ví dụ bảng posts -> nhập Post và posts
ví dụ bảng category_news -> nhập CategoryNew và category_news
* sửa file slidebars.blade.php dấu ' thành dấu "
* Thêm các trường bảng migration
* Sau dó chạy

php artisan migrate
php artisan db:seed --class=CreatePermissionSeeder

php artisan make:model Test -m
php artisan make:seed CreateTestSeeder
php artisan make:controller Admin/TestController --model=Test
php artisan make:viewadd Test
php artisan make:viewedit Test
php artisan make:viewindex Test
php artisan make:viewheader Test
php artisan make:viewsearch Test
php artisan make:_policy Test
Thêm quyền vào file "config/permissions"
Thêm check permission vào file "app/Services/PermissionGateAndPolicyAccess"
Thêm route và middleware "routes/administrator/index"
Thêm menu vào view "resources/views/administrator/components/slidebars.blade"
-- End --

-- Begin --
* Đối với App có sử dụng thông báo, cần đăng ký topic "app" khi vào app
--- End ---

--- Begin ---
Quy tắc viết code
https://docs.google.com/spreadsheets/d/1ZLJQd6VN-aafelsc1GoTX8wZYHcuC4bOd40uNmYQSIQ
--- End ---

* Thư viện Laravel-File-Manager lỗi, thay đổi ở đây "vendor/unisharp/laravel-filemanager/src/Controllers/DeleteController.php"
bỏ ở func if ($this->lfm->setName($name_to_delete)->isDirectory()) {...}
//                    array_push($errors, parent::error('delete-folder'));
//                    continue;

-- End --

-- Begin --
* Chạy cron mỗi phút để gửi email và thông báo

php /var/www/artisan schedule:run 1>> /dev/null 2>&1

run chedule: php artisan schedule:run
-- End --

--- Begin ---

Chay schedule trên server

run schedule on DA		
/usr/local/bin/php -d "disable_functions=" /home/igop/domains/igop.gover.vn/public_html/artisan schedule:run > /dev/null 2>&1
php /home/sayalo/domains/sayalo.gover.vn/public_html/artisan schedule:run > /dev/null 2>&1	

run schedule on Cpanel
/usr/local/bin/php /home/gxzrilko/vip.maubuifinance.com/artisan schedule:run >> /dev/null 2>&1	

Xóa cache & restart queue

php /home/sayalo/domains/sayalo.gover.vn/public_html/artisan queue:clear > /dev/null 2>&1
php /home/sayalo/domains/sayalo.gover.vn/public_html/artisan config:clear > /dev/null 2>&1
php /home/sayalo/domains/sayalo.gover.vn/public_html/artisan cache:clear > /dev/null 2>&1

--- End ---


--- Begin ---

Sửa lỗi ảnh trong html api 

$item['content'] = str_replace("src=\"/storage", "src=\"" . env('APP_URL') . "/storage", $item['content']);
$item['content'] = str_replace("<img", "<img style=\"border-radius: 12px;border: 1px solid #dee2e6 !important;\"", $item['content']);

--- End ---

need doing

