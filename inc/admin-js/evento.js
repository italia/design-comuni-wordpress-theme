jQuery( document ).ready(function() {

    let input = jQuery('input[name^="_dci_evento_argomenti"]');
    input.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-evento-argomenti');
        });
    });

    let inputDescrizioneCompleta = jQuery('textarea[name^="_dci_evento_descrizione_completa"]');
    inputDescrizioneCompleta.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-evento-descrizione-completa');
        });
    });

    let inputDestinatari = jQuery('textarea[name^="_dci_evento_a_chi_e_rivolto"]');
    inputDestinatari.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-evento-a-chi-e-rivolto');
        });
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {
        /**
         * controllo compilazione campo Argomenti
         */
        if(jQuery('input[name^="_dci_evento_argomenti"]:checked').length == 0){
            dci_highlight_missing_field('.cmb2-id--dci-evento-argomenti');
            return false;
        }

        /**
         * controllo compilazione campo Descrizione completa
         */
        if (!jQuery('textarea[name^="_dci_evento_descrizione_completa"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-evento-descrizione-completa');
            return false;
        }

         /**
         * controllo compilazione campo A chi è rivolto
         */
        if (!jQuery('textarea[name^="_dci_evento_a_chi_e_rivolto"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-evento-a-chi-e-rivolto');
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
