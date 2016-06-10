<script src="jscript/request.js"></script>
<script>
function handleOnChange(dd1)
{
  var idx = dd1.selectedIndex;
  var val = dd1[idx].text;
  var par = document.forms["frmSelect"];
  var parelmts = par.elements;
  var subcatsel = parelmts["subcat"];
  var cat = val;
  if (cat != "Select Main Subject")
  {
    Http.get({
        url: "./contact_" +  cat + ".txt",
        callback: fillsubcat,
        cache: Http.Cache.Get
    }, [subcatsel]);
  }
}

function fillsubcat(xmlreply, subcatelmt)
{
  if (xmlreply.status == Http.Status.OK)
  {
    var subcatresponse = xmlreply.responseText;
    var subcatar = subcatresponse.split("|");
    subcatelmt.length = 1;
    subcatelmt.length = subcatar.length;
    for (o=1; o < subcatar.length; o++)
    {
      subcatelmt[o].text = subcatar[o];
    }
  }
  else
  {
    alert("Cannot handle the AJAX call.");
  }
}
</script>


<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Contact Us</h4>
</div>
<table>
<center><p class='text-danger'>This form is strictly for contacting us regarding website problems or concerns.</p></center>

<tag:con2 />

<if:CAPTCHA>
    <tr>
       <td align="left" class="header">Image Code:</td>
       <td align="left" class="lista"><input type="text" class='form-control' name="private_key" maxlength="6" size="6" value="" />&nbsp;&nbsp;<tag:upload_captcha /></td>
    </tr>
    <else:CAPTCHA>
    <tr>
       <td align="left" class="header">Security Code:</td>
       <td align="left" class="lista"><tag:scode_question /><input type="text" class='form-control' name="scode_answer" maxlength="6" size="6" value="" /></td>
    </tr>
</if:CAPTCHA>

<tag:con3 />

</table>
<div class="panel-footer">
</div>
</div>