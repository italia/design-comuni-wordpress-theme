<?php
global $post;

$descrizione = dci_get_meta('descrizione_breve', '_dci_notizia_',$post->ID);
$icon = dci_get_post_type_icon_by_id($post->ID);
?>

<div class="col-12 col-sm-6 col-lg-4">
    <article class="card-wrapper card-space">
        <div class="card card-bg card-big rounded shadow">
            <div class="flag-icon invisible"></div>
            <div class="etichetta">
            <svg class="icon">
                <use
                xlink:href="#<?php echo $icon; ?>"
                ></use>
            </svg>
            <span>Notizie</span>
            </div>
            <div class="card-body">
            <h5 class="card-title"><?php echo $post->post_title ?></h5>
            <p class="card-text">
                <?php echo $descrizione ?>
            </p>
            <a class="read-more" href="<?php echo get_permalink($post->ID); ?>"
                ><span class="text">Leggi di più</span>
                <svg class="icon">
                <use
                    xlink:href="#it-arrow-right"
                ></use></svg></a>
            </div>
        </div>
    </article>
</div>  