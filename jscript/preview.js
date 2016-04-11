var http_request = false;
function makePOSTRequest(url, parameters) {
document.getElementById('loading').style.visibility = "visible";
http_request = false;
if (window.XMLHttpRequest) { // Mozilla, Safari,...
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType) {
// set type accordingly to anticipated content type
//http_request.overrideMimeType('text/xml');
http_request.overrideMimeType('text/html');
}
} else if (window.ActiveXObject) { // IE
try {
http_request = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}
if (!http_request) {
alert(l_ajaxerror2);
return false;
}

http_request.onreadystatechange = alertContents;
http_request.open('POST', url, true);
http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http_request.setRequestHeader("Content-length", parameters.length);
http_request.setRequestHeader("Connection", "close");
http_request.send(parameters);
}

function alertContents() {
if (http_request.readyState == 4) {
if (http_request.status == 200) {
//alert(http_request.responseText);
result = http_request.responseText;
document.getElementById('preview').innerHTML = result;
document.getElementById('loading').style.visibility = "hidden";
} else {
alert(l_ajaxerror);
}
}
}

function get(obj) {
var poststr = "msg=" + encodeURI( document.getElementById(obj).value );
makePOSTRequest(baseurl + '/preview.php', poststr);
}


function makeArequestR(url, parameters) {
document.getElementById('loading').style.visibility = "visible";
http_request = false;
if (window.XMLHttpRequest) { // Mozilla, Safari,...
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType) {
// set type accordingly to anticipated content type
//http_request.overrideMimeType('text/xml');
http_request.overrideMimeType('text/html');
}
} else if (window.ActiveXObject) { // IE
try {
http_request = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}
if (!http_request) {
alert(l_ajaxerror2);
return false;
}

http_request.onreadystatechange = makeArequestAlertContentsR;
http_request.open('POST', url, true);
http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http_request.setRequestHeader("Content-length", parameters.length);
http_request.setRequestHeader("Connection", "close");
http_request.send(parameters);
}

function makeArequestAlertContentsR() {
if (http_request.readyState == 4) {
if (http_request.status == 200) {
//alert(http_request.responseText);
result = http_request.responseText;
document.getElementById('previewr').innerHTML = result;
document.getElementById('loading').style.visibility = "hidden";
if (result == '')
{
document.ratetorrent.ratebutton.value=l_thankyou;
document.ratetorrent.rating.disabled=true;
document.ratetorrent.ratebutton.disabled=true;
}
} else {
alert(l_ajaxerror);
}
}
}

function rate(obj,filename) {
var poststr = "id=" + encodeURI( document.getElementById("torrentid").value ) +
"&rating=" + encodeURI( document.getElementById("rating").value );
makeArequestR(filename, poststr);
}

function makeArequestT(url, parameters) {
document.getElementById('loadingt').style.visibility = "visible";
http_request = false;
if (window.XMLHttpRequest) { // Mozilla, Safari,...
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType) {
// set type accordingly to anticipated content type
//http_request.overrideMimeType('text/xml');
http_request.overrideMimeType('text/html');
}
} else if (window.ActiveXObject) { // IE
try {
http_request = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}
if (!http_request) {
alert(l_ajaxerror2);
return false;
}

http_request.onreadystatechange = makeArequestAlertContentsT;
http_request.open('POST', url, true);
http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http_request.setRequestHeader("Content-length", parameters.length);
http_request.setRequestHeader("Connection", "close");
http_request.send(parameters);
}

function makeArequestAlertContentsT() {
if (http_request.readyState == 4) {
if (http_request.status == 200) {
//alert(http_request.responseText);
result = http_request.responseText;
document.getElementById('previewt').innerHTML = result;
document.getElementById('loadingt').style.visibility = "hidden";
if (result == '')
{
document.thanksform.thanksbutton.value=l_thankyoutoo;
document.thanksform.thanksbutton.disabled=true;
document.getElementById('newthanksby').innerHTML = "<a href='" + baseurl +"/userdetails.php?id="+ userid +"'>"+ username +"";
}
} else {
alert(l_ajaxerror);
}
}
}

function thanks(obj,filename) {
var poststr = "id=" + encodeURI( document.getElementById("thankstorrentid").value );
makeArequestT(filename, poststr);
}

function clearannouncement(obj,filename) {
var poststr = "clear=yes";
makeArequestR(filename, poststr);
setTimeout('dismissbox()',3000)
}