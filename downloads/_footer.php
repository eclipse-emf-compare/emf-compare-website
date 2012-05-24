<?php

print "\n";
print "\n";
print "<!-- ######################################################################## -->\n";
print "<!-- ######################################################################## -->\n";
print "<!-- ######################################################################## -->\n";

$html = ob_get_clean();
$html = mb_convert_encoding($html, "HTML-ENTITIES", "auto");

$appTitle = $projectTitle . (isset($areaTitle) ? " - $areaTitle" . (isset($pageTitle) ? " - $pageTitle" : "") : "");
$appKeywords = "$projectTitle $projectKeywords $areaTitle $areaKeywords $pageTitle $pageKeywords";

# Generate the web page
$App->Promotion = TRUE;
$App->generatePage("Nova", $Menu, $Nav, $pageAuthor, $appKeywords, $appTitle, $html);

?>