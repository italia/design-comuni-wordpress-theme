<?php
    $argomenti = dci_get_terms_options('argomenti');
    $arr_ids = array_keys((array)$argomenti);
?>

<div class="container py-5" id="argomento">
    <h2 class="title-xxlarge mb-4">Esplora per argomento</h2>
    <div class="row g-4">       
        <?php foreach ($arr_ids as $arg_id) { 
            $argomento = get_term_by('term_id', $arg_id, 'argomenti');    
        ?>
        <div class="col-md-6 col-xl-4">
            <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
              <div class="card shadow-sm rounded">
                <div class="card-body">
                    <a class="text-decoration-none" href="<?php echo get_term_link($argomento->term_id); ?>" data-element="topic-element"><h3 class="card-title t-primary title-xlarge"><?php echo $argomento->name; ?></h3></a>
                    <p class="titillium text-paragraph mb-0 description">
                        <?php echo $argomento->description; ?>
                    </p>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
    </div>
</div>