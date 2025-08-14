@echo off
echo === Installation de Composer ===

REM Télécharger l'installateur Composer
echo Téléchargement de l'installateur Composer...
powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/Composer-Setup.exe' -OutFile 'Composer-Setup.exe'"

REM Exécuter l'installateur
echo Installation de Composer...
Composer-Setup.exe /SILENT

REM Nettoyer
del Composer-Setup.exe

echo === Installation terminée ===
echo Redémarrez PowerShell pour que Composer soit disponible
pause
