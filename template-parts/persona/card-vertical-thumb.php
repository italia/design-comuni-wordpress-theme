<?php
global $persona_id;

$persona = get_post($persona_id);
$prefix = '_dci_persona_pubblica_';
$immagine = dci_get_meta('foto', $prefix, $persona_id);
$organizzazioni_id = dci_get_meta('organizzazioni', $prefix, $persona_id);
$incarichi_id = dci_get_meta('incarichi', $prefix, $persona_id);

?>
<div class="card no-after shadow-sm  rounded">
    <div class="row g-0">
        <div class="col-md-8 px-4 pt-4 pb-4">
            <?php if ($organizzazioni_id && is_array($organizzazioni_id) && count($organizzazioni_id)) { ?>
                <span class="visually-hidden">Categoria:</span>
                <div class="card-header border-0 p-0">
                    <?php $count = 1;
                    foreach ($organizzazioni_id as $org_id) {
                        echo $count == 1 ? '' : ' - ';
                        echo '<a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="' . get_the_permalink($org_id) . '">';
                        echo get_the_title($org_id);
                        echo '</a>';
                        ++$count;
                    } ?>
                </div>
            <?php } ?>

            <div class="card-body p-0 my-2">
                <h3 class="green-title-big t-primary mb-8">
                    <a class="text-decoration-none" href="<?php echo get_permalink($persona); ?>" data-element="service-link"><?php echo get_the_title($persona); ?></a>
                </h3>
                <p class="text-paragraph">
                    <?php if ($incarichi_id && is_array($incarichi_id) && count($incarichi_id)) {
                        $count = 1;
                        foreach ($incarichi_id as $inc_id) {
                            echo $count == 1 ? '' : ' - ';
                            echo get_the_title($inc_id);
                            ++$count;
                        }
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="col">
            <img class="img-fluid float-end" src="<?php echo $immagine; ?>" alt="<?php echo esc_attr(get_the_title($persona)); ?>">
        </div>
    </div>
</div>