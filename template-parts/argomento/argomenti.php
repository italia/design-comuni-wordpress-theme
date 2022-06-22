<?php
    $argomenti = dci_get_terms_options('argomenti');
    $arr_ids = array_keys((array)$argomenti);
?>

<div class="container px-4" id="argomento">
    <h2 class="title-xxlarge mt-40 mt-lg-60 mb-4 mb-lg-40">
        Esplora per argomento
    </h2>
    <div class="row flex-wrap justify-content-start gy-4 pb-40 pb-lg-60 mb-lg-1 align-items-stretch">       
        <?php foreach ($arr_ids as $arg_id) { 
            $argomento = get_term_by('term_id', $arg_id, 'argomenti');    
        ?>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
              <div class="card shadow-sm">
                <div class="card-body">
                    <a href="<?php echo get_term_link($argomento->term_id); ?>" aria-label="Vai all'argomento <?php echo $argomento->name; ?>" title="Vai all'argomento <?php echo $argomento->name; ?>"><h3 class="card-title t-primary title-xlarge"><?php echo $argomento->name; ?></h3></a>
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