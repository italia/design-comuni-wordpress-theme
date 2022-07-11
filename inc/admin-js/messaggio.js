jQuery( document ).ready(function() {

    let inputTestoMessaggio = jQuery('textarea[name^="_dci_messaggio_testo_messaggio"]');
    inputTestoMessaggio.each(function() {
        jQuery(this).on('change keyup paste', function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-messaggio-testo-messaggio');
        });
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Testo messaggio
         */
        if (!jQuery('textarea[name^="_dci_messaggio_testo_messaggio"]').val()) {
            dci_highlight_missing_field('.cmb2-id--dci-messaggio-testo-messaggio');
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
