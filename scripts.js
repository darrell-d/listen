//Scripts.js

function loadComments(id)
{
    comment = document.getElementById(id)
    
    if(comment.style.display == 'block')
    {
       comment.style.display = 'none'
    }
    else
    {
        comment.style.display = 'block';
    }
    
}
