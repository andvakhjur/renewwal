<?php
DEFINE('PERM',20);
include("../if-login-ok.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>elFinder</title>
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="css/elfinder.css" type="text/css" media="screen" title="no title" charset="utf-8">

	<script src="js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="js/elfinder.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="js/i18n/elfinder.ru.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" >
		$().ready(function() {
			$('#finder').elfinder({
				 url : 'connectors/php/connector.php',
				 lang : 'ru',
				 editorCallback : function(url) {
						window.tinymceFileWin.document.forms[0].elements[window.tinymceFileField].value = url;
						window.tinymceFileWin.focus();
						window.close();
				 }
			})
		})
	</script>
</head>
<body>
	<div id="finder"></div>
</body>
</html>
