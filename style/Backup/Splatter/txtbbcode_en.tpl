
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

  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td>
      <table width="50%" cellpadding="0" cellspacing="5" align="left">
      <tr>
        <td align="left"><input type="button" class="btn" name="code" value="Code" onclick="javascript: BBTag('[code]','[/code]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="quote" value="Quote" onclick="javascript: BBTag('[quote]','[/quote]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="url" value="Url" onclick="javascript: BBTag('[url]','[/url]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="img" value="Img" onclick="javascript: BBTag('[img]','[/img]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left" style="height:25px;"><input type="button" class="btn" name="noparse" value="NoParse" onclick="javascript: BBTag('[noparse]','[/noparse]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left" style="height:25px;"><input type="button" class="btn" name="br" value="br" onclick="javascript: BBTag('[br]','',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
     	  <td align="left" style="height:25px;"><input type="button" class="btn" name="li" value="*" onclick="javascript: BBTag('[*]','',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
     	  <td align="left" style="height:25px;"><input type="button" class="btn" name="hr" value="hr" onclick="javascript: BBTag('[hr]','',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="email" value="Email" onclick="javascript: BBTag('[email]','[/email]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>
        <td align="left"><input type="button" class="btn" name="spoiler" value="Spoiler" onclick="javascript: BBTag('[Spoiler]','[/Spoiler]',document.forms.<tag:form_name />.<tag:object_name />)" /></td>

          </tr>
</table>
</td></tr>
<tr><td valign="top">
<table width="40%" cellpadding="0" cellspacing="5" align="left">
<td align="left"><select onchange="BBTag('[' + this.options[this.selectedIndex].value + ']', '[/align]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="videoalignment">
              <option value="" selected="selected">Video Alignment</option>
              <option value="align=left">Left</option>
              <option value="align=center">Center</option>
              <option value="align=right">Right</option>
              </select></td>
<td align="left"><select onchange="BBTag('[' + this.options[this.selectedIndex].value, ']', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="videotype">
              <option value="" selected="selected">Video Types</option>
              <option value="video=">YouTube Videos</option>
              <option value="video=">Google Videos</option>
              <option value="video=">Flash Videos</option>
              </select></td>
              </tr>
	      </table>
</td></tr>
<tr><td valign="top">
        <table width="50%" cellpadding="0" cellspacing="5" align="left">
                <tr colspan="2">
                <td align="left"><select onchange="BBTag('[size=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/size]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="fontchange">
              <option value="" selected="selected">Font Size</option>
              <option value="smaller">smaller</option>
              <option value="xx-small">xx-small</option>
              <option value="x-small">x-small</option>
              <option value="small">small</option>
              <option value="medium">medium</option>
              <option value="large">large</option>
              <option value="x-large">x-large</option>
              <option value="xx-large">xx-large</option>
              <option value="larger">larger</option>
              </select></td>
                 <td align="left" style="text-align:left;"><select onchange="BBTag('[color=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/color]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="fontchange">
              <option value="" selected="selected">Text Color</option>
              <option value="Black" style="color:black">Black</option>
              <option value="Blue" style="color:Blue">Blue</option>
              <option value="Fuchsia" style="color:Fuchsia">Fuchsia</option>
              <option value="Gray" style="color:Gray">Gray</option>
              <option value="Green" style="color:Green">Green</option>
              <option value="Maroon" style="color:Maroon">Maroon</option>
              <option value="Navy" style="color:Navy">Navy</option>
              <option value="Olive" style="color:Olive">Olive</option>
              <option value="Purple" style="color:Purple">Purple</option>
              <option value="Red" style="color:red">Red</option>
              <option value="Aqua" style="color:Aqua">Aqua</option>
              <option value="Lime" style="color:Lime">Lime</option>
              <option value="Silver" style="color:Silver">Silver</option>
              <option value="Teal" style="color:Teal">Teal</option>
              <option value="White" style="color:White">White</option>
              <option value="Yellow" style="color:Yellow">Yellow</option>
              </select></td>
                 <td align="left" style="text-align:left;"><select onchange="BBTag('[bg-color=' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/bg-color]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="fontchange">
              <option value="" selected="selected">Background Color</option>
              <option value="Black" style="color:white; background:Black">Black</option>
              <option value="Blue" style="color:white; background:Blue">Blue</option>
              <option value="Fuchsia" style="color:white; background:Fuchsia">Fuchsia</option>
              <option value="Gray" style="color:white; background:Gray">Gray</option>
              <option value="Green" style="color:white; background:Green">Green</option>
              <option value="Maroon" style="color:white; background:Maroon">Maroon</option>
              <option value="Navy" style="color:white; background:Navy">Navy</option>
              <option value="Olive" style="color:white; background:Olive">Olive</option>
              <option value="Purple" style="color:white; background:Purple">Purple</option>
              <option value="Red" style="color:white; background:Red">Red</option>
              <option value="Aqua" style="color:black; background:Aqua">Aqua</option>
              <option value="Lime" style="color:black; background:Lime">Lime</option>
              <option value="Silver" style="color:black; background:Silver">Silver</option>
              <option value="Teal" style="color:white; background:Teal">Teal</option>
              <option value="White" style="color:black; background:White">White</option>
              <option value="Yellow" style="color:black; background:Yellow">Yellow</option>
              </select></td>
              </tr>
	      </table>
</td></tr>
<tr><td valign="top">
        <table width="65%" cellpadding="0" cellspacing="5" align="left">
                <td align="left"><select onchange="BBTag('[' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/' + this.options[this.selectedIndex].value.toLowerCase() + ']', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="fontchange">
              <option value="" selected="selected">Text Formatting</option>
              <option value="none">no formatting</option>
              <option value="b" style="font-weight: bold;">bold text</option>
              <option value="i" style="font-style: italic;">italic text</option>
              <option value="u" style="text-decoration: underline;">underline</option>
              <option value="strike" style="text-decoration: line-through;">strike-through</option>
              <option value="overline" style="text-decoration: overline;">overline</option>
              <option value="tt">teletype text</option>
              <option value="sub">subscript</option>
              <option value="sup">superscript</option>
              <option value="blink">blinking text</option>
              </select></td>
                <td align="left"><select onchange="BBTag('[' + this.options[this.selectedIndex].value.toLowerCase() + ']','[/' + this.options[this.selectedIndex].value.toLowerCase() + ']', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="fontchange">
              <option value="" selected="selected">Text Alignment</option>
              <option value="left">left</option>
              <option value="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;right</option>
              <option value="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;center</option>
              <option value="justified">j u s t i f i e d</option>
              <option value="pre">preformatted</option>
              </select></td>
                <td align="left"><select onchange="BBTag('[' + this.options[this.selectedIndex].value + ']', '[/scroll]', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="scroll">
              <option value="" selected="selected">Scrolling Text</option>
              <option value="scroll=left">Scroll Left</option>
              <option value="scroll=right">Scroll Right</option>
              <option value="scroll=up">Scroll Up</option>
              <option value="scroll=down">Scroll Down</option>
              </select></td>
                <td align="left"><select onchange="BBTag('[' + this.options[this.selectedIndex].value + ']\n[*]\n[*]\n[/list]', '', document.forms.<tag:form_name />.<tag:object_name />); this.selectedIndex = 0;" size="1" style="background:#373737;" name="fontchange">
              <option value="" selected="selected">Lists</option>
              <option value="list">unordered list</option>
              <option value="list=circle">circle list</option>
              <option value="list=square">Square List</option>
              <option value="list=1">Numbered List</option>
              <option value="list=A">UPPERCASE LETTERS</option>
              <option value="list=a">lowercase letters</option>
              <option value="list=I">UPPERCASE ROMAN</option>
              <option value="list=i">lowercase Roman</option>

              </select></td>
          </tr>
</table>
</td></tr>
<tr><td valign="top">
      </td>
    </tr>
    <tr>
      <td>
      <textarea name="<tag:object_name />" rows="15" style="width:96%" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onchange="storeCaret(this);"><tag:content /></textarea>
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