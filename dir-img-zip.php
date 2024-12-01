<?php

function rscandir($base = '', &$data = array()) {
    $array = array_diff(scandir($base), array('.', '..'));
    foreach ($array as $value) {
      if (is_dir($base . $value)) {
        $data[] = $base . $value . '/';
        $data = rscandir($base . $value . '/', $data);
       } elseif (is_file($base . $value)) {
       $data[] = $base . $value;
    }
  }
  return $data;
 }
 $paths = rscandir("site/");
 header('Content-Type: text/html; charset=utf-8');
 date_default_timezone_set("Europe/Kiev");
 $archive_dir = "backups/";
 $zip = new ZipArchive;
 $backupName = $archive_dir . "backup.zip";
 if ($zip->open($backupName, ZipArchive::CREATE) === TRUE) {
   foreach ($paths as $key => $value) {
     if (!is_dir($value)) {
       echo "Добавляем в архив файл " . $value . " размером " . filesize($value) . "<br />";
       $zip->addFile($value, $value);
     }
  }
  $zip->close();
    echo 'Файлы добавлены в архив' . $backupName;
 } else {
  echo "Ошибка открытия файла архива!";
 }