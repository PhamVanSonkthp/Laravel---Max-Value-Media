

echo OKAY! configing services %1

@echo off
setlocal
set "rootDir=Services"

call :FindReplace "/*step_1*/" "$this->defineGate%1s();/*step_1*/" PermissionGateAndPolicyAccess.php

call :FindReplace "/*step_2*/" "public function defineGate%1s(){Gate::define('%2-list', 'App\Policies\%1Policy@view');Gate::define('%2-add', 'App\Policies\%1Policy@create');Gate::define('%2-edit', 'App\Policies\%1Policy@update');Gate::define('%2-delete', 'App\Policies\%1Policy@delete');}/*step_2*/" PermissionGateAndPolicyAccess.php

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