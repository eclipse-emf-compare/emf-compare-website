<?php

	# Set the theme for your project's web pages.
	# See the Committer Tools "How Do I" for list of themes
	# https://dev.eclipse.org/committers/
	# Optional: defaults to system theme 
	$theme = "Nova";
	

	# Define your project-wide Nav bars here.
	# Format is Link text, link URL (can be http://www.someothersite.com/), target (_self, _blank), level (1, 2 or 3)
	# these are optional
	$Nav->setLinkList(array());
	$Nav->addNavSeparator("EMF Compare", 	"/emf/compare");
	$Nav->addCustomNav("Download", "http://www.eclipse.org/emf/compare/downloads", "_self", 3);
	$Nav->addCustomNav("Documentation", "http://wiki.eclipse.org/EMF_Compare", "_self", 3);
	$Nav->addCustomNav("Support", "/emf/compare/support", "_self", 3);
	$Nav->addCustomNav("Getting Involved", "http://wiki.eclipse.org/EMF_Compare/Contributor_Guide", "_self", 3);
	
	$pageKeywords	= "comparison, merge, model, uml, acceleo, dsl, modeling, domain specific language, textual, emf, package, diagram, modeler";
	$pageAuthor		= "Obeo";
	$pageTitle 		= "EMF Compare";

	$Menu->setMenuItemList(array());
	$Menu->addMenuItem("Home", "/emf/compare", "_self");
	$Menu->addMenuItem("Download", "http://www.eclipse.org/modeling/emf/downloads/?project=compare", "_self");
	$Menu->addMenuItem("Documentation", "http://wiki.eclipse.org/EMF_Compare", "_self");
	$Menu->addMenuItem("Support", "/modeling/emf/compare/support", "_self");
	$Menu->addMenuItem("Developers", "http://wiki.eclipse.org/EMF_Compare/Contributor_Guide", "_self");
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="style_compare.css"/>' . "\n\t");
	
	$App->Promotion = TRUE;

	$App->SetGoogleAnalyticsTrackingCode("UA-6879255-3");
?>
