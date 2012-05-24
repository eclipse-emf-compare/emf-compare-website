<?php
	function getBuildsFrom($branchDirs, $PWD)
	{
		$buildDirs = array();
	
		foreach ($branchDirs as $branch)
		{
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS](\d{12}|\d{8}-\d{4})", "d");
		}
	
		// sort by branch, then type
		$builds_temp = array();
		foreach ($buildDirs as $branch => $dirList)
		{
			foreach ($dirList as $dir)
			{
				$type = substr($dir, 0, 1);
	
				$builds_temp[$branch][$type][] = $dir;
			}
		}
	
		return $builds_temp;
	}
?>