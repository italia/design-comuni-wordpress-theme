<?php 
    global $persone;

    if ($persone && is_array($persone) && count($persone)>0) { ?>
        <ul class="d-flex flex-wrap gap-1 mt-2">
            <?php foreach ($persone as $person_id) { 
                $prefix = '_dci_persona_pubblica_';
                $nome = dci_get_meta('nome', $prefix, $person_id);
                $cognome = dci_get_meta('cognome', $prefix, $person_id); ?>
                <li>
                    <a class="chip chip-simple" href="<?php echo get_permalink($person_id); ?>">
                        <span class="chip-label"><?php echo $nome.' '.$cognome; ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php }
?>