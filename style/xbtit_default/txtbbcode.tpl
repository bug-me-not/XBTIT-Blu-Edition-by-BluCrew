
<script language="javascript"  type="text/javascript">
<!--
// Remember the current position.
function storeCaret(text)
{
    // Only bother if it will be useful.
    if (typeof(text.createTextRange) != "undefined")
        text.caretPos = document.selection.createRange().duplicate();
}

function SmileIT(smile,textarea){
    // Attempt to create a text range (IE).
    if (typeof(textarea.caretPos) != "undefined" && textarea.createTextRange)
    {
        var caretPos = textarea.caretPos;

        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? smile + ' ' : smile
        caretPos.select();
    }
    // Mozilla text range replace.
    else if (typeof(textarea.selectionStart) != "undefined")
    {
        var begin = textarea.value.substr(0, textarea.selectionStart);
        var end = textarea.value.substr(textarea.selectionEnd);
        var scrollPos = textarea.scrollTop;

        textarea.value = begin + smile + end;

        if (textarea.setSelectionRange)
        {
            textarea.focus();
            textarea.setSelectionRange(begin.length + smile.length, begin.length + smile.length);
        }
        textarea.scrollTop = scrollPos;
    }
    // Just put it on the end.
    else
    {
        textarea.value += smile;
        textarea.focus(textarea.value.length - 1);
    }
}

function PopMoreSmiles(form,name) {
         newWin=window.open('index.php?page=moresmiles&form='+form+'&text='+name,'moresmile','height=500,width=750,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}

function BBTag(opentag, closetag, textarea)
{
    // Can a text range be created?
    if (typeof(textarea.caretPos) != "undefined" && textarea.createTextRange)
    {
        var caretPos = textarea.caretPos, temp_length = caretPos.text.length;

        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? opentag + caretPos.text + closetag + ' ' : opentag + caretPos.text + closetag;

        if (temp_length == 0)
        {
            caretPos.moveStart("character", -closetag.length);
            caretPos.moveEnd("character", -closetag.length);
            caretPos.select();
        }
        else
            textarea.focus(caretPos);
    }
    // Mozilla text range wrap.
    else if (typeof(textarea.selectionStart) != "undefined")
    {
        var begin = textarea.value.substr(0, textarea.selectionStart);
        var selection = textarea.value.substr(textarea.selectionStart, textarea.selectionEnd - textarea.selectionStart);
        var end = textarea.value.substr(textarea.selectionEnd);
        var newCursorPos = textarea.selectionStart;
        var scrollPos = textarea.scrollTop;

        textarea.value = begin + opentag + selection + closetag + end;

        if (textarea.setSelectionRange)
        {
            if (selection.length == 0)
                textarea.setSelectionRange(newCursorPos + opentag.length, newCursorPos + opentag.length);
            else
                textarea.setSelectionRange(newCursorPos, newCursorPos + opentag.length + selection.length + closetag.length);
            textarea.focus();
        }
        textarea.scrollTop = scrollPos;
    }
    // Just put them on the end, then.
    else
    {
        textarea.value += opentag + closetag;
        textarea.focus(textarea.value.length - 1);
    }
} 
// -->
</script>

  <table cellpadding="0" cellspacing="0">
    <tr>
      <td>
      <table cellpadding="0" cellspacing="1" align="left">
      <tr><td align="left"><input class="btn" style="font-weight: bold;" type="button" name="bold" value="B " onclick="javascript: BBTag('[b]','[/b]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input class="btn" style="font-style: italic;" type="button" name="italic" value="i " onclick="javascript: BBTag('[i]','[/i]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input class="btn" style="text-decoration: underline;" type="button" name="underline" value="U " onclick="javascript: BBTag('[u]','[/u]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="li" value="List " onclick="javascript: BBTag('[*]','',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="code" value="Code" onclick="javascript: BBTag('[code]','[/code]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="quote" value="Quote" onclick="javascript: BBTag('[quote]','[/quote]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="url" value="Url" onclick="javascript: BBTag('[url]','[/url]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="img" value="Img" onclick="javascript: BBTag('[img]','[/img]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="br" value="br" onclick="javascript: BBTag('[br]','',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        </tr></table>
</td></tr>
<tr><td valign="top">
        <table width="50%" cellpadding="0" cellspacing="1" align="left">
                <tr colspan="2">
                <td align="left"><select onchange="BBTag('[size=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/size]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background: #E9F4F8;" name="fontchange">
              <option value="" selected="selected">Font Size</option>
              <option value="1">xx-small</option>
              <option value="2">x-small</option>
              <option value="3">small</option>
              <option value="4">medium</option>
              <option value="5">large</option>
              <option value="6">x-large</option>
              <option value="7">xx-large</option>
              </select></td>
                 <td align="left" style="text-align:left;"><select onchange="BBTag('[color=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/color]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background: #E9F4F8;" name="fontchange">
              <option value="" selected="selected">Change Color</option>
              <option value="Black" style="color:gray">Black</option>
              <option value="Red" style="color:red">Red</option>
              <option value="Yellow" style="color:Yellow">Yellow</option>
              <option value="Pink" style="color:Pink">Pink</option>
              <option value="Green" style="color:Green">Green</option>
              <option value="Orange" style="color:Orange">Orange</option>
              <option value="Purple" style="color:Purple">Purple</option>
              <option value="Blue" style="color:Blue">Blue</option>
              <option value="Beige" style="color:Beige">Beige</option>
              <option value="Brown" style="color:Brown">Brown</option>
              <option value="Teal" style="color:Teal">Teal</option>
              <option value="Navy" style="color:Navy">Navy</option>
              <option value="Maroon" style="color:Maroon">Maroon</option>
              <option value="LimeGreen" style="color:LimeGreen">Lime Green</option>
              </select></td>
      </tr>
      </table>
</td></tr>
<tr><td valign="top">
      </td>
    </tr>
    <tr>
      <td>
      <textarea name="<tag:object_name />" rows="10" style="width:96%" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onchange="storeCaret(this);"><tag:content /></textarea>
      </td>
    </tr>
		<tr>
      <td><center>
      <tag:smilies_table /></center>
      <center>
      <a href="javascript: PopMoreSmiles('<tag:form_name />','<tag:object_name />')"><tag:language.MORE_SMILES /></a></center>
      </td>
    </tr>
  </table>

