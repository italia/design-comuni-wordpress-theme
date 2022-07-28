<?php
    global $uo_id, $with_border;
    $ufficio = get_post( $uo_id );

    $prefix = '_dci_unita_organizzativa_';
    $img = dci_get_meta('immagine', $prefix, $uo_id);
    $contatti = dci_get_meta('contatti', $prefix, $uo_id);

    $prefix = '_dci_punto_contatto_';
    $indirizzi = array();
    foreach ($contatti as $punto_contatto_id) {
        $voci = dci_get_meta('voci', $prefix, $punto_contatto_id);
        foreach ($voci as $voce) {
            if ($voce[$prefix.'tipo_punto_contatto'] == 'indirizzo')
                array_push($indirizzi, $voce[$prefix.'valore']);
        }
    }
    
    if($with_border) {
?>

<div class="card card-teaser card-teaser-info rounded shadow-sm p-3">
    <div class="card-body pe-3">
        <p class="card-title text-paragraph-regular-medium-semi mb-3">
            <a class="text-decoration-none" href="<?php echo get_permalink($ufficio->ID); ?>" data-element="service-area">
            <?php echo $ufficio->post_title; ?>
            </a>
        </p>
        <div class="card-text">
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
            <a class="text-decoration-none" href="<?php echo get_permalink($ufficio->ID); ?>">
            <?php echo $ufficio->post_title; ?>
            </a>
        </h4>
        <div class="card-text">
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