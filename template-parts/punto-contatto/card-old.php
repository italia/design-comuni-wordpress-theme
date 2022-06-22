<?php
global $punto_contatto;

$valore = dci_get_meta("valore", '_dci_punto_contatto_', $punto_contatto->ID);
$image_url = get_the_post_thumbnail_url($punto_contatto, "item-gallery");
?>

<div class="card-body p-0">
    <div class="cmp-card-img">
        <div class="col-11 col-lg-7 px-0">
            <div class="card card-teaser rounded cmp-card-img__shadow">
                <div class="card-body align-items-center card-body d-flex justify-content-between">
                    <div class="left">
                        <h3 class="title-small"><?php echo $punto_contatto->post_title ?></h3>
                        <p class="subtitle-small">
                            <?php echo $valore ?>
                        </p>
                    </div>
                    <?php if ($image_url) { ?>
                    <div class="right">
                        <svg width="68" height="64" viewBox="0 0 68 64" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="67.5556" height="64" rx="32" fill="url(#pattern0)" />
                            <defs>
                                <pattern
                                id="pattern0"
                                patternContentUnits="objectBoundingBox"
                                width="1"
                                height="1"
                                >
                                <use
                                    xlink:href="#image0_1533_247657"
                                    transform="translate(-0.00096444) scale(0.00496004 0.0052356)"
                                />
                                </pattern>
                                <image
                                id="image0_1533_247657"
                                width="202"
                                height="191"
                                xlink:href="<?php echo $image_url ?>"
                                />
                            </defs>
                        </svg>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>