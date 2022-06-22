<?php
global $post;

?><div class="card card-bg bg-white card-thumb-rounded">
	<div class="card-body">
		<div class="card-content">
			<h4 class="h5"><a href="<?php echo get_term_link($post); ?>"><?php echo $post->name; ?></a></h4>
			<h5>Descrizione argomento</h5>
			<ul>
				<li>Lista</li>
				<li>contenuti</li>
				<li>in</li>
				<li>Listevidenza</li>
			</ul>
			<div class="pt-3">
			<a class="text-underline" href="<?php echo get_term_link($post); ?>">
			<strong>Esplora argomento </strong>
			<svg
				width="16"
				height="17"
				viewBox="0 0 16 16"
				fill="black"
				xmlns="http://www.w3.org/2000/svg"
				class="icon it-arrow-right">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" href="#it-arrow-right"></use>                    
			</svg>
		</a>
		</div>
		</div>
	</div><!-- /card-body -->
</div><!-- /card --><?php
