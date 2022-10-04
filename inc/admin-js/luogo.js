jQuery( document ).ready(function() {

    var inputGPSLat = document.querySelector('#_dci_luogo_posizione_gps_lat');
    setTimeout(function() {
        inputGPSLat.setAttribute('data-text', 'whatever');
    }, 5000)
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === "attributes") {
                dci_remove_highlight_missing_field('.cmb2-id--dci-luogo-posizione-gps');
            }
        });
    });

    observer.observe(inputGPSLat, {
        attributes: true //configure it to listen to attribute changes
    });

    var inputGPSLng = document.querySelector('#_dci_luogo_posizione_gps_lng');
    var observer1 = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === "attributes") {
                dci_remove_highlight_missing_field('.cmb2-id--dci-luogo-posizione-gps');
            }
        });
    });

    observer1.observe(inputGPSLng, {
        attributes: true //configure it to listen to attribute changes
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo GPS
         */
        if(document.activeElement.id === 'publish' && (jQuery('input[name^="_dci_luogo_posizione_gps[lat]"]').attr('value') === '' || jQuery('input[name^="_dci_luogo_posizione_gps[lng]"]').attr('value') === '')) {
            dci_highlight_missing_field('.cmb2-id--dci-luogo-posizione-gps');
            return false;
        }

        return true;
    })
});

function dci_highlight_missing_field(fieldClass) {

    jQuery(fieldClass).addClass("highlighted_missing_field")
        .append('<div id ="field-required-msg" class="field-required-msg"><em>Campo obbligatorio</em></div>')
    ;

    jQuery('html,body').animate({
        scrollTop: jQuery("#field-required-msg").parent().offset().top - 100
    }, 'slow');

}


function dci_remove_highlight_missing_field(fieldClass) {
    jQuery(fieldClass).removeClass("highlighted_missing_field");
    jQuery('.field-required-msg').remove();
}
