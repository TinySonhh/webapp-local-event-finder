@echo off	

title "Obfuscating PHP JS files..."
ECHO "Obfuscating PHP JS files..."

pushd justphp
	ren *.php *.js
popd

javascript-obfuscator justphp --output justphp-obfuscated --string-array-encoding base64