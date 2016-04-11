var ie=document.all
var dom=document.getElementById
var ns4=document.layers
var calunits=document.layers?"":"px"
var bouncelimit=32
var direction="up"
function initbox(){if(!dom&&!ie&&!ns4)
return
crossobj=(dom)?document.getElementById("dropin").style:ie?document.all.dropin:document.dropin
scroll_top=(ie)?truebody().scrollTop:window.pageYOffset
crossobj.top=scroll_top-250+calunits
crossobj.visibility=(dom||ie)?"visible":"show"
dropstart=setInterval("dropin()",50)}
function dropin(){scroll_top=(ie)?truebody().scrollTop:window.pageYOffset
if(parseInt(crossobj.top)<100+scroll_top)
crossobj.top=parseInt(crossobj.top)+40+calunits
else{clearInterval(dropstart)
bouncestart=setInterval("bouncein()",50)}}
function bouncein(){crossobj.top=parseInt(crossobj.top)-bouncelimit+calunits
if(bouncelimit<0)
bouncelimit+=8
bouncelimit=bouncelimit*-1
if(bouncelimit==0){clearInterval(bouncestart)}}
function popUp(URL){day=new Date();id=day.getTime();eval("page"+id+" = window.open(URL, '"+id+"', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=100');");}
function dismissbox(){if(window.bouncestart)clearInterval(bouncestart)
crossobj.visibility="hidden"}
function show_announcement(){bouncelimit=32
direction="up"
initbox()}
function truebody(){return(document.compatMode&&document.compatMode!="BackCompat")?document.documentElement:document.body}