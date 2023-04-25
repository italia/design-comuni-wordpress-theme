<?php
global $post_id;
$post = get_post( $post_id );

$prefix = '_dci_persona_pubblica_';
$img = dci_get_meta( 'foto', $prefix, $post_id );
$incarichi_id = dci_get_meta( 'incarichi', $prefix, $post_id );
$contatti = dci_get_meta('punti_contatto', $prefix, $post_id) ;
$post_id = null;
?>


<div class="card card-teaser shadow mt-3 rounded">
	<svg class="icon" aria-hidden="true">
		<use xlink:href="#it-user"></use>
	</svg>
	<div class="card-body">
		<div class="row">
			<div class="col">
				<h3 class="card-title h5">
					<a class="text-decoration-none" href="<?php echo get_permalink( $post->ID ); ?>">
						<?php echo $post->post_title; ?>
					</a>
				</h3>
				<div class="card-text">
					<?php if ( $incarichi_id ) {
						foreach ( $incarichi_id as $inc_id ) {
							echo get_the_title( $inc_id ) . ' - ';
						}
					} 
					if ($contatti && is_array($contatti) && count($contatti)){
						$prefix = '_dci_punto_contatto_';
						$full_contatto = array();
						foreach ($contatti ?? null as $punto_contatto_id) {
							$voci = dci_get_meta('voci', $prefix, $punto_contatto_id);
							foreach ($voci as $voce) {
								$value = $voce[$prefix.'valore'];
								
								switch ($voce[$prefix.'tipo_punto_contatto']){
									case 'email': { 
										echo '<p class="u-main-black">'. ucfirst($voce[$prefix.'tipo_punto_contatto']) .': '; ?>
										<a target="_blank" aria-label="Invia una email a <?php echo $value; ?>"
											title="invia una email a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
											<?php echo $value; ?>
										</a></p>
									<?php }; break; 
									case 'telefono': {
										echo '<p class="u-main-black">'. ucfirst($voce[$prefix.'tipo_punto_contatto']) .': '; 
										echo '<a href="tel:' . $value . '">' . $value . '</a></p>';
									}; break;
									case 'pec': { 
										echo '<p class="u-main-black">'. ucfirst($voce[$prefix.'tipo_punto_contatto']) .': '; ?>
										<a target="_blank" aria-label="Invia una PEC a <?php echo $value; ?>"
											title="invia una PEC a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
											<?php echo $value; ?>
										</a></p>
									<?php }; break;
								} ?>
								</p>
							<?php }
						}
					} ?>
				</div>
			</div>
			<?php if ( $img ) { ?>
				<div class="col-auto">
					<div class="avatar size-xl">
						<?php dci_get_img( $img ); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>