<?php
global $post, $autore;
$autore = get_user_by("ID", $post->post_author);

$image_url = dci_get_meta("foto", $prefix, $post->ID);
var_dump($image_url);

?>
<div class=""
<div class="card card-bg card-vertical-thumb bg-white card-thumb-rounded">
	<div class="card-body">
		<div class="card-content">
			<h4 class="h5"><a href="<?php echo get_permalink($post); ?>"><?php echo get_the_title($post); ?></a></h4>
			<p><?php echo get_the_excerpt($post); ?></p>
		</div>
		<?php if($image_url) { ?>
			<div class="card-thumb">
				<img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>">
			</div>
		<?php  } ?>
	</div><!-- /card-body -->
</div><!-- /card --><?php
