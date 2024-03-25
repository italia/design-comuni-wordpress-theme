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

<div class="card card-teaser card-teaser-info rounded shadow-sm p-4 me-3">
    <div class="card-body richtext-wrapper">
        <h3>
            <?php echo $contatto->post_title; ?>
        </h3>
        <div class="card-text">
            <?php if ( is_array($full_contatto['indirizzo'] ?? null) && count ($full_contatto['indirizzo']) ) {
                foreach ($full_contatto['indirizzo'] as $value) {
                    echo '<p>'.$value.'</p>';
                } 
                echo '<p class="mt-3"></p>';
            } ?>
            <?php if ( is_array($full_contatto['telefono'] ?? null)  && count ($full_contatto['telefono']) ) {
                foreach ($full_contatto['telefono'] as $value) {
                    echo '<p>Telefono: <a href="tel:' . $value .'">'.$value.'</a></p>';
                }
            } ?>
            <?php if ( is_array($full_contatto['url']  ?? null)  && count ($full_contatto['url']) ) {
                foreach ($full_contatto['url'] as $value) { ?>
                    <p>
                        <a 
                        target="_blank" 
                        aria-label="scopri di più su <?php echo $value; ?> - link esterno - apertura nuova scheda" 
                        title="vai sul sito <?php echo $value; ?>" 
                        href="<?php echo $value; ?>">
                            <?php echo $value; ?>
                        </a>
                    </p>
               <?php }
            } ?>
            <?php if ( is_array($full_contatto['email'] ?? null)  && count ($full_contatto['email']) ) {
                foreach ($full_contatto['email'] as $value) {
                    echo '<p>Email: ' ; ?>
                        <a
                        target="_blank" 
                        aria-label="invia un'email a <?php echo $value; ?>"
                        title="invia un'email a <?php echo $value; ?>" 
                        href="mailto:<?php echo $value; ?>">
                            <?php echo $value; ?>
                        </a>
                    </p>
               <?php }
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
                if ( is_array($full_contatto[$type] ?? null) && count ($full_contatto[$type]) ) {
                    foreach ($full_contatto[$type] as $value) {
                        echo '<p>'.$type.': '.$value.'</p>';
                    }
                } 
            } ?>
        </div>
    </div>
</div>