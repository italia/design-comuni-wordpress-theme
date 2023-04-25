<?php
global $argomenti;

if ($argomenti && is_array($argomenti) && count($argomenti) > 0) {
?>
<ul class="d-flex flex-wrap gap-2 mt-10 mb-30">
    <?php foreach ( $argomenti as $item ) { ?>
        <li>
            <a href="<?php echo get_term_link($item); ?>" class="chip chip-simple" data-element="service-topic">
                <span class="chip-label">
                    <?php echo $item->name; ?>
                </span>
            </a>
        </li>
    <?php } ?>
</ul>
<?php } ?>