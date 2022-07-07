jQuery( document ).ready(function() {

    let input = jQuery('input[name^="_dci_documento_privato_argomenti"]');
    input.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-documento-privato-argomenti');
        });
    });

    let inputFormati = jQuery('textarea[name^="_dci_documento_privato_formati"]');
    inputFormati.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-documento-privato-formati');
        });
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Argomenti
         */
        if(jQuery('input[name^="_dci_documento_privato_argomenti"]:checked').length == 0){
            dci_highlight_missing_field('.cmb2-id--dci-documento-privato-argomenti');
            return false;
        }

        /**
         * controllo compilazione campo Formati disponibili
         */
        if (!jQuery('textarea[name^="_dci_documento_privato_formati"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-documento-privato-formati');
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
