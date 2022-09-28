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
  $amount = 10;
	$amministrazione = dci_get_grouped_posts_by_term('amministrazione', 'argomenti', $arr_slugs, $amount);
	$servizi = dci_get_grouped_posts_by_term('servizi', 'argomenti', $arr_slugs, $amount);
	$documenti = dci_get_grouped_posts_by_term('documenti-e-dati', 'argomenti', $arr_slugs, $amount);
	$notizie = dci_get_grouped_posts_by_term('novita', 'argomenti', $arr_slugs, $amount);

	$posts_found = count($amministrazione) + count($servizi) + count($documenti) + count($notizie);


	if ( $posts_found > 0 ) { ?>		

        <section id="contenuti-correlati" class="bg-grey-card shadow-contacts">
          <div class="container pt-5">
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
                          <svg class="icon icon-md" aria-hidden="true" >
                            <use href="#it-pa"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Amministrazione</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                            <?php foreach (array_slice($amministrazione, 0, 4) as $item) { ?>
                              <li>
                              <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                            <?php if (count($amministrazione) > 4) { ?>
                                <li>
                                  <a class="show-more px-0" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <span class="show-more d-flex align-items-center">Vedi altri <?php echo count($amministrazione) - 4;?>
                                      <svg class="icon icon-primary icon-md">
                                        <use href="#it-expand"></use>
                                      </svg>
                                    </span>
                                  </a>
                                  <ul class="collapse" id="collapseExample">
                                  <?php foreach (array_slice($amministrazione, 4) as $item) { ?>
                                  <li>
                                    <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                                  </li>
                                  <?php } ?>
                                  </ul>
                                </li>
                              <?php }?>
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
                          <svg class="icon icon-md" aria-hidden="true" >
                            <use href="#it-pa"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Servizi</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                            <?php foreach (array_slice($servizi, 0, 4) as $item) { ?>
                              <li>
                              <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                            <?php if (count($servizi) > 4) { ?>
                                <li>
                                  <a class="show-more px-0" data-bs-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                    <span class="show-more d-flex align-items-center">Vedi altri <?php echo count($servizi) - 4;?>
                                      <svg class="icon icon-primary icon-md">
                                        <use href="#it-expand"></use>
                                      </svg>
                                    </span>
                                  </a>
                                  <ul class="collapse" id="collapseExample2">
                                  <?php foreach (array_slice($servizi, 4) as $item) { ?>
                                  <li>
                                    <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                                  </li>
                                  <?php } ?>
                                  </ul>
                                </li>
                              <?php }?>
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
                          <svg class="icon icon-md" aria-hidden="true" >
                            <use href="#it-pa"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Documenti</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                            <?php foreach (array_slice($documenti, 0, 4) as $item) { ?>
                              <li>
                              <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                            <?php if (count($documenti) > 4) { ?>
                                <li>
                                  <a class="show-more px-0" data-bs-toggle="collapse" href="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                    <span class="show-more d-flex align-items-center">Vedi altri <?php echo count($documenti) - 4;?>
                                      <svg class="icon icon-primary icon-md">
                                        <use href="#it-expand"></use>
                                      </svg>
                                    </span>
                                  </a>
                                  <ul class="collapse" id="collapseExample3">
                                  <?php foreach (array_slice($documenti, 4) as $item) { ?>
                                  <li>
                                    <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                                  </li>
                                  <?php } ?>
                                  </ul>
                                </li>
                              <?php }?>
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
                          <svg class="icon icon-md" aria-hidden="true" >
                            <use href="#it-pa"></use>
                          </svg>
                          <span class="ms-3 cmp-carousel__header-title">Notizie</span>
                        </div>
                        <div class="card-body">
                          <div class="link-list-wrapper">
                            <ul class="link-list card-body__list">
                            <?php foreach (array_slice($notizie, 0, 4) as $item) { ?>
                              <li>
                              <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                              </li>
                            <?php } ?>
                            <?php if (count($notizie) > 4) { ?>
                                <li>
                                  <a class="show-more px-0" data-bs-toggle="collapse" href="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4">
                                    <span class="show-more d-flex align-items-center">Vedi altri <?php echo count($notizie) - 4;?>
                                      <svg class="icon icon-primary icon-md">
                                        <use href="#it-expand"></use>
                                      </svg>
                                    </span>
                                  </a>
                                  <ul class="collapse" id="collapseExample4">
                                  <?php foreach (array_slice($notizie, 4) as $item) { ?>
                                  <li>
                                    <a class="list-item px-0" href="<?php echo get_permalink($item->ID); ?>"><span><?php echo $item->post_title; ?></span></a>
                                  </li>
                                  <?php } ?>
                                  </ul>
                                </li>
                              <?php }?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
              </div>
              <span class="hr-shadow-sm d-none d-lg-block"></span>
            </div>
          </div>
        </section>

		<?php
	}
}
	$post = $oldpost;