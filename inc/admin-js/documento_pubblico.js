
jQuery( document ).ready(function() {

    /**
     * gestione campi obbligatori
     */
    let input = jQuery('input[name^="_dci_documento_pubblico_argomenti"]');
    input.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-documento-pubblico-argomenti');
        });
    });


    let inputAlboPretorio = jQuery('input[name^="_dci_documento_pubblico_tipo_doc_albo_pretorio"]');
    inputAlboPretorio.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-documento-pubblico-tipo-doc-albo-pretorio');
        });
    });

    let inputFormati = jQuery('textarea[name^="_dci_documento_pubblico_formati"]');
    inputFormati.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-documento-pubblico-formati');
        });
    });

    /**
     * controllo all'invio del form
     */
    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Argomenti
         */
        if(jQuery('input[name^="_dci_documento_pubblico_argomenti"]:checked').length == 0){
            dci_highlight_missing_field('.cmb2-id--dci-documento-pubblico-argomenti');
            return false;
        }

        /**
         * controllo compilaziono tassonomia tipi_doc_albo_pretorio se tassonomia tipi_dcoumento è 'documento albo pretorio'
         */
        if((jQuery('input[name^="_dci_documento_pubblico_tipo_doc_albo_pretorio"]:checked').length == 0) && (jQuery('input[name^="_dci_documento_pubblico_tipo_documento"]:checked').val() == 'documento-albo-pretorio')){
            dci_highlight_missing_field ('.cmb2-id--dci-documento-pubblico-tipo-doc-albo-pretorio');
            return false;
        }

        /**
         * controllo compilazione campo Formati disponibili
         */
        if (!jQuery('textarea[name^="_dci_documento_pubblico_formati"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-documento-pubblico-formati');
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




