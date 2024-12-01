<?php

$zip = new ZipArchive(); //Создаём объект для работы с ZIP-архивами
$arch = "archive.zip";
$zip->open($arch, ZIPARCHIVE::CREATE); 
echo "Открываем (создаём) архив ".$arch;
$file1 = "index.html";
$file2 = "style.css";
$zip->addFile($file1); 
echo "Добавляем в архив файл".$file1;
$zip->addFile($file2); 
echo "Добавляем в архив файл ".$file2;
$zip->close(); //Завершаем работу с архивом