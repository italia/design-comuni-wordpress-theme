<?php
global $gallery;
?>
 <div class="it-carousel-wrapper it-carousel-landscape-abstract-three-cols splide" data-bs-carousel-splide>
	<div class="it-header-block">
		<div class="it-header-block-title">
			<h3 class="h4">Galleria di immagini</h4>
		</div>
	</div>
	<div class="splide__track">
		<ul class="splide__list it-carousel-all">
		<?php
			foreach ($gallery as $ida=>$urlg){
				$attach = get_post($ida);
				$imageatt =  wp_get_attachment_image_src($ida, "item-gallery");

				?>
				<li class="splide__slide">
					<div class="it-single-slide-wrapper">
						<figure>
						<img src="<?php echo $urlg; ?>" alt="<?php echo esc_attr($attach->post_title); ?>" class="img-fluid">
						<figcaption class="figure-caption mt-2"><?php echo $attach->post_title; ?></figcaption>
						</figure>
					</div>
				</li>
		<?php } ?>                            
		</ul>
	</div>
</div>
