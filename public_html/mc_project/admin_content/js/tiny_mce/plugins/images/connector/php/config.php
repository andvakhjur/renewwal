<?php
//Корневая директория сайта
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
//Директория с изображениями (относительно корневой)
define('DIR_IMAGES',	'/upload/user_files' . '/images');
//Директория с файлами (относительно корневой)
define('DIR_FILES',		'/upload/user_files' . '/files');

//Высота и ширина картинки до которой будет сжато исходное изображение и создана ссылка на полную версию
define('WIDTH_TO_LINK', 800);
define('HEIGHT_TO_LINK', 800);
//define('HEIGHT_TO_LINK', 10000);

//Атрибуты которые будут присвоены ссылке (для скриптов типа lightbox)
define('CLASS_LINK', 'lightview');
define('REL_LINK', 'lightbox');

?>