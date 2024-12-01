<?php

$pathdir='site/';
$zip = new ZipArchive;
if ($zip -> open('arch.zip', ZipArchive::CREATE) === TRUE)
{
  $dir = opendir( $pathdir );
  while( $d = readdir( $dir ) ){
 		if ($d !== "." && $d !== ".." ){
		 echo "Добавляем в архив файл ".$d." размером ".filesize( $pathdir.$d )."<br />";
 		 $zip -> addFile( $pathdir.'/'.$d, $d);
 		}
  }
  $zip -> close();
  echo 'Файлы добавлены в архив';
}
else echo "Ошибка открытия файла архива!";