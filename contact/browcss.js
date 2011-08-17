var navig_agt=navigator.userAgent.toLowerCase();
var navig_min=navig_extVer(navigator.appVersion);
var navig_maj=parseInt(navig_min);
var navig_ie=((navig_agt.indexOf("msie")!=-1) && (navig_agt.indexOf("opera")==-1));
var navig_ie5=(navig_ie && (navig_agt.indexOf("msie 5.")!=-1));
var navig_ie6=(navig_ie && (navig_agt.indexOf("msie 6.")!=-1));
var navig_ie7=(navig_ie && (navig_agt.indexOf("msie 7.")!=-1));
var navig_ie8=(navig_ie && (navig_agt.indexOf("msie 8.")!=-1));

/**
var appName = window.navigator.appName;
var appVersion = window.navigator.appVersion;
var ie6AppVersion = "4.0 (compatible; MSIE 6.0; Windows NT 5.1) ";
var ie7AppVersion = "4.0 (compatible; MSIE 7.0; Windows NT 5.1; SV1; SWIE7; InfoPath.2; .NET CLR 2.0.50727)";
*/
function navig_extVer(txt) {
  if (!txt) return "";
  var ver="";
  for(var i=0; i<txt.length; i++) {
    if ((isNaN(txt.charAt(i))) && (txt.charAt(i)!='.')) {
      if (ver.length>0) return(ver);
    } else {
      ver+=txt.charAt(i);
    }
  }
  return ver;
} // fin navig_extVer(txt)

if (navig_ie5) 
{
	document.write("<link rel='stylesheet' href='css/styleIE.css' type='text/css' />");
}

else if (navig_ie6) 
{
	document.write("<link rel='stylesheet' href='css/styleIE.css' type='text/css' />");
}
else if (navig_ie7) 
{
	document.write("<link rel='stylesheet' href='css/styleIE.css' type='text/css' />");
}

else if(navig_ie8)
  {
	document.write("<link rel='stylesheet' href='css/style.css' type='text/css' />");
}
else
{
	document.write("<link rel='stylesheet' href='css/style.css' type='text/css' />");

}