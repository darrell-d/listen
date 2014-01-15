//Basic Ajax setup
//Store the reference to XMLHttpRequest object
var xmlHttp = createXmlHttpRequestObject();

function update()
{
    if(xmlHttp.readyState === 4)
    {
        document.getElementById("action").innerHTML = xmlHttp.responseText;
    }
    else
    {
        setTimeout('update()',1000);
    }
}

function createXmlHttpRequestObject()
{
    //stores the reference to XMLHttpReqiest
    var xmlHttp;

    //For IE6 or older
    if(window.ActiveXObject)
    {
            try
            {
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                    xmlHttp = false;
            }
    }
    //Modern browsers
    else
    {
            try 
            {
                    xmlHttp = new XMLHttpRequest();
            }
            catch(e)
            {
            xmlHttp = false;
            }
    }

    //Error message return
    if(!xmlHttp)
    {
            alert("Error creating XMLHttp Object. Are you using a modern browser with Javascript enabled?");
    }
    else
    {
            return xmlHttp;
    }
        
	
}

function loadPanel(panel)
{
    var div = document.getElementById("action");

    xmlHttp.open("GET",panel);
    xmlHttp.onReadystatechange = update();
    xmlHttp.send(null);
}