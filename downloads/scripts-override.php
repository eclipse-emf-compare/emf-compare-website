<?php
	function getBuildsFromDirs($branchDirs, $PWD)
	{
		$buildDirs = array();
	
		foreach ($branchDirs as $branch)
		{
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS]\d{12}", "d");
		}
	
		// sort by branch, then type
		$builds_temp = array();
		foreach ($buildDirs as $br => $dirList)
		{
			foreach ($dirList as $dir)
			{
				$ty = substr($dir, 0, 1); //first char
	
				$builds_temp[$br][$ty][] = $dir;
			}
		}
	
		return $builds_temp;
	}
?>