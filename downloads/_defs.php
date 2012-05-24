<?php $toolkitRoot = $_SERVER["DOCUMENT_ROOT"] . "/emf/compare/_toolkit"; require_once "$toolkitRoot/includes/defs.php";
########################################################################

# Display name of this project
$projectTitle = "EMF Compare";

# Keywords of this project
$projectKeywords	= "Eclipse Modeling Framework EMF";

# Project enums in the mysql database
$mysqlProject = "org.eclipse.emf";
$mysqlComponent = "org.eclipse.emf.compare";

# Wiki infrastructure
$wikiEclipseURL = "http://wiki.eclipse.org";
$wikiPageSuffix = "EMF_Compare";

# CVS infrastructure
$devEclipseURL = "http://dev.eclipse.org";
$viewcvsPath = "/viewcvs/index.cgi";
$viewcvsURL = $devEclipseURL . $viewcvsPath;
$viewcvsRoot = "Modeling_Project";

# Used by various modeling includes
$PR = "modeling/emf/compare";
require_once "$docRoot/modeling/includes/scripts.php";

# Display name of this area
$areaTitle = "Downloads";

# Keywords of this area
$areaKeywords	= "";

########################################################################
?>
