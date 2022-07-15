<?php
global $with_page_bottom;
$argomenti = dci_get_argomenti_of_post();
if(count($argomenti)) {?>

<div class="col-lg-9 argomenti">
    <?php foreach ( $argomenti as $item ) { ?>
        <div class="chip chip-simple">
            <a 
            class="chip-label" 
            href="<?php echo get_term_link($item); ?>" 
            title="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
            aria-label="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
            >
                <?php echo $item->name; ?>
            </a>
        </div>
    <?php } ?>
</div>
<?php if ( $with_page_bottom )
    get_template_part("template-parts/single/bottom"); 
?>
<?php }
$with_page_bottom = false;
?>

