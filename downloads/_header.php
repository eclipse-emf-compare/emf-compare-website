<?php
########################################################################

ob_start();

$navIconURL = "http://dev.eclipse.org/huge_icons/actions/go-down.png";
$Nav->addNavSeparator($areaTitle, "");
$Nav->addCustomNav("Releases", "$areaPath/index.php#releases", "", 1);
$Nav->addCustomNav("Integration", "$areaPath/index.php#integration", "", 1);
$Nav->addCustomNav("Maintenance", "$areaPath/index.php#maintenance", "", 1);
$Nav->addCustomNav("License", "http://www.eclipse.org/org/documents/epl-v10.php", "", 1);

########################################################################
?>
