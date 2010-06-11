<?php $projct=preg_replace("#.+/([^/]+)/(index.php|)#","$1",$_SERVER['PHP_SELF']); header("Location: /modeling/emf/?project=$projct#$projct"); ?>
