<?php
    global $post_id;
    $post = get_post( $post_id );
	

    $prefix = '_dci_unita_organizzativa_';
    $competenze = dci_get_meta('competenze', $prefix, $post_id);

    $img = dci_get_meta('immagine', $prefix, $post_id);
    $contatti = dci_get_meta('contatti', $prefix, $post_id);
	$post_id = null;

    $prefix = '_dci_punto_contatto_';
    $full_contatto = array();
    foreach ($contatti ?? null as $punto_contatto_id) {
        $voci = dci_get_meta('voci', $prefix, $punto_contatto_id);
        foreach ($voci as $voce) {
            if ($voce[$prefix.'tipo_punto_contatto'] == 'indirizzo')
                array_push($full_contatto, $voce[$prefix.'valore']);
        }
    }
?>


<div class="card card-teaser shadow mt-3 rounded">
	<svg class="icon" aria-hidden="true">
		<use xlink:href="#it-pa"></use>
	</svg>
	<div class="card-body">
		<h3 class="card-title h5">
			<a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>">
				<?php echo $post->post_title; ?>
			</a>
		</h3>
		<div class="card-text">
			<?php if ($competenze) {
		        echo '<p class="u-main-black">'.$competenze.'</p>';
	        } ?>
			<?php if ( is_array( $full_contatto['indirizzo'] ?? null ) && count( $full_contatto['indirizzo'] ) ) {
				foreach ( $full_contatto['indirizzo'] as $value ) {
					echo '<p class="u-main-black">' . $value . '</p>';
				}
			} ?>
			<?php if ( is_array( $full_contatto['telefono'] ?? null ) && count( $full_contatto['telefono'] ) ) {
				foreach ( $full_contatto['telefono'] as $value ) {
					echo '<p class="u-main-black">Telefono: <a href="tel:' . $value . '">' . $value . '</a></p>';
				}
			} ?>
			<?php if ( is_array( $full_contatto['url'] ?? null ) && count( $full_contatto['url'] ) ) {
				foreach ( $full_contatto['url'] as $value ) { ?>
					<p class="u-main-black">
						<a target="_blank"
							aria-label="scopri di più su <?php echo $value; ?> - link esterno - apertura nuova scheda"
							title="vai sul sito <?php echo $value; ?>" href="<?php echo $value; ?>">
							<?php echo $value; ?>
						</a>
					</p>
				<?php }
			} ?>
			<?php if ( is_array( $full_contatto['email'] ?? null ) && count( $full_contatto['email'] ) ) {
				foreach ( $full_contatto['email'] as $value ) {
					echo '<p class="u-main-black">Email: '; ?>
					<a target="_blank" aria-label="invia un'email a <?php echo $value; ?>"
						title="invia un'email a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
						<?php echo $value; ?>
					</a>
					</p>
				<?php }
			} ?>
			<?php if ( is_array( $full_contatto['pec'] ?? null ) && count( $full_contatto['pec'] ) ) {
				foreach ( $full_contatto['pec'] as $value ) {
					echo '<p class="u-main-black">PEC: '; ?>
					<a target="_blank" aria-label="invia una PEC a <?php echo $value; ?>"
						title="invia una PEC a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
						<?php echo $value; ?>
					</a>
					</p>
				<?php }
			} ?>
			<?php if ( is_array( $other_contacts ?? null ) && count( $other_contacts ) ) {
			foreach ( $other_contacts as $type ) {
				if ( is_array( $full_contatto[ $type ] ?? null ) && count( $full_contatto[ $type ] ) ) {
					foreach ( $full_contatto[ $type ] as $value ) {
						echo '<p class="u-main-black">' . $type . ': ' . $value . '</p>';
					}
				}
			} }?>
		</div>
	</div>
</div>