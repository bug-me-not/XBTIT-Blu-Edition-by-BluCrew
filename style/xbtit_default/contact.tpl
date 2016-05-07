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

<table width=50% align=center><tr><td class=header>
If you need to contact us for any reason you may either send an administrator a private message, alternatively you may email us with the form below.
<BR><BR>
<b>Please be aware that we will not reply regarding help downloading or uploading. Please use the forum for these kind of problems.</b><br><br>This form is strictly for contacting us regarding website problems or concerns.<br><br>

<tag:con2 />

<if:CAPTCHA>
    <tr>
       <td align="left" class="header">Image Code:</td>
       <td align="left" class="lista"><input type="text" name="private_key" maxlength="6" size="6" value="" />&nbsp;&nbsp;<tag:upload_captcha /></td>
    </tr>
    <else:CAPTCHA>
    <tr>
       <td align="left" class="header">Security Code:</td>
       <td align="left" class="lista"><tag:scode_question /><input type="text" name="scode_answer" maxlength="6" size="6" value="" /></td>
    </tr>
</if:CAPTCHA>

<tag:con3 />

</td></tr></table>