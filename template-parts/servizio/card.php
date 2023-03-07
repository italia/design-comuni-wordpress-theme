<?php
global $servizio, $hide_categories;

$prefix = '_dci_servizio_';
$categorie = get_the_terms($servizio->ID, 'categorie_servizio');
$descrizione_breve = dci_get_meta('descrizione_breve', $prefix, $servizio->ID);

if($servizio->post_status == "publish") {
    ?>
        <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
            <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                <?php if (!$hide_categories) { ?>
                <span class="visually-hidden">Categoria:</span>
                <div class="card-header border-0 p-0">
                    <?php if (is_array($categorie) && count($categorie)) {
                        $count = 1;
                        foreach ($categorie as $categoria) {
                            echo $count == 1 ? '' : ' - ';
                            echo '<a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="'.get_term_link($categoria->term_id).'">';
                            echo $categoria->name ;                                    
                            echo '</a>';
                            ++$count;
                        }
                    }                        
                    ?>
                </div>
                <?php } ?>
                <div class="card-body p-0 my-2">
                <h3 class="green-title-big t-primary mb-8">
                    <a class="text-decoration-none" href="<?php echo get_permalink($servizio->ID); ?>" data-element="service-link"><?php echo $servizio->post_title; ?></a>
                </h3>
                <p class="text-paragraph">
                    <?php echo $descrizione_breve; ?>
                </p>
                </div>
            </div>
        </div>
    <?php
}