<?php
global $uo_id, $with_border;
$ufficio = get_post( $uo_id );

$prefix = '_dci_unita_organizzativa_';
$competenze = dci_get_meta('competenze', $prefix, $uo_id);

$img = dci_get_meta('immagine', $prefix, $uo_id);
$contatti = dci_get_meta('contatti', $prefix, $uo_id);

$prefix = '_dci_punto_contatto_';
$indirizzi = array();
foreach ($contatti ?? null as $punto_contatto_id) {
	$voci = dci_get_meta('voci', $prefix, $punto_contatto_id);
	foreach ($voci as $voce) {
		if ($voce[$prefix.'tipo_punto_contatto'] == 'indirizzo')
			array_push($indirizzi, $voce[$prefix.'valore']);
	}
}

if($with_border) {
?>


<div class="card card-bg rounded mb-5">
	<div class="card-header">
		<strong class="d-block"><?php echo  $nome_luogo_custom; ?></strong>
		<small class="d-block"><?php echo  $indirizzo_luogo_custom; ?></small>
		<small class="d-block"><?php echo implode(" - ", $arrq);  ?></small>
	</div><!-- /card-header -->
	<div class="card-body p-0">
		<div class="row variable-gutters">
			<div class="col-lg-12">
				<div class="map-wrapper map-min-height">
					<div class="map" id="map_<?php echo $c; ?>"></div>
				</div>
			</div><!-- /col-lg-12 -->
		</div><!-- /row -->
	</div><!-- /card-body -->
</div><!-- /card card-bg rounded -->

<script>
    jQuery(function() {
        var mymap = L.map('map_<?php echo $c; ?>', {
            zoomControl: false,
            scrollWheelZoom: false
        }).setView([<?php echo $posizione_gps["lat"]; ?>, <?php echo $posizione_gps["lng"]; ?>], 15);

        L.marker([<?php echo $posizione_gps["lat"]; ?>, <?php echo $posizione_gps["lng"]; ?>]).addTo(mymap);

        // add the OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '',
            maxZoom: 18,
        }).addTo(mymap);
    });
</script>
