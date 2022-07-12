<?php
global $post;

$image_url = get_the_post_thumbnail_url($post, "article-simple-thumb");



$excerpt =  dci_get_meta("descrizione", "", $post->ID);
if(!$excerpt)
    $excerpt = get_the_excerpt($post);

// $argomenti = dci_get_argomenti_of_post();

?>

<article class="card card-bg card-article cursorhand" onclick="document.location.href='<?php the_permalink(); ?>';">
    <div class="card-body">
        <div class="card-article-img"  <?php if($image_url) echo 'style="background-image: url(\''.$image_url.'\');"'; ?>>
            <div class="date">
                <span class="year"><?php echo date_i18n("Y", strtotime($post->post_date)); ?></span>
                <span class="day"><?php echo date_i18n("d", strtotime($post->post_date)); ?></span>
                <span class="month"><?php echo date_i18n("M", strtotime($post->post_date)); ?></span>
            </div>
        </div>
        <div class="card-article-content">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo $excerpt; ?></p>
            <?php /* if(count($argomenti)) { ?>
                    <div class="badges">
                        <?php foreach ( $argomenti as $item ) { ?>
                            <a href="<?php echo get_term_link($item); ?>" title="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
                               class="badge badge-sm badge-pill badge-outline-<?php echo $class; ?>"><?php echo $item->name; ?></a>
                        <?php } ?>
                    </div><!-- /badges -->
                <?php } */ ?>
        </div><!-- /card-avatar-content -->
    </div><!-- /card-body -->
</article><!-- /card card-bg card-article -->