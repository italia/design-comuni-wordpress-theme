<?php
global $post;

$img = dci_get_meta("immagine", '_dci_notizia_', $post->ID);
$data_pubblicazione = dci_get_meta("data_pubblicazione", '_dci_notizia_', $post->ID);
$arrdata =  explode("-", date('d-m-y',$data_pubblicazione));
$monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
$descrizione_breve = dci_get_meta("descrizione_breve", '_dci_notizia_', $post->ID);
$argomenti = dci_get_meta("argomenti", '_dci_notizia_', $post->ID);

?>

<div
    class="card-wrapper px-0 card-overlapping card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3"
    >
    <div
        class="card card-teaser card-teaser-image card-flex no-after rounded shadow"
    >
        <div class="card-image-wrapper with-read-more pb-5">
            <div class="card-body p-4">
                <div class="category-top">
                <svg class="icon">
                    <use xlink:href="#it-pa"></use>
                </svg>
                <a class="category" href="#"><?php echo $post->post_type ?></a>
                </div>
                <p class="card-title fw-semibold"><?php echo $post->post_title ?></p>
                <p class="card-text"><?php echo $descrizione_breve ?></p>
            </div>
            <div class="card-image card-image-rounded pb-5">
                <?php dci_get_img($img); ?>
            </div>
        </div>

        <a
        class="read-more ps-4"
        href="<?php echo dci_get_template_page_url("page-templates/notizie.php"); ?>"
        >
        <span class="text">Tutte le novità</span>
        <svg class="icon">
            <use xlink:href="#it-arrow-right"></use>
        </svg>
        </a>
    </div>
</div>