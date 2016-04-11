var RADIO=jQuery.noConflict();
RADIO(document).ready(function() {
if(RADIO.trim(RADIO('#timediv').html()) == "")
{
RADIO('#timediv').fadeOut('slow').load('radiostats/fetch.php?' + new Date().getTime()).fadeIn("slow");
}
var auto_refresh = setInterval(
function ()
{
RADIO('#timediv').fadeOut('slow').load('radiostats/fetch.php?' + new Date().getTime()).fadeIn("slow");
}, 40000);
});