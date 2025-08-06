echo Ten prefix cua bang?

echo OKAY! configing permisstions %1 ...

@echo off
setlocal
set "rootDir=config"

call :FindReplace "/*step_1*/" "'%1-list' => '%1_list',/*step_1*/" permissions.php
call :FindReplace "/*step_1*/" "'%1-add' => '%1_add',/*step_1*/" permissions.php
call :FindReplace "/*step_1*/" "'%1-edit' => '%1_edit',/*step_1*/" permissions.php
call :FindReplace "/*step_1*/" "'%1-delete' => '%1_delete',/*step_1*/" permissions.php

call :FindReplace "/*step_2*/" "'%1',/*step_2*/" permissions.php

call :FindReplace "/*step_3*/" "'Manage %1',/*step_3*/" permissions.php

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

echo OKAY! configed permisstions