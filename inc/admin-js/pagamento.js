jQuery( document ).ready(function() {

    let inputDescrizionePagamento = jQuery('textarea[name^="_dci_pagamento_descrizione_pagamento"]');
    inputDescrizionePagamento.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-pagamento-descrizione-pagamento');
        });
    });

    let inputModalitaPagamento = jQuery('textarea[name^="_dci_pagamento_modalita_pagamento"]');
    inputModalitaPagamento.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-pagamento-modalita-pagamento');
        });
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Descrizione pagamento
         */
        if (!jQuery('textarea[name^="_dci_pagamento_descrizione_pagamento"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-pagamento-descrizione-pagamento');
            return false;
        }
        
        /**
         * controllo compilazione campo Modalita pagamento
         */
        if (!jQuery('textarea[name^="_dci_pagamento_modalita_pagamento"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-pagamento-modalita-pagamento');
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
