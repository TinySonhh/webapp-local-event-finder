@echo off

title "Obfuscating PHP JS files..."
ECHO "Obfuscating PHP JS files..."

call ..\setEnv.bat
set FOLDER_1=%JS_PHP_FOLDER_1%
set FOLDER_2=%JS_PHP_FOLDER_2%

set SRC_1=..\changes\%FOLDER_1%
set SRC_2=..\changes\%FOLDER_2%

set SCRIPT_1=embed\%FOLDER_1%
set SCRIPT_2=embed\%FOLDER_2%

if not exist "%SCRIPT_1%" md "%SCRIPT_1%"
if not exist "%SCRIPT_2%" md "%SCRIPT_2%"

if exist "%SRC_1%" (
	copy %SRC_1%\*.* %SCRIPT_1%\*.js
)
if exist "%SRC_2%" (
	copy %SRC_2%\*.* %SCRIPT_2%\*.js
)

javascript-obfuscator embed --output obfuscated --string-array-encoding base64 --exclude '*.min.js,*.io.js'