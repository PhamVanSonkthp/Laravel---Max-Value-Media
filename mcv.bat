echo Ten bang cua ban la gi?
Set /p table=

echo Ten prefix cua bang?
Set /p prefix=

OKAY! dang tao du lieu %table% ...


call permissions.bat %prefix%
call services.bat %table% %prefix%
call routes.bat %table% %prefix%
call slidebars.bat %prefix%
call scan.bat
call model_controller_view_migration.bat %table%
call seed.bat

echo DONE!
echo ---PhamSon---
