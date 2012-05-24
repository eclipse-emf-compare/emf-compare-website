<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/buildServer-common.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/scripts.php");
	
	$projectTitle = "EMF Compare";
	$PR = "modeling/emf/compare";
	$pageTitle 		= "EMF Compare - Download";
	
	$PWD = $App->getDownloadBasePath() . "/modeling/emf/compare/downloads/drops";
	$branches = loadDirSimple($PWD, ".*", "d");

	$html  = '<div id="midcolumn">';
	$html .= getPWD("/downloads/drops");
	$html .= $branches;
	$html .= "</div>";
	
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
