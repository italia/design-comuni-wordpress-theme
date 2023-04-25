<?php
global $post_id;
$prefix = '_dci_punto_contatto_';

$full_contatto = dci_get_full_punto_contatto( $post_id );
$contatto = get_post( $post_id );
$voci = dci_get_meta( 'voci', $prefix, $post_id );

$other_contacts = array(
	'linkedin',
	'pec',
	'skype',
	'telegram',
	'twitter',
	'whatsapp'
);
?>


<div class="card card-teaser shadow mt-3 rounded">
	<svg class="icon" aria-hidden="true">
		<use xlink:href="#it-telephone"></use>
	</svg>
	<div class="card-body">
		<h3 class="card-title h5">
			<a class="text-decoration-none" href="#">
				<?php echo $contatto->post_title; ?>
			</a>
		</h3>
		<div class="card-text">
			<?php if ( is_array( $full_contatto['indirizzo'] ?? null ) && count( $full_contatto['indirizzo'] ) ) {
				foreach ( $full_contatto['indirizzo'] as $value ) {
					echo '<p class="u-main-black">Indirizzo: ' . $value . '</p>';
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