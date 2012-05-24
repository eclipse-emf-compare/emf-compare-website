<?php

$toolkitClassPath = ".:forms";

function __autoload($className)
{
	global $toolkitRoot;
	global $toolkitClassPath;
	foreach (explode(":", $toolkitClassPath) as $path)
	{
		$file = "$toolkitRoot/classes/$path/$className.php";
		if (is_file($file))
		{
			require_once $file;
			return;
		}
	}
}

?>
