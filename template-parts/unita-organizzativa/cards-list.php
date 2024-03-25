<?php 
    global $post, $with_border;

    $prefix = '_dci_unita_organizzativa_';
    $descrizione_breve = dci_get_meta('descrizione_breve');

    $img = dci_get_meta('immagine');
    $contatti = dci_get_meta('contatti');

    $prefix = '_dci_punto_contatto_';
    $indirizzi = array();
    foreach ($contatti ?? null as $punto_contatto_id) {
	    $voci = dci_get_meta('voci', $prefix, $punto_contatto_id);
	    foreach ($voci as $voce) {
		    if ($voce[$prefix.'tipo_punto_contatto'] == 'indirizzo')
			    array_push($indirizzi, $voce[$prefix.'valore']);
	    }
    }
    
    if($with_border) {
	    ?>

        <div class="card card-teaser card-teaser-info rounded shadow-sm p-3 m-1">
            <div class="card-body pe-3">
                <p class="card-title text-paragraph-regular-medium-semi mb-3">
                    <a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>" data-element="service-area">
					    <?php echo $post->post_title; ?>
                    </a>
                </p>
                <div class="card-text">
				    <?php if ($descrizione_breve) {
					    echo '<p class="u-main-black">'.$descrizione_breve.'</p>';
				    } ?>
				    <?php foreach ($indirizzi as $indirizzo) {
					    echo '<p class="u-main-black">'.$indirizzo.'</p>';
				    }?>
                </div>
            </div>
		    <?php if ($img) { ?>
                <div class="avatar size-xl">
				    <?php dci_get_img($img); ?>
                </div>
		    <?php } ?>
        </div>
    <?php } else { ?>
        <div class="card card-teaser border rounded shadow p-4">
            <div class="card-body pe-3">
                <h4 class="u-main-black mb-1 title-small-semi-bold-medium">
                    <a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>">
					    <?php echo $post->post_title; ?>
                    </a>
                </h4>
                <div class="card-text">
				    <?php if ($descrizione_breve) {
					    echo '<p class="u-main-black">'.$descrizione_breve.'</p>';
				    } ?>
				    <?php foreach ($indirizzi as $indirizzo) {
					    echo '<p>'.$indirizzo.'</p>';
				    }?>
                </div>
            </div>
		    <?php if ($img) { ?>
                <div class="avatar size-xl">
				    <?php dci_get_img($img); ?>
                </div>
		    <?php } ?>
        </div>
    <?php } 
$with_border = false;
?>