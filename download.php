<?php  																														
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	
$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		
include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
	
	# Paste your HTML content between the EOHTML markers!
	$html = <<<EOHTML
	<div id="midcolumn">
	EMF Compare Downloads
	</div>
	EOHTML;

	# Generate the web page
	$App->generatePage($theme, $Menu, null, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
