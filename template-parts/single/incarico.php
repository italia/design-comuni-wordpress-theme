<?php
global $incarico, $incarichi;

foreach ($incarichi as $incarico_id) {
  $prefix = '_dci_incarico_';
  $data = dci_get_meta('data_inizio_incarico', $prefix, $incarico_id);
  $titolo = get_the_title($incarico_id);


?>
  <a class="text-decoration-none" href="<?php echo get_permalink($incarico_id); ?>">
    <div class="card card-teaser shadow mt-3 rounded">
      <div class="card-body">
        <h5 class="card-title">
          <span class="chip-label"> <?php echo $titolo; ?></span>
        </h5>
      </div>
    </div>

  </a>
<?php } ?>