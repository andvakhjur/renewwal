<?php
$release = 0;
// $release = 1, просто задаем всем папкам права 755, а файлам 644. Допустимо только на хосте (для файлов, созданных самим скриптом)
// $release = 0, изменяем права файлов и папок на 777 ($delete = 0) или удаляем их($delete = 1)
$delete = 0;

$arrDir = array();
getFileName(".");

if($release == 1) {
	foreach($arrDir as $item) {
        if(is_dir($item)) {
            if(@chmod($item, 0755)) {
                echo "<b>chmod  <span style='color:red'>dir</span> to 755</b> ". $item. "<br>";
            } else {
                echo "<b>-------------no-permissions----------------</b> ". $item. "<br>";
            }
        } elseif(is_file($item)) {
            if(@chmod($item, 0644)) {
                echo "<b>chmod file to 644</b> ". $item. "<br>";
            } else {
                echo "<b>-------------no-permissions----------------</b> ". $item. "<br>";
            }
        }
	}
} elseif($release == 0) {
	foreach($arrDir as $item) {
		if(filegroup($item) == "81") {
			if($delete) {
				chmod($item, 0777);
				unlink($item);
				echo "<b>deleted</b> ". $item. "<br>";
			} else {
				chmod($item, 0777);
				echo "<b>chmod</b> ". $item. "<br>";
			}
		}
	}
}





function getFileName($dirName)
{
	global $arrDir;
	
	if(is_dir($dirName))
	{
		$arrDir[] = $dirName;
		$newArr = array();
		$newArr = scandir($dirName);
		foreach($newArr as $item)
		{
			if( ($item != ".") && ($item != "..") )
			getFileName($dirName. "/". $item);
		}
	}
	else
	{
		$arrDir[] = $dirName;
	}
}
?>