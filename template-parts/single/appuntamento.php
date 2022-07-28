<?php
    global $appuntamento;
    
    $prefix= '_dci_evento_';  
    $img_url = dci_get_meta('immagine', $prefix, $appuntamento->ID);
    $start_timestamp = dci_get_meta("data_orario_inizio", $prefix, $appuntamento->ID);
    $start_date_arr = explode(' ', date_i18n('d F', date($start_timestamp)));
?>

<div class="card-wrapper card-teaser">
    <div class="card card-img no-after">
        <div class="img-responsive-wrapper">
            <div class="img-responsive">
            <figure class="img-wrapper">
                <?php dci_get_img($img_url); ?>
            </figure>
            <div class="card-calendar d-flex flex-column justify-content-center">
                <span class="card-date"><?php echo $start_date_arr[0]; ?></span>
                <span class="card-day"><?php echo $start_date_arr[1]; ?></span>
            </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">
                <a class="text-decoration-none" href="<?php echo get_permalink($appuntamento->ID); ?>">
                <?php echo $appuntamento->post_title; ?></a>
            </h5>
            <p class="card-text"></p>
            <a class="read-more" href="<?php echo get_permalink($appuntamento->ID); ?>" aria-label="leggi di più - <?php echo $appuntamento->post_title; ?>">
            <span class="text">Leggi di più</span>
            <span class="visually-hidden"></span>
            <svg class="icon">
                <use href="#it-arrow-right"></use>
            </svg></a>
        </div>
    </div>
</div>