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



    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Categorie Servizio
         */
        if(document.activeElement.id === 'publish' && jQuery('input[name^="_dci_servizio_categorie"]:checked').length === 0){
            dci_highlight_missing_field('.cmb2-id--dci-servizio-categorie');
            return false;
        }

        /**
         * controllo compilazione campo Argomenti
         */
        if(document.activeElement.id === 'publish' && jQuery('input[name^="_dci_servizio_argomenti"]:checked').length === 0){
            dci_highlight_missing_field('.cmb2-id--dci-servizio-argomenti');
            return false;
        }

        /**
         * controllo compilazione campo Motivo dello stato
         */
        if (document.activeElement.id === 'publish' && jQuery('input[name^="_dci_servizio_stato"]:checked').val() === 'false'  && !jQuery('textarea[name^="_dci_servizio_motivo_stato"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-servizio-motivo-stato');
            return false;
        }

        return true;
    });
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
