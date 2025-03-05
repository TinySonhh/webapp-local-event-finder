@echo off

title "Update changes files..."
ECHO "Update changes files..."
xcopy /y /h /i /e obfuscated ..\changes
ECHO "DONE..."