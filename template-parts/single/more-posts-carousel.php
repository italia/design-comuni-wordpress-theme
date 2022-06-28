<?php
/**
 * Box correlati per tassonomia argomento
 */
global $post;

$oldpost = $post;
$argomenti = dci_get_argomenti_of_post();
if(count($argomenti)) {
	// estraggo gli slugs
	$arr_ids = array();
	foreach ( $argomenti as $item ) {
		$arr_ids[] = $item->slug;
	}
  $amount = 4;
	$amministrazione = dci_get_grouped_posts_by_term('amministrazione', 'argomenti', $arr_ids, $amount);
	$servizi = dci_get_grouped_posts_by_term('servizi', 'argomenti', $arr_ids, $amount);
	$documenti = dci_get_grouped_posts_by_term('documenti-e-dati', 'argomenti', $arr_ids, $amount);
	$notizie = dci_get_grouped_posts_by_term('novita', 'argomenti', $arr_ids, $amount);

	$posts_found = count($amministrazione) + count($servizi) + count($documenti) + count($notizie);


	if ( $posts_found > 0 ) { ?>		

    <div class="bg-grey-card shadow-contacts">
      <div class="container">
        <div class="row">
          <div class="col-12 pt-5">
            <div class="it-carousel-wrapper carousel-4-card splide cmp-carousel" data-bs-carousel-splide>
              <div class="it-header-block">
                <div class="it-header-block-title">
                  <h2 class="text-center border-0 cmp-carousel__title pb-0 pb-0">Contenuti correlati</h2>
                </div>
              </div>
              <div class="splide__track">
                <ul class="splide__list it-carousel-all">
					        <?php if ( count($amministrazione) ) { ?>
                  <li class="splide__slide">
                    <div class="card-wrapper card-space h-100 pb-4">
                      <div class="card card-bg single-card rounded shadow-sm">
                        <div class="cmp-carousel__header">
                          <svg class="icon icon-md">
                            <use href="#it-pa"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Amministrazione</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                            <?php foreach ($amministrazione as $item) { ?>
                              <li>
                              <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>" title="vai alla sezione amministrazione - <?php echo $item->post_title; ?>" aria-label="vai alla sezione amministrazione - <?php echo $item->post_title; ?>"><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
					        <?php } ?>
					        <?php if ( count($servizi) ) { ?>
                  <li class="splide__slide">
                    <div class="card-wrapper card-space h-100 pb-4">
                      <div class="card card-bg single-card rounded shadow-sm">
                        <div class="cmp-carousel__header">
                          <svg class="icon icon-md">
                            <use href="#it-settings"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Servizi</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                              <?php foreach ($servizi as $item) { ?>
                                <li>
                                <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>" title="vai alla sezione servizi - <?php echo $item->post_title; ?>" aria-label="vai alla sezione servizi - <?php echo $item->post_title; ?>"><span><?php echo $item->post_title; ?></span></a>
                                </li>
                              <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
					        <?php } ?>
					        <?php if ( count($documenti) ) { ?>
                  <li class="splide__slide">
                    <div class="card-wrapper card-space h-100 pb-4">
                      <div class="card card-bg single-card rounded shadow-sm">
                        <div class="cmp-carousel__header">
                          <svg class="icon icon-md">
                            <use href="#it-file"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Documenti</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                              <?php foreach ($documenti as $item) { ?>
                                <li>
                                <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>" title="vai alla sezione documenti - <?php echo $item->post_title; ?>" aria-label="vai alla sezione documenti - <?php echo $item->post_title; ?>"><span><?php echo $item->post_title; ?></span></a>
                                </li>
                              <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
					        <?php } ?>
					        <?php if ( count($notizie) ) { ?>
                  <li class="splide__slide">
                    <div class="card-wrapper card-space h-100 pb-4">
                      <div class="card card-bg single-card rounded shadow-sm">
                        <div class="cmp-carousel__header">
                          <svg class="icon icon-md">
                            <use href="#it-calendar"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Notizie</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                              <?php foreach ($notizie as $item) { ?>
                                <li>
                                <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>" title="vai alla sezione notizie - <?php echo $item->post_title; ?>" aria-label="vai alla sezione notizie - <?php echo $item->post_title; ?>"><span><?php echo $item->post_title; ?></span></a>
                                </li>
                              <?php } ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
					        <?php } ?>
                </ul>
              </div>
              <span class="hr-shadow-sm d-none d-lg-block">
            </span></div>
          </div>
        </div>
      </div>
    </div>

		<?php
	}
}
	$post = $oldpost;