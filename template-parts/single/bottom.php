<?php
global $post, $licenza;
?>
<p class="text-paragraph-small mt-30">
    Pagina aggiornata il <?php
		$date_publish = new DateTime($post->post_modified);
		echo $date_publish->format('d/m/Y');
		?>
</p>
<p>
    <?php
        // if(trim($licenza)!= "")
        //     echo $licenza;
        // else
        //     _e("Eccetto dove diversamente specificato, questo articolo è stato rilasciato sotto Licenza Creative Commons Attribuzione 3.0 Italia.", "design_comuni_italia"); 
    ?>
</p>
