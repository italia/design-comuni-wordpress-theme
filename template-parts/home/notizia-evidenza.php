<?php
global $scheda;

$post = get_post($scheda)??null;
$img = dci_get_meta('immagine');
$descrizione_breve = dci_get_meta('descrizione_breve');
$icon = dci_get_post_type_icon_by_id($post->ID);

$page = get_page_by_path( dci_get_group($post->post_type) );    

$page_macro_slug = dci_get_group($post->post_type);
$page_macro = get_page_by_path($page_macro_slug);
?>

<?php if ($img) { ?>
<div class="card card-teaser card-teaser-image card-flex no-after rounded shadow-sm border border-light mb-0">
    <div class="card-image-wrapper with-read-more">
        <div class="card-body p-3 u-grey-light">
            <div class="category-top">
            <!-- <svg class="icon">
                <use xlink:href="#<?php #echo $icon ?>"></use>
            </svg> -->
            <span class="category fw-semibold" ><?php echo $page->post_title ?></span>
            </div>
            <h3 class="card-title h5"><?php echo $post->post_title ?></h4>
            <p class="card-text text-secondary" style="margin-bottom: 40px!important;"><?php echo $descrizione_breve ?></p>
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
    <div class="card card-teaser no-after rounded border border-light shadow-sm mb-0">
        <div class="card-body pb-5">
        <div class="category-top">
            <!-- <svg class="icon">
                <use xlink:href="#<?php #echo $icon ?>"></use>
            </svg> -->
            <span class="category title-xsmall-semi-bold fw-semibold"><?php echo $page->post_title ?></span>
        </div>
        <h3 class="card-title h5">
            <?php echo $post->post_title ?>
        </h3>
        <p class="card-text text-secondary">
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