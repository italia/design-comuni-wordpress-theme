jQuery( document ).ready(function() {

    /**
     * nascondi/mostra campi per tipologia Persona
     */
    if(jQuery('#_dci_persona_tipologia_persona option:selected').val() != 'Persona Politica'){
        jQuery('.cmb2-id--dci-persona-biografia').hide();
        jQuery('.cmb2-id--dci-persona-situazione-patrimoniale').hide();
    }else{
    }

    jQuery("#_dci_persona_tipologia_persona").change(
        function(){
            if (jQuery(this).val() == 'Persona Politica') {
                jQuery('.cmb2-id--dci-persona-biografia').show();
                jQuery('.cmb2-id--dci-persona-situazione-patrimoniale').show();

            }else{
                jQuery('.cmb2-id--dci-persona-biografia').hide();
                jQuery('.cmb2-id--dci-persona-situazione-patrimoniale').hide();
            }
     });
});
