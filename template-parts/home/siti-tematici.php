<?php
global $sito_tematico_id, $count;

$siti_tematici = dci_get_option('siti_tematici','homepage');
if(is_array($siti_tematici) && count($siti_tematici)) {
?>

<div class="container">
  <div class="row pt-5">
    <h2 class="mb-0 u-grey-light">Siti tematici</h2>
  </div>
  <div class="pt-4 pt-lg-30">
    <div
      class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3"
    >
      <?php
      $count = 0;
      foreach ($siti_tematici as $sito_tematico_id) {
        get_template_part("template-parts/sito-tematico/card");
        ++$count;
      } ?>
    </div>
  </div>
</div>
<?php } ?>
