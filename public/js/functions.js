$(document).ready(function(){
    /**
     * Binda os efeitos de focus e blur para que o
     * input não fique sem valor algum
     * 
     **/
    $.fn.hoverText = function() {
        if($(this).length == 1){
            $(this).attr('data-init', $(this).val());
            
            $(this).focus(function(){
                $(this).val('');
                $(this).parent().addClass('bordinha');
            });
                    
            $(this).blur(function(){
                if($(this).val().length == 0) {
                    $(this).val($(this).attr('data-init'));
                    $(this).parent().removeClass('bordinha');
                }
            });
        } else {
            $(this).each(function(){
                $(this).hoverText();
            });
        }
    }
});