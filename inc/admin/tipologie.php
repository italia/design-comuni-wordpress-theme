<?php

//include tutti i file che descrivono i custom post type del Sito dei Comuni
foreach(glob(get_template_directory() . "/inc/admin/tipologie/*.php") as $file){
    require $file;
}