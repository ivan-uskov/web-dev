function getXHR()
{
    var xmlHttp;
    try
    {
        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
        try
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp = false;
        }
    }
    if (!xmlHttp && typeof(XMLHttpRequest) != undefined)
    {
        xmlHttp = new XMLHttpRequest();
    }
    return xmlHttp;
}