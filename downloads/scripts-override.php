<?php
	function getBuildsFrom($branchDirs, $PWD)
	{
		$buildDirs = array();
	
		foreach ($branchDirs as $branch)
		{
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS]\d{12}", "d");
		}
		print_r($buildDirs);
	
		// sort by branch, then type
	}
?>