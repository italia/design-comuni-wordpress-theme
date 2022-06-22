<?php 
global $sito_tematico_id, $count; 

$siti_tematici = dci_get_option('siti_tematici','homepage');
if(is_array($siti_tematici) && count($siti_tematici)) {
?>

<div class="container">
  <div class="row pt-5">
    <h3>Siti tematici</h3>
  </div>
  <div class="py-4">
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
