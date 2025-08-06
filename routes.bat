echo OKAY! configing routes %1 ...

@echo off
setlocal
set "rootDir=route/administrator"

call :FindReplace "/*step_1*/" "Route::prefix('%2')->group(function(){Route::get('/',['as'=>'administrator.%2.index','uses'=>'App\Http\Controllers\Admin\%1Controller@index','middleware'=>'can:%2-list',]);Route::get('/create',['as'=>'administrator.%2.create','uses'=>'App\Http\Controllers\Admin\%1Controller@create','middleware'=>'can:%2-add',]);Route::post('/store',['as'=>'administrator.%2.store','uses'=>'App\Http\Controllers\Admin\%1Controller@store','middleware'=>'can:%2-add',]);Route::get('/edit/{id}',['as'=>'administrator.%2.edit','uses'=>'App\Http\Controllers\Admin\%1Controller@edit','middleware'=>'can:%2-edit',]);Route::put('/update/{id}',['as'=>'administrator.%2.update','uses'=>'App\Http\Controllers\Admin\%1Controller@update','middleware'=>'can:%2-edit',]);Route::delete('/delete/{id}',['as'=>'administrator.%2.delete','uses'=>'App\Http\Controllers\Admin\%1Controller@delete','middleware'=>'can:%2-delete',]);Route::delete('/delete-many',['as'=>'administrator.%2.delete_many','uses'=>'App\Http\Controllers\Admin\%1Controller@deleteManyByIds','middleware'=>'can:%2-delete',]);Route::post('/restore/{id}', ['as' => 'administrator.%2.restore','uses' => 'App\Http\Controllers\Admin\%1Controller@restore','middleware' => 'can:%2-edit',]);Route::get('/export',['as'=>'administrator.%2.export','uses'=>'App\Http\Controllers\Admin\%1Controller@export','middleware'=>'can:%2-list',]);Route::get('/audit/{id}',['as'=>'administrator.%2.audit','uses'=>'App\Http\Controllers\Admin\%1Controller@audit','middleware'=>'can:%2-list',]);Route::get('/import',['as'=>'administrator.%2.import','uses'=>'App\Http\Controllers\Admin\%1Controller@import','middleware'=>'can:%2-list',]);Route::get('/{id}',['as'=>'administrator.%2.get','uses'=>'App\Http\Controllers\Admin\%1Controller@get','middleware'=>'can:%2-list',]);Route::put('/',['as'=>'administrator.%2.sort','uses'=>'App\Http\Controllers\Admin\%1Controller@sort','middleware'=>'can:%2-edit',]);});/*step_1*/" index.php

exit /b

:FindReplace <findstr> <replstr> <file>
set tmp="%temp%\tmp.txt"
If not exist %temp%\_.vbs call :MakeReplace
for /f "tokens=*" %%a in ('dir "%3" /s /b /a-d /on') do (
  for /f "usebackq" %%b in (`Findstr /mic:"%~1" "%%a"`) do (
    echo(&Echo Replacing "%~1" with "%~2" in file %%~nxa
    <%%a cscript //nologo %temp%\_.vbs "%~1" "%~2">%tmp%
    if exist %tmp% move /Y %tmp% "%%~dpnxa">nul
  )
)
del %temp%\_.vbs
exit /b

:MakeReplace
>%temp%\_.vbs echo with Wscript
>>%temp%\_.vbs echo set args=.arguments
>>%temp%\_.vbs echo .StdOut.Write _
>>%temp%\_.vbs echo Replace(.StdIn.ReadAll,args(0),args(1),1,-1,1)
>>%temp%\_.vbs echo end with

echo OKAY! configed routes
