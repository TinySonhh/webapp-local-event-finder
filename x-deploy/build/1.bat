@echo off

title "Obfuscating Standard JS files..."
ECHO "Obfuscating Standard JS files..."
if exist "obfuscated" (
	rmdir /s /q obfuscated
)
pushd ..
if exist "changes/deploy" (
	rmdir /s /q changes/deploy
)
popd
javascript-obfuscator ..\changes --output obfuscated --string-array-encoding base64