jQuery( document ).ready(function() {

    /**
     * nascondi/mostra campi per tipologia Persona
     */
    if(jQuery('#_dci_persona_pubblica_tipologia_persona option:selected').val() != 'Persona Politica'){
        jQuery('.cmb2-id--dci-persona-pubblica-biografia').hide();
        jQuery('.cmb2-id--dci-persona-pubblica-situazione-patrimoniale').hide();
    }else{
        jQuery('.cmb2-id--dci-persona-pubblica-biografia').show();
        jQuery('.cmb2-id--dci-persona-pubblica-situazione-patrimoniale').show();
    }

    jQuery("#_dci_persona_pubblica_tipologia_persona").change(
        function(){
            if (jQuery(this).val() == 'Persona Politica') {
                jQuery('.cmb2-id--dci-persona-pubblica-biografia').show();
                jQuery('.cmb2-id--dci-persona-pubblica-situazione-patrimoniale').show();

            }else{
                jQuery('.cmb2-id--dci-persona-pubblica-biografia').hide();
                jQuery('.cmb2-id--dci-persona-pubblica-situazione-patrimoniale').hide();
            }
     });
});
