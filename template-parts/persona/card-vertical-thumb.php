<?php
global $persona_id;

$persona = get_post($persona_id);
$prefix = '_dci_persona_pubblica_';
$immagine = dci_get_meta('foto', $prefix, $persona_id);
$organizzazioni_id = dci_get_meta('organizzazioni', $prefix, $persona_id);
$incarichi_id = dci_get_meta('incarichi', $prefix, $persona_id);

?>
<div class="card no-after card-bg card-vertical-thumb bg-white">
    <div class="row g-0">
        <div class="col-md-8">
            <div class="card-body">
                <?php if ($organizzazioni_id) { ?>
                    <h5 class="card-title">
                        <?php
                        foreach ($organizzazioni_id as $org_id) {
                            $organizzazione = get_post($org_id);
                            echo '<a href="' . get_the_permalink($org_id) . '">' . get_the_title($org_id) . '</a>';
                        } ?>
                    </h5>
                <?php } ?>
                <h4><a href="<?php echo get_permalink($persona); ?>"><?php echo get_the_title($persona); ?></a></h4>
                <?php if ($incarichi_id) {
                    foreach ($incarichi_id as $inc_id) {
                        echo get_the_title($inc_id) . ' - ';
                    }
                } ?>
            </div>
        </div>
        <div class="col">
            <img class="img-fluid float-end" src="<?php echo $immagine; ?>" alt="<?php echo esc_attr(get_the_title($persona)); ?>">
        </div>
    </div>
</div>