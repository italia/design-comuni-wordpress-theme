<?php
global $post;

$description = dci_get_meta('descrizione_breve');
$arrdata = dci_get_data_pubblicazione_arr("data_pubblicazione", '_dci_notizia_', $post->ID);
$monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
$img_url = dci_get_meta('immagine');
$img = get_post(attachment_url_to_postid($img_url));
$tipo = get_the_terms($post, 'tipi_notizia')[0];

if ($img_url ?? null != '') { ?>
    <div class="col-md-6 col-xl-4">
        <div class="card-wrapper border border-light rounded shadow-sm">
            <div class="card no-after rounded">
                <div class="row g-2 g-md-0 flex-md-column">
                    <div class="img-responsive-wrapper">
                        <div class="img-responsive img-responsive-panoramic">
                            <figure class="img-wrapper">
                                <img class="" src="<?= $img->guid ?>" title="<?= $img->post_title ?>"
                                    alt="<?= $img->post_content ?>">
                            </figure>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-body rounded-top">
                            <div class="category-top">
                                <a class="category text-decoration-none" href="<?=  get_term_link($tipo, $tipo->taxonomy); ?>">
                                    <?php echo strtoupper($tipo->name); ?>
                                </a>
                                <span class="data">
                                    <?php echo $arrdata[0] . ' ' . strtoupper($monthName) . ' ' . $arrdata[2] ?>
                                </span>
                            </div>
                            <a href="#" class="text-decoration-none" data-element="news-category-link">
                                <h3 class="card-title">
                                    <?php echo the_title(); ?>
                                </h3>
                            </a>
                            <p class="card-text">
                                <?php echo $description; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="col-md-6 col-xl-4">
        <div class="card-wrapper border border-light rounded shadow-sm">
            <div class="card no-after rounded">
                <div class="row g-2 g-md-0 flex-md-column">
                    <div class="col-12">
                        <div class="card-body rounded-top">
                            <div class="category-top">
                                <a class="category text-decoration-none" href="<?= get_term_link($tipo, $tipo->taxonomy); ?>">
                                    <?php echo strtoupper($tipo->name); ?>
                                </a>
                                <span class="data">
                                    <?php echo $arrdata[0] . ' ' . strtoupper($monthName) . ' ' . $arrdata[2] ?>
                                </span>
                            </div>
                            <a href="<?php echo get_permalink(); ?>" class="text-decoration-none"
                                data-element="news-category-link">
                                <h3 class="card-title">
                                    <?php echo the_title(); ?>
                                </h3>
                            </a>
                            <p class="card-text">
                                <?php echo $description; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>