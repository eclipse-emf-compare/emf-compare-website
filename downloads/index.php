<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/buildServer-common.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/downloads-scripts.php");
	
	$pageTitle 		= "EMF Compare - Download";
	
	if (is_array($projects))
{
	$projectArray = getProjectArray($projects, $extraprojects, $nodownloads, $PR);
	$proj = "/" . (isset($_GET["project"]) && preg_match("/^(?:" . join("|", $projects) . ")$/", $_GET["project"]) ? $_GET["project"] :	""); # default
}
else
{
	$proj = "";
}

if ((!$proj || $proj == "/") && isset($defaultProj)) { $proj = $defaultProj; }
$projct = preg_replace("#^/#", "", $proj);
if (strstr($PR, "/") !== false)
{
	list($topProj, $parentProj) = explode("/", $PR); # modeling, emf
}
else
{
	list($topProj, $parentProj) = array("NONE", $PR); # NONE, gef
}

if (isset($projct) && isset($hasmoved) && is_array($hasmoved) && array_key_exists($projct,$hasmoved))
{
	header("Location: http://www.eclipse.org/modeling/" . $hasmoved[$projct] . "/downloads/?" . $_SERVER["QUERY_STRING"]);
	exit;
}

$numzips = isset($extraZips) ? 0 - sizeof($extraZips) : 0; // if extra zips (new zips added later), reduce the "required" count when testing a build
if (isset($dls[$proj]) && is_array($dls[$proj]))
{
	foreach (array_keys($dls[$proj]) as $z)
	{
		$numzips += sizeof($dls[$proj][$z]);
	}
}

# store an array of paths to hide
$hiddenBuilds = is_readable($_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/hidden.txt") ? file($_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/hidden.txt") : array();

// include extras-$proj.php or extras-$PR.php
$files = array ($_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/extras-" . $projct . ".php", $_SERVER["DOCUMENT_ROOT"] . "/$PR/downloads/extras-" . $PR . ".php");
foreach ($files as $file)
{
	if (file_exists($file))
	{
		include_once($file);
		break;
	}
}

$hadLoadDirSimpleError = 1; //have we echoed the loadDirSimple() error msg yet? if 1, omit error; if 0, echo at most 1 error
$sortBy = (isset($_GET["sortBy"]) && preg_match("/^(date)$/", $_GET["sortBy"], $regs) ? $regs[1] : "");
$showAll = (isset($_GET["showAll"]) && preg_match("/^(1)$/", $_GET["showAll"], $regs) ? $regs[1] : "0");
$showMax = (isset($_GET["showMax"]) && preg_match("/^(\d+)$/", $_GET["showMax"], $regs) ? $regs[1] : ($sortBy == "date" ? "10" : "5"));
$showBuildResults = !isset($_GET["light"]) && !isset($_GET["nostatus"]); // suppress display of status to render page faster
$doRefreshPage = false;

$PWD = getPWD("$projct/downloads/drops");

	$html  = '<div id="midcolumn">';
	$html .= $pageTitle;
	$html .= $PWD;
	$html .= "</div>";
	
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
