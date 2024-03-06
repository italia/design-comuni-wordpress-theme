<?php
global $persona_id;

$persona = get_post($persona_id);
$prefix = '_dci_persona_pubblica_';
$immagine = dci_get_meta('foto', $prefix, $persona_id);
$incarichi_id = dci_get_meta('incarichi', $prefix, $persona_id);
?>

<div class="card-body">
    <a href="<?php echo get_permalink($persona->ID); ?>" class="text-decoration-none" data-element="management-category-link" title="Vai al contenuto di <?php echo $persona->post_title; ?>"><h3 class="card-title t-primary title-xlarge"><?php echo $persona->post_title; ?></h3></a>
    <p class="titillium text-paragraph mb-0">
    <?php if ($incarichi_id) {
        foreach ($incarichi_id as $inc_id) {
            echo ' - ' . get_the_title($inc_id);
        }
    } ?>
    </p>
    <br />
    <a class="read-more" href="<?php echo get_permalink($persona->ID); ?>" title="Vai al contenuto di <?php echo $persona->post_title; ?>" data-focus-mouse="false">
        <span class="text">Ulteriori dettagli</span>
        <svg class="icon ms-0"><use xlink:href="#it-arrow-right"></use></svg>
    </a>
</div>



