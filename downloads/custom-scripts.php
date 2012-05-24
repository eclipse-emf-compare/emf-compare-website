<?php
	function getBuildsFrom($branchDirs, $PWD) {
		$buildDirs = array();
	
		foreach ($branchDirs as $branch) {
			// Some of the builds are of the form <type><YYYYMMDD>-<HHMM>
			// Others are the usual <type><YYYYMMDDHHMM>
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS](\d{12}|\d{8}-\d{4})", "d");
		}
	
		// sort by branch (1.2.2 and 1.2.1 will both be in "1.2"), then version (1.2.2 or 1.2.1), then type (RSMIN in this order)
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
					$releases[$version][$branch][substr($id, 1) . $type] = $branch . $type;
				} else if (array_key_exists($version, $oldBuilds) && array_key_exists($branch, $oldBuilds[$version]) && array_key_exists($type, $oldBuilds[$version][$branch]) && is_array($oldBuilds[$version][$branch][$type])) {
					$newBuilds[$version][$branch][$type] = $oldBuilds[$version][$branch][$type];
					rsort($newBuilds[$version][$branch][$type]);
				}
			}
		}
		return array($newBuilds,$releases);
	}
	
	function generateHTMLReleaseList($releases) {
		$html = "";
		if (sizeof($releases) > 0) {
			$html .= "<div class=\"homeitem3col\">\n";
			$html .= "<h3>Releases</h3>\n";
			$html .= "<ul>\n";
			
			foreach ($releases as $version => $branchReleases) {
				$html .= "<li>";
				$html .= $version . " Releases\n";
				$html .= "<ul>\n";
				
				foreach ($branchReleases as $rID => $rbranch) {
					$branch = preg_replace("/.$/", "", $rbranch);
					$ID = preg_replace("/^(\d{12})([IMNRS])$/", "$2$1", $rID);
					
					$html .= "<li>";
					$html .= $branch . "\n";
					
					$html .= "<\li>\n";
				}
				
				$html .= "<\ul>\n";
				$html .= "<\li>\n";
			}
				
			$html .= "</ul>\n";
			$html .= "</div>\n";
		}
	}
?>