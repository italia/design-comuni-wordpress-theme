<?php
global $luoghi;
$prefix = '_dci_luogo_';
$arr_luoghi = array();
$c=0;
foreach ($luoghi as $luogo) {
    $posizione_gps = dci_get_meta("posizione_gps", $prefix, $luogo->ID);
    if ($posizione_gps && $posizione_gps["lat"] && $posizione_gps["lng"]) {
        $indirizzo = dci_get_meta("indirizzo", $prefix, $luogo->ID);
        $arr_luoghi[$c]["post_title"] = $luogo->post_title;
        $arr_luoghi[$c]["permalink"] = get_permalink($luogo);
        $arr_luoghi[$c]["gps"] = $posizione_gps;
        $arr_luoghi[$c]["indirizzo"] = $indirizzo;
        $c++;
    }
}

if($c) { ?>
        <div class="row">
            <div class="map-wrapper">
                <div class="map-column my-3">
                    <div class="map" id="map_all"></div>
                </div>
            </div>
        </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
            crossorigin=""></script>
    <script>
        jQuery(function() {
            var mymap = L.map('map_all', {
                zoomControl: true,
                scrollWheelZoom: false
            }).setView([<?php echo $arr_luoghi[0]["gps"]["lat"]; ?>, <?php echo $arr_luoghi[0]["gps"]["lng"]; ?>], 13);

            let marker;
            <?php foreach ($arr_luoghi as $marker){ ?>

            marker = L.marker([<?php echo $marker["gps"]["lat"]; ?>, <?php echo $marker["gps"]["lng"]; ?>, { title: '<?php echo addslashes($marker["post_title"]); ?>'}]).addTo(mymap);
            marker.bindPopup('<b><a href="<?php echo $marker["permalink"] ?>"><?php echo addslashes($marker["post_title"]); ?></a></b><br><?php echo addslashes($marker["indirizzo"]); ?>');

            <?php } ?>

            // add the OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '',
                maxZoom: 18,
            }).addTo(mymap);

            var arrayOfMarkers = [<?php foreach ($arr_luoghi as $marker){ ?> [ <?php echo $marker["gps"]["lat"]; ?>, <?php echo $marker["gps"]["lng"]; ?>], <?php } ?>];
            var bounds = new L.LatLngBounds(arrayOfMarkers);
            mymap.fitBounds(bounds);
        });
    </script>
<?php } ?>