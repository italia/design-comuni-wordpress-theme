<?php

//include tutti i file che descrivono le tassonomie del Sito dei Comuni
foreach(glob(get_template_directory() . "/inc/admin/tassonomie/*.php") as $file){
    require $file;
}