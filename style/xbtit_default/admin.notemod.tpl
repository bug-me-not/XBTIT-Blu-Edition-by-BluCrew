<if:is_edit>
<div align='center'>
  <form name='notemod' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=notemod&action=edit_submit&noteid=<tag:noteid />&eduser=<tag:eduser />&returnto=<tag:returnto />'>
    <table>


      <tr>
        <td class="lista"><tag:editnote /></td>
      </tr>


      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
</if:is_edit>