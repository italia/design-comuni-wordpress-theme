<?php
/**
 * Box correlati per tassonomia argomento
 */
global $post;

$oldpost = $post;
$argomenti = dci_get_argomenti_of_post();
if(count($argomenti)) {
	// estraggo i nomi
	$arr_slugs = array();
	foreach ( $argomenti as $item ) {
		$arr_slugs[] = $item->slug;
	}
  $amount = 4;
	$amministrazione = dci_get_grouped_posts_by_term('amministrazione', 'argomenti', $arr_slugs, $amount);
	$servizi = dci_get_grouped_posts_by_term('servizi', 'argomenti', $arr_slugs, $amount);
	$documenti = dci_get_grouped_posts_by_term('documenti-e-dati', 'argomenti', $arr_slugs, $amount);
	$notizie = dci_get_grouped_posts_by_term('novita', 'argomenti', $arr_slugs, $amount);

	$posts_found = count($amministrazione) + count($servizi) + count($documenti) + count($notizie);


	if ( $posts_found > 0 ) { ?>		
		<section id="contenuti-correlati">
        <div class="section section-muted section-inset-shadow">
          <div class="section-content">
            <div class="container">
              <div class="row">
                <div class="col">
                  <h3 class="text-center">Contenuti correlati</h3>
                </div>
              </div>
              <div class="row mt-lg-4">
                <div class="col">
                  <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-4">
					<?php if ( count($amministrazione) ) { ?>
                    <div class="card card-teaser card-column shadow my-3 rounded">
                      <div class="card-header">
                        <svg class="icon">
                          <use xlink:href="#it-pa"></use>
                        </svg>
                        <h5 class="card-title">
                          Amministrazione
                        </h5>
                      </div>
                      <div class="card-body">
                        <div class="link-list-wrapper mt-3">
                          <ul class="link-list">
                            <?php foreach ($amministrazione as $item) { ?>
                              <li>
                              <a class="list-item" href="<?php echo get_permalink($item->ID); ?>" ><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
					<?php } ?>

					<?php if ( count($servizi) ) { ?>
                    <div class="card card-teaser card-column shadow my-3 rounded">
                      <div class="card-header">
                        <svg class="icon">
                          <use xlink:href="#it-settings"></use>
                        </svg>
                        <h5 class="card-title">
							            Servizi
                        </h5>
                      </div>
                      <div class="card-body">
                        <div class="link-list-wrapper mt-3">
                          <ul class="link-list">
                            <?php foreach ($servizi as $item) { ?>
                              <li>
                              <a class="list-item" href="<?php echo get_permalink($item->ID); ?>" ><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
					<?php } ?>

					<?php if ( count($documenti) ) { ?>
                    <div class="card card-teaser card-column shadow my-3 rounded">
                      <div class="card-header">
                        <svg class="icon">
                          <use xlink:href="#it-file"></use>
                        </svg>
                        <h5 class="card-title">
							            Documenti
                        </h5>
                      </div>
                      <div class="card-body">
                        <div class="link-list-wrapper mt-3">
                          <ul class="link-list">
                            <?php foreach ($documenti as $item) { ?>
                              <li>
                              <a class="list-item" href="<?php echo get_permalink($item->ID); ?>" ><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
					<?php } ?>

					<?php if ( count($notizie) ) { ?>
                    <div class="card card-teaser card-column shadow my-3 rounded">
                      <div class="card-header">
                        <svg class="icon">
                          <use xlink:href="#it-calendar"></use>
                        </svg>
                        <h5 class="card-title">
							            Notizie
                        </h5>
                      </div>
                      <div class="card-body">
                        <div class="link-list-wrapper mt-3">
                          <ul class="link-list">
                            <?php foreach ($notizie as $item) { ?>
                              <li>
                              <a class="list-item" href="<?php echo get_permalink($item->ID); ?>" ><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
          <?php } ?>				
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><?php
	}
}
	$post = $oldpost;