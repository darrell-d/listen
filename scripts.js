//Scripts.js

function comments(id)
{
        if( $('[id='+ id +']').is(':visible') )
        {
            $("#" + id).slideToggle();
        }
        else
        {
            $(".comments:visible").slideToggle();
            $("#" + id).slideToggle();
        }
        
}
