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
        //Load existing comments
        $.ajax
        (
            {
                type:'POST',
                url:'./sql/loadComments.php',
                data: 'id=' + id,
                success: function(text) 
                {
                    $("#allComments").html( text );
                },
                error: function()
                {

                }
            }
        );

        $('html, body').animate({
            scrollTop: $(".comments").offset().top
        }, 2000);

}
$(document).ready
(   
    function()
    {
        $('.comments').hide();
        $('[id=commentError]').hide();
        $('[type=submit]').click
        (
            function()
            {
                $('[type=submit]').val("Submitting");
                //submit comment
                //TODO: prevent duplicate submission
                $.ajax
                (
                    {
                        type:'POST',
                        url:'./sql/saveComments.php',
                        data:'name='+ $("[placeholder=Name]:visible").val() +'&comment='+ $("textarea:visible").val() +'&id='+ $('.comments:visible').attr('id'),
                        success: function(text) 
                        {
                            $.ajax
                            (
                                {
                                    type:'POST',
                                    url:'./sql/loadComments.php',
                                    data: 'id=' + $('.comments:visible').attr('id'),
                                    success: function(text) 
                                    {
                                        $("#allComments").html( text );
                                        $('[placeholder="Comments..."]').val("");
                                        $('[placeholder="Name"]').val("");
                                    },
                                    error: function()
                                    {

                                    }
                                }
                            );
                            
                        },
                        error: function()
                        {
                           $("#commentError").fadeIn('600');
                           $('[type=submit]').val("Submit");
                        }
                    }
                );
                $('[type=submit]').val("Submit");
            }
        );
    }

);
