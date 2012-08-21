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

}
function makeReady()
{
$(document).ready
(   
    function()
    {
        $('.comments').hide();
        $('#commentError').hide();
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
            }
        );
    }

);
}