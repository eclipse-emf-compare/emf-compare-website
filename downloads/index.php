<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/buildServer-common.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/downloads-scripts.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/scripts.php");
	require_once("./scripts-override.php");
	
	$projectTitle = "EMF Compare";
	$PR = "modeling/emf/compare";
	$pageTitle 		= "EMF Compare - Download";
	
	$PWD = getPWD("downloads/drops");
	$branches = loadDirSimple($PWD, ".*", "d");
	rsort($branches);
	
	$buildtypes = array(
		"R" => "Release",
		"S" => "Stable",
		"I" => "Integration",
		"M" => "Maintenance",
		"N" => "Nightly"
	);
	$buildTypes = getBuildTypes($branches, $buildtypes);
	
	// Retrieve the list of builds from the disk (folder list only)
	$builds = getBuildsFrom($branches, $PWD);
	
	$builds = reorderAndSplitArray($builds, $buildTypes);
	$releases = $builds[1];
	$builds = $builds[0];
	
	print_r($releases);
	print_r($builds);
	
	$html  = '<div id="midcolumn">';
	$html .= "EMF Compare downloads";
	$html .= "</div>";
	
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
