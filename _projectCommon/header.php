<?php include "$toolkitRoot/includes/header.php";
########################################################################

if ($Nav != NULL)
{
	$Nav->addNavSeparator($projectTitle, "$projectPath/");
	$Nav->addCustomNav("Downloads", "$projectPath/downloads", "", 1);
	$Nav->addCustomNav("Documentation", "$projectPath/documentation", "", 1);
	$Nav->addCustomNav("Support", "$projectPath/support", "", 1);
	$Nav->addCustomNav("Community", "$projectPath/community", "", 1);
	$Nav->addCustomNav("Development", "$projectPath/development", "", 1);
	$Nav->addCustomNav("Team", "$projectPath/team", "", 1);
}

########################################################################
?>
