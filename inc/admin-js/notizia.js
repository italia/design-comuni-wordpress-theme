jQuery( document ).ready(function() {

    let input = jQuery('input[name^="_dci_notizia_argomenti"]');
    input.each(function() {
        jQuery(this).click(function(){
            dci_remove_highlight_missing_field('.cmb2-id--dci-notizia-argomenti');
        });
    });

    jQuery( 'form[name="post"]' ).on('submit', function(e) {

        /**
         * controllo compilazione campo Argomenti
         */
        if(document.activeElement.id === 'publish' && jQuery('input[name^="_dci_notizia_argomenti"]:checked').length == 0){
            dci_highlight_missing_field('.cmb2-id--dci-notizia-argomenti');
            return false;
        }
        inputDataPubblicazione = jQuery('input[name^="_dci_notizia_data_pubblicazione"]').val();
        check_pubblicato = jQuery("#timestamp b").text();
        console.log(document.activeElement.id);
        if (document.activeElement.id === 'publish') {
            if (!inputDataPubblicazione) { // Verifica sia null che stringa vuota
                const getCurrentDate = () => {
                    const date = new Date();
                    const day = String(date.getDate()).padStart(2, '0'); // Aggiunge lo 0 se necessario
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                };
        
                const parseDateString = (dateString) => {
                    const monthsMap = {
                        Gen: "01", Feb: "02", Mar: "03", Apr: "04", Mag: "05", Giu: "06",
                        Lug: "07", Ago: "08", Set: "09", Ott: "10", Nov: "11", Dic: "12"
                    };
                    const parts = dateString.split(" "); 
                    const day = parts[0].padStart(2, '0'); 
                    const month = monthsMap[parts[1]] || "00"; 
                    const year = parts[2];
                    return `${day}-${month}-${year}`;
                };
        
                // Calcolo della data
                const dataDaRiportare = check_pubblicato === 'subito' ? getCurrentDate() : parseDateString(check_pubblicato);
        
                // Imposta il valore nel campo
                jQuery('input[name^="_dci_notizia_data_pubblicazione"]').val(dataDaRiportare);
            }
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
