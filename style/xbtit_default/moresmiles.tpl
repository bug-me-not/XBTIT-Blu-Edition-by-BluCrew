<script type="text/javascript">

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
</script>
<table class="lista" width="100%" cellpadding="1" cellspacing="1">
<loop:smiles>
  <tr>
    <td class="lista" align="center">
    <tag:smiles[].first_col />
    </td>
    <td class="lista" align="center">
    <tag:smiles[].second_col />
    </td>
    <td class="lista" align="center">
    <tag:smiles[].third_col />
    </td>
  </tr>
</loop:smiles>
</table>
<div align="center">
  <a href="javascript: window.close()"><tag:language.CLOSE /></a>
</div>

