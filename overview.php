<?php 
$introText = <<<EOT
	<p><a href="http://wiki.eclipse.org/index.php/EMF_Compare">EMF Compare</a> brings model comparison to the EMF framework, this tool provides generic support for any kind of metamodel in order to compare and merge models.
The objectives of this component are to provide a stable and efficient generic implementation of model comparison and to provide an extensible framework for specific needs.</p>
EOT;
    	
$detailText = <<<EOT
	<p>	
	<a href="http://wiki.eclipse.org/index.php/EMF_Compare">EMF Compare</a> brings model comparison to the EMF framework, this tool provides generic support for any kind of metamodel in order to compare and merge models.
The objectives of this component are to provide a stable and efficient generic implementation of model comparison and to provide an extensible framework for specific needs.
	</p>
	<p>
	The comparison process is divided in 2 phases: <em>matching</em> and <em>differencing</em>. 
	The <em>matching</em> phase browses the model version figuring out which element comes from which other one, then 
	the <em>differencing</em> process browses the matching result and create the corresponding delta. This delta may itself be serialized as a model.
	</p>
	<div align="center">
	  	<img src="images/global.png"/>
		<p align="center"><em>Global architecture</em></p>
	</div>
	<p>
	The first release of EMF Compare is tentatively scheduled for the beginning of June, 2007. You may stay tuned to what's going by watching <a href="http://cedric.brun.free.fr/wordpress/">this blog</a>'s <a href="http://cedric.brun.free.fr/wordpress/?feed=rss2">RSS feed</a>.
	</p>
<p align="center">
<a href="images/screenshot.png"><img border="0" src="images/mini-screenshot.png"/></a><br/>
<em>Comparing UML models</em> - <a href="images/screenshot.png">Zoom</a></p>
<ul>
<li style="border-style: none;"><h2>Documentation</h2>
 <ul> 
    <li><em>03/2007</em> EclipseCon 2007 <a href="http://www.eclipsecon.org/2007/index.php?page=sub/&id=3593">model comparison panel</a> 
    	- Slides: <a href="doc/eclipsecon2007/cedric.pdf">C&eacute;dric Brun</a>, <a href="doc/eclipsecon2007/antoine.pdf">Antoine Toulm&eacute;</a></li>
    <li><em>10/2006</em> <a href="doc/EMFCompare-description.pdf">Initial Project Description </a></li>
 </ul>
</li>
<li style="border-style: none;">
 <h2>Contributors</h2>
	<p> This component comes from a common contribution of <a href="http://wwww.obeo.fr">Obeo</a> and <a href="http://www.intalio.com">Intalio</a>. The initial commiters are:
		<a href="mailto:cedric.brun@obeo.fr">C&eacute;dric Brun (lead)</a>,
		<a href="mailto:jonathan.musset@obeo.fr">Jonathan Musset</a>, 
		<a href="mailto:atoulme@intalio.com">Antoine Toulm&eacute;</a>.
	</p>
</li>
</ul>
EOT;
?>
