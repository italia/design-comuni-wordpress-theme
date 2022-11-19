<?php
global $with_page_bottom;
$argomenti = dci_get_argomenti_of_post();
if(count($argomenti)) {?>

<ul class="d-flex flex-wrap gap-1">
    <?php foreach ( $argomenti as $item ) { ?>
        <li>
            <a class="chip chip-simple"
            href="<?php echo get_term_link($item); ?>"
            >
                <span class="chip-label"> 
                    <?php echo $item->name; ?>
                </span>
            </a>
        </li>
    <?php } ?>
</ul>
<?php if ( $with_page_bottom )
    get_template_part("template-parts/single/bottom"); 
?>
<?php }
$with_page_bottom = false;
?>

