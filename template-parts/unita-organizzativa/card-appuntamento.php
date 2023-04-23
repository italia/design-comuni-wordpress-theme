<?php
global $pc_id;
$prefix = '_dci_punto_contatto_';

$full_contatto = dci_get_full_punto_contatto($pc_id);
$contatto = get_post($pc_id);
$voci = dci_get_meta('voci', $prefix, $pc_id);

$other_contacts = array(
    'linkedin',
    'skype',
    'telegram',
    'twitter',
    'whatsapp'
);

?>
<div class="card rounded mt-3 has-bg-grey">
    <div class="card-body richtext-wrapper">
        <h3><?php echo $contatto->post_title; ?></h3>
        <div class="card-text">
            <?php if (isset($full_contatto['indirizzo']) && is_array($full_contatto['indirizzo']) && count($full_contatto['indirizzo'])) {
                echo '<p class="mb-2">';
                foreach ($full_contatto['indirizzo'] as $value) {
                    echo $value . '</br>';
                }
                echo '</p>';
            } ?>
            <?php if (isset($full_contatto['telefono']) && is_array($full_contatto['telefono']) && count($full_contatto['telefono'])) {
                echo '<p class="mb-2">';
                foreach ($full_contatto['telefono'] as $value) {
                    echo 'Telefono: ' . $value . '</br>';
                }
                echo '</p>';
            } ?>
            <?php if (isset($full_contatto['url']) && is_array($full_contatto['url']) && count($full_contatto['url'])) {
                echo '<p class="mb-2">';
                foreach ($full_contatto['url'] as $value) { ?>
                    <a target="_blank" aria-label="scopri di più su <?php echo $value; ?> - link esterno - apertura nuova scheda" title="vai sul sito <?php echo $value; ?>" href="<?php echo $value; ?>">
                        <?php echo $value; ?>
                    </a>
            <?php }
                echo '</p>';
            } ?>
            <?php if (isset($full_contatto['email']) && is_array($full_contatto['email']) && count($full_contatto['email'])) {
                echo '<p class="mb-2">';
                foreach ($full_contatto['email'] as $value) {
	                echo '<p>Email: ' ; ?>
                    <a target="_blank" aria-label="invia un'email a <?php echo $value; ?>" title="invia un'email a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
                        <?php echo $value; ?>
                    </a>
            <?php }
                echo '</p>';
            } ?>
	        <?php if ( is_array($full_contatto['pec'] ?? null)  && count ($full_contatto['pec']) ) {
		        foreach ($full_contatto['pec'] as $value) {
			        echo '<p>PEC: ' ; ?>
                    <a
                            target="_blank"
                            aria-label="invia una PEC a <?php echo $value; ?>"
                            title="invia una PEC a <?php echo $value; ?>"
                            href="mailto:<?php echo $value; ?>">
				        <?php echo $value; ?>
                    </a>
                    </p>
		        <?php }
	        } ?>
            <?php foreach ($other_contacts as $type) {
                echo '<p class="mb-2">';
                if (isset($full_contatto[$type]) && is_array($full_contatto[$type]) && count($full_contatto[$type])) {
                    foreach ($full_contatto[$type] as $value) {
                        echo  $type . ': ' . $value . '</br>';
                    }
                    echo '</p>';
                }
            } ?>
        </div>
        <div class="d-grid gap-2 mt-3">
            <button type="button" class="btn btn-outline-primary t-primary bg-white" onclick="location.href='<?php echo dci_get_template_page_url('page-templates/prenota-appuntamento.php'); ?>';">
                <span>Prenota appuntamento</span>
            </button>
        </div>
    </div>
</div>