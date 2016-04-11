<script>
var checkobj

function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}
function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)

return true
else{
alert("Please read/accept terms to submit form")
return false
}
}
}

function goToURL() {
  var i, args=goToURL.arguments; document.returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

</script>
<div align="center" id="agreestyle">
<table width=100% cellspacing=0 cellpadding=5 border=0 align=center>
<tr>
<td valign=top width=80%>
          <tag:ua1 />
          <tag:ua2 />
          <tag:ua3 />
          <font id="agree2"><justify><tag:ua4 /></br></br>
          <tag:ua5 /></br></br>
          <tag:ua8 /></br></br>
          <tag:ua9 /></br></br></justify>
          <center><b><font id="sitename"<tag:ua7 /><br><font id="date"><tag:ua6 /></font></center>

<tr>
<td align="center" valign="BOTTOM">
<form method="get" name="agreeform" onsubmit="goToURL('parent','index.php?page=account');return document.returnValue" >

  <input name="agreecheck" type="checkbox" onClick="agreesubmit(this)">
  <b><font id="agree3"><tag:language.AGREE1 /></b></font><br>
  <input type="Submit" value="Submit!" disabled onClick="return defaultagree(this)">
       </td>
    </tr>
  </table>  
</form>
<script>
//change two names below to your form's names
document.forms.agreeform.agreecheck.checked=false
</script>
</td>
</tr>
</table>
</div>
</body>
</html>