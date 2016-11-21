<script>
function addToTextarea(country_code)
{
    document.getElementById('country_codes').value += country_code + '\r\n';
}
</script>

<div align='center'>
  <form name='csignup' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=csignup'>
    <table>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.CSIGN_SELECT_COUNTRY />:</td>
        <td class='lista'>
          <select name='countrylist'>
            <tag:select />
          </select>
        </td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.CSIGN_COUNT_TO_BLOCK />:</td>
        <td class='lista'><textarea name='country_codes' id='country_codes' cols='36' rows='10'><tag:currentBlocked /></textarea></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />' /></td>
      </tr>
    </table>
  </form>
</div>