jQuery( document ).ready(function() {

    let input = jQuery('input[name^="_dci_dataset_temi"]');
    input.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-dataset-temi');
        });
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {
        /**
         * controllo compilazione campo Temi di un Dataset
         */
        if(document.activeElement.id === 'publish' && jQuery('input[name^="_dci_dataset_temi"]:checked').length == 0){
            dci_highlight_missing_field('.cmb2-id--dci-dataset-temi');
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
