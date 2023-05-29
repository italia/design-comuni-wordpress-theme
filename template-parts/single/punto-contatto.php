<?php

global $pc_id;
$prefix = '_dci_punto_contatto_';

$full_contatto = dci_get_full_punto_contatto($pc_id);
$contatto = get_post($pc_id);
$voci = dci_get_meta('voci', $prefix, $pc_id);

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
            <a class="text-decoration-none" href="<?php echo get_permalink($contatto->ID)?>">
            <?php echo $contatto->post_title; ?>
            </a>
        </h3>
        <div class="card-text">
            <?php if ( isset($full_contatto['indirizzo']) && is_array($full_contatto['indirizzo']) && count ($full_contatto['indirizzo']) ) {
                foreach ($full_contatto['indirizzo'] as $value) {
                    echo '<p>'.$value.'</p>';
                } 
                echo '<p class="mt-3"></p>';
            } ?>
            <?php if ( isset($full_contatto['telefono']) && is_array($full_contatto['telefono']) && count ($full_contatto['telefono']) ) {
                foreach ($full_contatto['telefono'] as $value) {
                    echo '<p>T '.$value.'</p>';
                }
            } ?>
            <?php if ( isset($full_contatto['url']) && is_array($full_contatto['url']) && count ($full_contatto['url']) ) {
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
            <?php if ( isset($full_contatto['email']) && is_array($full_contatto['email']) && count ($full_contatto['email']) ) {
                foreach ($full_contatto['email'] as $value) { ?>
                    <p>
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
            <?php foreach ($other_contacts as $type) {
                if ( isset($full_contatto[$type]) && is_array($full_contatto[$type]) && count ($full_contatto[$type]) ) {
                    foreach ($full_contatto[$type] as $value) {
                        echo '<p>'.$type.': '.$value.'</p>';
                    }
                } 
            } ?>
        </div>
    </div>
</div>