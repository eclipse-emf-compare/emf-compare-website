<?php $areaRelative = "."; require_once "$areaRelative/_defs.php";  include "$areaRelative/_header.php";
########################################################################

$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/modeling/includes/common.css"/>' . "\n\t");
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/modeling/includes/downloads.css"/>' . "\n\t");
$App->AddExtraHtmlHeader('<script src="/modeling/includes/downloads.js" type="text/javascript"></script>' . "\n\t");

$pageAuthor		= "Laurent Goubet";

print '<div id="midcolumn">' . "\n";
EMF Compare downloads
print '</div>';


########################################################################
include "$areaRelative/_footer.php"; ?>
