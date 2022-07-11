<?php
global $obj;
$obj = get_queried_object();

if ($obj->taxonomy == "categorie_servizio")
	get_template_part("archive-servizio");
else if($obj->taxonomy == "argomenti")
	get_template_part("archive-argomento");
else
	get_template_part("archive");
