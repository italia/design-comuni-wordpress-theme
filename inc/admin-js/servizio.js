jQuery( document ).ready(function() {

    let input = jQuery('input[name^="_dci_servizio_argomenti"]');
    input.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-servizio-argomenti');
        });
    });

    let inputCategorie = jQuery('input[name^="_dci_servizio_categorie"]');
    inputCategorie.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-servizio-categorie');
        });
    });

    let inputMotivo = jQuery('textarea[name^="_dci_servizio_motivo_stato"]');
    inputMotivo.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-servizio-motivo-stato');
        });
    });

    var inputFasi = document.querySelector('#_dci_servizio_fasi');
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === "attributes") {
                dci_remove_highlight_missing_field('.cmb2-id--dci-servizio-fasi');
            }
        });
    });

    observer.observe(inputFasi, {
        attributes: true //configure it to listen to attribute changes
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Categorie Servizio
         */
        if(jQuery('input[name^="_dci_servizio_categorie"]:checked').length === 0){
            dci_highlight_missing_field('.cmb2-id--dci-servizio-categorie');
            return false;
        }

        /**
         * controllo compilazione campo Argomenti
         */
        if(jQuery('input[name^="_dci_servizio_argomenti"]:checked').length === 0){
            dci_highlight_missing_field('.cmb2-id--dci-servizio-argomenti');
            return false;
        }

        /**
         * controllo compilazione campo Motivo dello stato
         */
        if (jQuery('input[name^="_dci_servizio_stato"]:checked').val() === 'false'  && !jQuery('textarea[name^="_dci_servizio_motivo_stato"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-servizio-motivo-stato');
            return false;
        }

        /**
         * controllo compilazione campo Fasi
         */
        if(jQuery('input[name^="_dci_servizio_fasi"]').attr('value') === '') {
            dci_highlight_missing_field('.cmb2-id--dci-servizio-fasi');
            return false;
        }

        return true;
    });


});



function dci_highlight_missing_field(fieldClass) {

    jQuery(fieldClass).addClass("highlighted_missing_field")
        .append('<div id ="field-required-msg" class="field-required-msg"><em>campo obbligatorio !</em></div>')
    ;
    jQuery('html,body').animate({
        scrollTop: jQuery("#field-required-msg").parent().offset().top - 100
    }, 'slow');

}


function dci_remove_highlight_missing_field(fieldClass) {
    jQuery(fieldClass).removeClass("highlighted_missing_field");
    jQuery('.field-required-msg').remove();
}
