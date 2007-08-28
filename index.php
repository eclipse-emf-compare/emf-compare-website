<?php $projct=preg_replace("#.+/([^/]+)/(index.php|)#","$1",$_SERVER['PHP_SELF']); header("Location: /modeling/emft/?project=$projct#$projct"); ?>
