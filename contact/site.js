$(document).ready(function()
{
$(".menu1 a").each(function(){
var hreflink = $(this).attr('href');
if(location.href.toLowerCase() == "http://www.rangoligardens.com/")
{
  $("li#home").addClass("menu2");
}
if(hreflink.toLowerCase() == location.href.toLowerCase())
{
$(this).parent("li").addClass("menu2");
}
});
});