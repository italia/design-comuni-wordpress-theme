<?php
global $argomenti;
$arr_ids = array_keys((array)$argomenti);


if ($arr_ids && is_array($arr_ids) && count($arr_ids) > 0) {
    foreach ($argomenti as $argomento) { ?>
        <a class="text-decoration-none" href="<?php echo get_term_link($argomento->term_id); ?>" data-element="topic-element">
            <div class="chip chip-simple chip-primary">
                <span class="chip-label"><?php echo $argomento->name; ?></span>
            </div>
        </a>
<?php }
}
?>