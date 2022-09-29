
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

    jQuery("body").on('click', "#_dci_documento_pubblico_box_documento", function() {
        dci_remove_highlight_alternative_field('#_dci_documento_pubblico_box_documento');
    });

    /**
     * controllo all'invio del form
     */
    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Argomenti
         */
        if(document.activeElement.id === 'publish' && jQuery('input[name^="_dci_documento_pubblico_argomenti"]:checked').length == 0){
            dci_highlight_missing_field('.cmb2-id--dci-documento-pubblico-argomenti');
            return false;
        }

        /**
         * controllo compilaziono tassonomia tipi_doc_albo_pretorio se tassonomia tipi_dcoumento è 'documento albo pretorio'
         */
        if(document.activeElement.id === 'publish' && (jQuery('input[name^="_dci_documento_pubblico_tipo_doc_albo_pretorio"]:checked').length == 0) && (jQuery('input[name^="_dci_documento_pubblico_file_documento"]:checked').val() == 'documento-albo-pretorio')){
            dci_highlight_missing_field ('.cmb2-id--dci-documento-pubblico-tipo-doc-albo-pretorio');
            return false;
        }

        /**
         * controllo compilazione alternativa url documento - file documento
         */
        if(document.activeElement.id === 'publish' &&(!jQuery('input[name^="_dci_documento_pubblico_url_documento"]').val() && jQuery('#_dci_documento_pubblico_file_documento-status').children().length == 0 && !jQuery('input[name^="_dci_documento_pubblico_file_documento"]').val())){
            dci_highlight_alternative_field('#_dci_documento_pubblico_box_documento', 'Campo obbligatorio');
            return false;
        }

        if(document.activeElement.id === 'publish' && (jQuery('input[name^="_dci_documento_pubblico_url_documento"]').val() && (jQuery('#_dci_documento_pubblico_file_documento-status').children().length != 0 || jQuery('input[name^="_dci_documento_pubblico_file_documento"]').val()))){
            dci_highlight_alternative_field('#_dci_documento_pubblico_box_documento','Inserire alternativamente un URL o un allegato');
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

function dci_highlight_alternative_field(fieldClass, message) {
    jQuery(fieldClass).addClass("highlighted_alternative_field")
        .append('<div id ="field-alternative-msg" class="field-alternative-msg"><em>'+message+'</em></div>')
    ;
    jQuery('html,body').animate({
        scrollTop: jQuery("#field-alternative-msg").parent().offset().top - 100
    }, 'slow');
}

function dci_remove_highlight_alternative_field(fieldClass) {
    jQuery(fieldClass).removeClass("highlighted_alternative_field");
    jQuery('.field-alternative-msg').remove();
}



