var offsetfromcursorX=12
var offsetfromcursorY=10
var offsetdivfrompointerX=10
var offsetdivfrompointerY=14
document.write('<div id="dhtmltooltip"></div>')
document.write('<img id="dhtmlpointer" src="'+dimagedir+'arrow2.gif">')
var ie=document.all
var ns6=document.getElementById&&!document.all
var enabletip=false
if(ie||ns6)
var tipobj=document.all?document.all["dhtmltooltip"]:document.getElementById?document.getElementById("dhtmltooltip"):""
var pointerobj=document.all?document.all["dhtmlpointer"]:document.getElementById?document.getElementById("dhtmlpointer"):""
function ietruebody(){return(document.compatMode&&document.compatMode!="BackCompat")?document.documentElement:document.body}
function ddrivetip(thetext,thewidth,thecolor){if(ns6||ie){if(typeof thewidth!="undefined")tipobj.style.width=thewidth+"px"
if(typeof thecolor!="undefined"&&thecolor!="")tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false}}
function positiontip(e){if(enabletip){var nondefaultpos=false
if(!e)
{var e=window.event}
if(e.pageX||e.pageY)
{curX=e.pageX;curY=e.pageY;}
else if(e.clientX||e.clientY)
{curX=e.clientX+document.body.scrollLeft
+document.documentElement.scrollLeft;curY=e.clientY+document.body.scrollTop
+document.documentElement.scrollTop;}
var winwidth=ie&&!window.opera?ietruebody().clientWidth:window.innerWidth-20
var winheight=ie&&!window.opera?ietruebody().clientHeight:window.innerHeight-20
var rightedge=ie&&!window.opera?winwidth-event.clientX-offsetfromcursorX:winwidth-e.clientX-offsetfromcursorX
var bottomedge=ie&&!window.opera?winheight-event.clientY-offsetfromcursorY:winheight-e.clientY-offsetfromcursorY
var leftedge=(offsetfromcursorX<0)?offsetfromcursorX*(-1):-1000
if(rightedge<tipobj.offsetWidth){tipobj.style.left=curX-tipobj.offsetWidth+"px"
nondefaultpos=true}
else if(curX<leftedge)
tipobj.style.left="5px"
else{tipobj.style.left=curX+offsetfromcursorX-offsetdivfrompointerX+"px"
pointerobj.style.left=curX+offsetfromcursorX+"px"}
if(bottomedge<tipobj.offsetHeight){tipobj.style.top=curY-tipobj.offsetHeight-offsetfromcursorY+"px"
nondefaultpos=true}
else{tipobj.style.top=curY+offsetfromcursorY+offsetdivfrompointerY+"px"
pointerobj.style.top=curY+offsetfromcursorY+"px"}
tipobj.style.visibility="visible"
if(!nondefaultpos)
pointerobj.style.visibility="visible"
else
pointerobj.style.visibility="hidden"}}
function hideddrivetip(){if(ns6||ie){enabletip=false
tipobj.style.visibility="hidden"
pointerobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''}}
document.onmousemove=positiontip