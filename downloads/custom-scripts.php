<?php
	function getBuildsFrom($branchDirs, $PWD) {
		$buildDirs = array();
	
		foreach ($branchDirs as $branch) {
			// Some of the builds are of the form <type><YYYYMMDD>-<HHMM>
			// Others are the usual <type><YYYYMMDDHHMM>
			$buildDirs[$branch] = loadDirSimple("$PWD/$branch", "[IMNRS](\d{12}|\d{8}-\d{4})", "d");
		}
		print_r($buildDirs);
	
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
	
	function getUpdateSiteArchive($zips) {
		foreach ($zips as $zip) {
			if (preg_match("/((S|s)ite)|((U|u)pdate)/", $zip)) {
				return $zip;
			}
		}
		return "";
	}
	
	function getSDKArchive($zips) {
		foreach ($zips as $zip) {
			if (preg_match("/SDK/", $zip)) {
				return $zip;
			}
		}
		return "";
	}
	
	function getTypeLabel($type) {
		if ($type == "R") {
			return "Release";
		}
		if ($type == "M") {
			return "Maintenance";
		}
		if ($type == "S") {
			return "Stable";
		}
		if ($type == "I") {
			return "Integration";
		}
		if ($type == "N") {
			return "Nightly";
		}
		return "";
	}
	
	function getTypeUpdateSite($type) {
		if ($type == "R") {
			return "releases";
		}
		if ($type == "M") {
			return "maintenance";
		}
		if ($type == "S") {
			return "milestones";
		}
		if ($type == "I") {
			return "integration";
		}
		if ($type == "N") {
			return "nightly";
		}
		return "";
	}
	
	function generateHTMLReleaseList($releases, $PWD) {
		$releaseList = "";
		if (sizeof($releases) > 0) {
			$releaseList .= "<li class=\"repo-item\">\n";
			$releaseList .= "<a href=\"javascript:toggle('repo_releases')\" class=\"repo-label1\">Releases</a>";
			$releaseList .= "<a name=\"releases\" href=\"#releases\">";
			$releaseList .= "<img src=\"http://www.eclipse.org/modeling/images/link.png\" alt=\"Permalink\" width=\"12\" height=\"12\"/>";
			$releaseList .= "</a>\n";
			$releaseList .= "<div class=\"repo1\" id=\"repo_releases\">\n";
			
			$releaseList .= "<table border=\"0\" width=\"100%\">\n";
			$releaseList .= "<tr class=\"repo-info\">";
			// PENDING package image
			$releaseList .= "<td><img src=\"\" alt=\"composite update site\"/></td>";
			// PENDING check link
			$releaseList .= "<td><b><a href=\"http://download.eclipse.org/modeling/emf/compare/updates/releases\">Update Site</a></b> for use with <a href=\"http://help.eclipse.org/indigo/index.jsp?topic=/org.eclipse.platform.doc.user/tasks/tasks-127.htm\">p2</a>.</td>";
			$releaseList .= "<td class=\"file-size level1\"></td>";
			$releaseList .= "</tr>\n";
			$releaseList .= "</table>\n";
			
			$releaseList .= "<ul>\n";
			
			foreach ($releases as $version => $branches) {
				$htmlVersion = preg_replace("/\./", "_", $version);
			
				$releaseList .= "<li  class=\"repo-item\">\n";
				$releaseList .= "<a href=\"javascript:toggle('repo_releases_$htmlVersion')\" class=\"repo-label2\">$version Releases</a>";
				$releaseList .= "<a name=\"releases_$htmlVersion\" href=\"#releases_$htmlVersion\"><img src=\"http://www.eclipse.org/modeling/images/link.png\" alt=\"Permalink\" width=\"12\" height=\"12\"/></a>\n";
				$releaseList .= "<div class=\"repo2\" id=\"repo_releases_$htmlVersion\">\n";
				
				$releaseList .= "<table border=\"0\" width=\"100%\">\n";
				$releaseList .= "<tr class=\"repo-info\">";
				// PENDING package image
				$releaseList .= "<td><img src=\"\" alt=\"composite update site\"/></td>";
				// PENDING check link
				$releaseList .= "<td><b><a href=\"http://download.eclipse.org/modeling/emf/compare/updates/releases/$version\">Update Site</a></b> for use with <a href=\"http://help.eclipse.org/indigo/index.jsp?topic=/org.eclipse.platform.doc.user/tasks/tasks-127.htm\">p2</a>.</td>";
				$releaseList .= "<td class=\"file-size level2\"></td>";
				$releaseList .= "</tr>\n";
				$releaseList .= "</table>\n";
				
				$releaseList .= "<ul>\n";
				
				foreach ($branches as $branch => $ID) {
					$releaseList = generateHTMLForBuild($PWD, $version, $branch, $ID, "releases");
				}
				
				$releaseList .= "</ul>\n";
				$releaseList .= "</div>\n";
				$releaseList .= "</li>\n";
			}
			
			$releaseList .= "</ul>\n";	
			$releaseList .= "</div>\n";
			$releaseList .= "</li>\n";
		}
		return $releaseList;
	}
	
	function generateHTMLBuildList($builds, $PWD) {
		$buildList = "";
		if (sizeof($builds) > 0) {
			foreach ($builds as $version => $branches) {
				$htmlVersion = preg_replace("/\./", "_", $version);
			
				$buildList .= "<li class=\"repo-item\">\n";
				$buildList .= "<a href=\"javascript:toggle('repo_$htmlVersion')\" class=\"repo-label1\">$version Builds</a>";
				$buildList .= "<a name=\"builds_$htmlVersion\" href=\"#builds_$htmlVersion\">";
				$buildList .= "<img src=\"http://www.eclipse.org/modeling/images/link.png\" alt=\"Permalink\" width=\"12\" height=\"12\"/>";
				$buildList .= "</a>\n";
				$buildList .= "<div class=\"repo1\" id=\"repo_$htmlVersion\">\n";
				
				$buildList .= "<ul>\n";
				
				foreach ($branches as $branch => $types) {
					$htmlBranch = preg_replace("/\./", "_", $branch);
					
					$buildList .= "<li class=\"repo-item\">\n";
					$buildList .= "<a href=\"javascript:toggle('repo_$htmlBranch')\" class=\"repo-label1\">$branch</a>";
					$buildList .= "<a name=\"builds_$htmlBranch\" href=\"#builds_$htmlBranch\">";
					$buildList .= "<img src=\"http://www.eclipse.org/modeling/images/link.png\" alt=\"Permalink\" width=\"12\" height=\"12\"/>";
					$buildList .= "</a>\n";
					$buildList .= "<div class=\"repo1\" id=\"repo_$htmlBranch\">\n";
					
					$buildList .= "<ul>\n";
					
					foreach ($types as $type => $IDs) {
						$typeLabel = getTypeLabel($type);
						$typeUpdateSite = getTypeUpdateSite($type);
						
						$buildList .= "<li class=\"repo-item\">\n";
						$buildList .= "<a href=\"javascript:toggle('repo_$htmlBranch_$type')\" class=\"repo-label1\">$branch $typeLabel Builds</a>";
						$buildList .= "<a name=\"builds_$htmlBranch_$type\" href=\"#builds_$htmlBranch_$type\">";
						$buildList .= "<img src=\"http://www.eclipse.org/modeling/images/link.png\" alt=\"Permalink\" width=\"12\" height=\"12\"/>";
						$buildList .= "</a>\n";
						$buildList .= "<div class=\"repo1\" id=\"repo_$htmlBranch_$type\">\n";
						
						$buildList .= "<ul>\n";
						
						foreach ($IDs as $ID) {
							$releaseList = generateHTMLForBuild($PWD, $version, $branch, $ID, $typeUpdateSite);
						}
						
						$releaseList .= "</ul>\n";	
						$releaseList .= "</div>\n";
						$releaseList .= "</li>\n";
					}
					
					$releaseList .= "</ul>\n";	
					$releaseList .= "</div>\n";
					$releaseList .= "</li>\n";
				}
				
				$releaseList .= "</ul>\n";	
				$releaseList .= "</div>\n";
				$releaseList .= "</li>\n";
			}
		}
		return $buildList;
	}
	
	function generateHTMLForBuild($PWD, $version, $branch, $ID, $typeUpdateSite) {
		// YYYY/MM/DD HH:MM
		$dateFormat = preg_replace("/[IMNRS](\d{4})(\d{2})(\d{2})-?(\d{2})(\d{2})/", "$1/$2/$3 $4:$5", $ID);
		$zips_in_folder = loadDirSimple("$PWD/$branch/$ID/", "(\.zip|\.tar\.gz)", "f");
		$archivedSite = getUpdateSiteArchive($zips_in_folder);
		$SDKArchive = getSDKArchive($zips_in_folder);
	
		$buildHTML = "<li class=\"repo-item\">\n";
		$buildHTML .= "<b><a href=\"javascript:toggle('drop_$ID')\" class=\"drop-label\">$branch ($dateFormat)</a></b>";
		$buildHTML .= "<a name=\"$ID\" href=\"#$ID\"><img src=\"http://www.eclipse.org/modeling/images/link.png\" alt=\"Permalink\" width=\"12\" height=\"12\"/></a>\n";
		$buildHTML .= "<div class=\"drop\" id=\"drop_$ID\">\n";
		
		$buildHTML .= "<table border=\"0\" width=\"100%\">\n";
		
		// UPDATE SITE
		$buildHTML .= "<tr class=\"repo-info\">";
		// PENDING package image
		$buildHTML .= "<td><img src=\"\" alt=\"composite update site\"/></td>";
		// PENDING check link
		$buildHTML .= "<td><b><a href=\"http://download.eclipse.org/modeling/emf/compare/updates/$typeUpdateSite/$version/$ID\">Update Site</a></b> for use with <a href=\"http://help.eclipse.org/indigo/index.jsp?topic=/org.eclipse.platform.doc.user/tasks/tasks-127.htm\">p2</a>.</td>";
		$buildHTML .= "<td class=\"file-size level3\"></td>";
		$buildHTML .= "</tr>\n";
		
		$buildHTML .= "<tr class=\"drop-info\"><td colspan=\"3\"><hr class=\"drop-separator\"></td></tr>";
		
		// ARCHIVED UPDATE SITE
		if ($archivedSite != "") {
			$buildHTML .= "<tr class=\"drop-info\">";
			// PENDING download image (or package image?)
			$buildHTML .= "<td><img src=\"\" alt=\"archived update site\"/></td>";
			// PENDING check link
			$buildHTML .= "<td><a href=\"http://www.eclipse.org/downloads/download.php?file=/modeling/emf/compare/downloads/drops/$branch/$ID/$archivedSite&amp;protocol=http\">Archived update site</a> for local use with <a href=\"http://help.eclipse.org/indigo/index.jsp?topic=/org.eclipse.platform.doc.user/tasks/tasks-127.htm\">p2</a>.</td>";
			// PENDING retrieve zip size
			$buildHTML .= "<td class=\"file-size level3\"><i></i></td>";
			$buildHTML .= "</tr>\n";
		}
		
		// SDK
		if ($SDKArchive != "") {
			$buildHTML .= "<tr class=\"drop-info\">";
			// PENDING download image
			$buildHTML .= "<td><img src=\"\" alt=\"EMF Compare SDK\"/></td>";
			// PENDING check link
			$buildHTML .= "<td><a href=\"http://www.eclipse.org/downloads/download.php?file=/modeling/emf/compare/downloads/drops/$branch/$ID/$SDKArchive&amp;protocol=http\">EMF Compare SDK</a></td>";
			// PENDING retrieve zip size
			$buildHTML .= "<td class=\"file-size level3\"><i></i></td>";
			$buildHTML .= "</tr>\n";
		}
		
		$buildHTML .= "</table>\n";
		
		$buildHTML .= "</div>\n";
		$buildHTML .= "</li>\n";
		
		return $buildHTML;
	}
?>