<?php
global $post;

$img = dci_get_meta('immagine');
$descrizione_breve = dci_get_meta('descrizione_breve');
$icon = dci_get_post_type_icon_by_id($post->ID);
$arrdata           = dci_get_data_pubblicazione_arr( "data_pubblicazione", '_dci_notizia_', $post->ID );
$monthName         = date_i18n( 'M', mktime( 0, 0, 0, $arrdata[1], 10 ) );

$page = get_page_by_path( dci_get_group($post->post_type) );    

$page_macro_slug = dci_get_group($post->post_type);
$page_macro = get_page_by_path($page_macro_slug);
?>

<?php if ($img) { ?>
<div class="card card-teaser card-teaser-image card-flex no-after rounded shadow-sm border border-light mb-0">
    <div class="card-image-wrapper with-read-more">
        <div class="card-body p-3 u-grey-light">
            <div class="category-top">
                <svg class="icon icon-sm" aria-hidden="true">
                    <use xlink:href="#it-calendar"></use>
                </svg>
                <span class="title-xsmall-semi-bold fw-semibold"><?php echo $post->post_type ?></span>
	            <?php if ( is_array( $arrdata ) && count( $arrdata ) ) { ?>
                    <span class="data fw-normal"><?php echo $arrdata[0] . ' ' . $monthName . ' ' . $arrdata[2]; ?></span>
	            <?php } ?>
            </div>
<!--            <p class="card-title text-paragraph-medium u-grey-light">--><?php //echo $post->post_title ?><!--</p>-->
            <a class="card-title text-paragraph-medium" href="<?php echo get_permalink($post->ID); ?>" aria-label="Vai alla pagina <?php echo $post->post_title ?>" title="Vai alla pagina <?php echo $post->post_title ?>">
                <span class="text"><?php echo $post->post_title ?></span>
            </a>
            <p class="text-paragraph-card u-grey-light m-0" style="margin-bottom: 40px!important;"><?php echo $descrizione_breve ?></p>
        </div>
        <div class="card-image card-image-rounded pb-5">            
            <?php dci_get_img($img); ?>
        </div>
    </div>
    <a
    class="read-more ps-3"
    href="<?php echo get_permalink($post->ID); ?>"
    aria-label="Vai alla pagina <?php echo $post->post_title ?>" 
    title="Vai alla pagina <?php echo $post->post_title ?>"
    >
        <span class="text">Vai alla pagina</span>
        <svg class="icon">
            <use xlink:href="#it-arrow-right"></use>
        </svg>
    </a>
</div>
<?php } else { ?>
    <div class="card card-teaser no-after rounded shadow-sm mb-0">
        <div class="card-body pb-5">
        <div class="category-top">
            <!-- <svg class="icon">
                <use xlink:href="#<?php #echo $icon ?>"></use>
            </svg> -->
            <span class="category title-xsmall-semi-bold fw-semibold"><?php echo $page->post_title ?></span>
        </div>
<!--        <p class="card-title text-paragraph-medium u-grey-light">-->
<!--            --><?php //echo $post->post_title ?>
<!--        </p>-->
            <a class="card-title text-paragraph-medium" href="<?php echo get_permalink($post->ID); ?>" aria-label="Vai alla pagina <?php echo $post->post_title ?>" title="Vai alla pagina <?php echo $post->post_title ?>">
                <span class="text"><?php echo $post->post_title ?></span>
            </a>
        <p class="text-paragraph-card u-grey-light m-0">
            <?php echo $descrizione_breve ?>
        </p>
        </div>
        <a class="read-more" href="<?php echo get_permalink($post->ID); ?>" aria-label="Vai alla pagina <?php echo $post->post_title ?>" title="Vai alla pagina <?php echo $post->post_title ?>"
        ><span class="text">Vai alla pagina</span>
        <svg class="icon ms-0">
            <use
            xlink:href="#it-arrow-right"
            ></use></svg></a>
    </div>
<?php } ?>