echo OKAY! configing slidebars %1 ...

@echo off
setlocal
set "rootDir=resources/views/administrator/components"

call :FindReplace "/*step_1*/" "@can('%1-list')<li class='nav-item'><a href='{{route('administrator.%1.index')}}' class='nav-link'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='002424' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='featherfeather-boxlink-icon'><path d='M2116V8a22000-1-1.73l-7-4a22000-20l-74A2200038v8a2200011.73l74a2200020l7-4A220002116z'></path><polyline points='3.276.961212.0120.736.96'></polyline><line x1='12' y1='22.08' x2='12' y2='12'></line></svg><span class='link-title'>%1</span></a></li>@endcan /*step_1*/" slidebars.blade.php

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

echo OKAY! configed slidebars