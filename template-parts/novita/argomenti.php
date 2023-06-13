<?php
    $argomenti = get_terms('tipi_notizia', array(
        'hide_empty' => false,
    ) );
?>

<div class="container py-5" id="argomento">
  <h2 class="title-xxlarge mb-4">Esplora per categoria</h2>
  <div class="row g-4">
    <?php foreach ($argomenti as $argomento) { 
        ?>
    <div class="col-md-6 col-xl-4">
      <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
        <div class="card shadow-sm rounded">
          <div class="card-body">
            <a class="text-decoration-none" href="<?php echo get_term_link($argomento->term_id); ?>"
              data-element="news-category-link">
              <h3 class="card-title t-primary title-xlarge"><?php echo ucfirst($argomento->name); ?></h3>
            </a>
            <p class="text-secondary mb-0">
              <?php echo $argomento->description; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>