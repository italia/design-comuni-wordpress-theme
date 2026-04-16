<?php
  global $luogo_id;
  $luogo = get_post( $luogo_id );
  $img = dci_get_meta('immagine', '_dci_luogo_', $luogo->ID);

?>
<div class="col-lg-4 col-xl-2">
  <div class="card-wrapper shadow-sm rounded border border-light">
    <div class="card no-after rounded">
      <a href="<?php echo get_permalink($luogo); ?>">
        <div class="card-body" style="padding: 6px 18px">
          <div class="card-icon-content">
            <?php if ($img) { ?>
            <div class="avatar size-xl" style="margin: 0 auto; display: block;">
              <?php dci_get_img($img); ?>
            </div>
            <?php } ?>
            <p style="text-align: center;"><strong><?php echo $luogo->post_title; ?></strong></p>
          </div><!-- /card-icon-content -->
        </div><!-- /card-body -->
      </a>
    </div>
  </div>
</div>
