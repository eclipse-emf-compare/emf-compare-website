<?php
	function getBuildsFrom($branchDirs, $PWD) {
		$buildDirs = array();
	
		foreach ($branchDirs as $branch) {
			// Some of the builds are of the form <type><YYYYMMDD>-<HHMM>
			// Others are the usual <type><YYYYMMDDHHMM>
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS](\d{12}|\d{8}-\d{4})", "d");
		}
	
		// sort by branch (1.2.2 and 1.2.1 will both be in "1.2"), then version (1.2.2 or 1.2.1), then type
		$builds_temp = array();
		foreach ($buildDirs as $branch => $dirList) {
			$version = substr($branch, 0, 3);
			foreach ($dirList as $dir) {
				$type = substr($dir, 0, 1);
	
				$builds_temp[$version][$branch][$type][] = $dir;
			}
		}
	
		return $builds_temp;
	}
	
	function reorderAndSplitBuilds($oldBuilds, $buildTypes) {
		$newBuilds = array();
		$releases = array();
		
		foreach ($buildTypes as $branch => $types) {
			$version = substr($branch, 0, 3);
			foreach ($types as $type => $names) {
				if ($type == "R" && isset($oldBuilds[$version][$branch][$type])) {
					$id = $oldBuilds[$version][$branch][$type][0];
					$releases[$version][$branch] = $id;
				} else if (array_key_exists($version, $oldBuilds) && array_key_exists($branch, $oldBuilds[$version]) && array_key_exists($type, $oldBuilds[$version][$branch]) && is_array($oldBuilds[$version][$branch][$type])) {
					$newBuilds[$version][$branch][$type] = $oldBuilds[$version][$branch][$type];
					rsort($newBuilds[$version][$branch][$type]);
				}
			}
		}
		return array($newBuilds,$releases);
	}
	
	function generateHTMLReleaseList($releases) {
		$releaseList = "";
		if (sizeof($releases) > 0) {
			$releaseList .= "<div class=\"homeitem3col\">\n";
			$releaseList .= "<h3>Releases</h3>\n";
			$releaseList .= "<ul>\n";
			
			foreach ($releases as $version => $branches) {
				$releaseList .= "<li>";
				$releaseList .= $version . " Releases\n";
				$releaseList .= "<ul>\n";
				
				foreach ($branches as $branch => $ID) {
					$releaseList .= "<li>";
					$releaseList .= $branch . "\n";
					$releaseList .= "<ul>";
					$releaseList .= "<li>" . $ID . "</li>";
					$releaseList .= "</ul>";
					$releaseList .= "</li>\n";
				}
				
				$releaseList .= "</ul>\n";
				$releaseList .= "</li>\n";
			}
				
			$releaseList .= "</ul>\n";
			$releaseList .= "</div>\n";
		}
		return $releaseList;
	}
?>