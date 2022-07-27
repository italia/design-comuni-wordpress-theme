<?php 
    global $persone;

    foreach ($persone as $person_id) { 
        $prefix = '_dci_persona_pubblica_';
        $nome = dci_get_meta('nome', $prefix, $person_id);
        $cognome = dci_get_meta('cognome', $prefix, $person_id);
    ?>
    <a class="text-decoration-none" href="<?php echo get_permalink($person_id); ?>" aria-label="Vai alla sezione di <?php echo $nome.' '.$cognome; ?>">
        <div class="chip chip-simple chip-primary">
        <span class="chip-label"><?php echo $nome.' '.$cognome; ?></span>
        </div>
    </a>
<?php } ?>