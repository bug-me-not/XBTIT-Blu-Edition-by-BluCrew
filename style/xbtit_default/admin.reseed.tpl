<div align='center'>
  <form name='reseed' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=reseed'>
    <table>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.RESEED_MIN_SEE />:</td>
        <td class='lista'><input type="text" name="reseed_minSeeds" value="<tag:reseed_minSeeds />" size="4" /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.RESEED_MIN_FIN />:</td>
        <td class='lista'><input type="text" name="reseed_minFinished" value="<tag:reseed_minFinished />" size="4" /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.RESEED_MIN_LEE />:</td>
        <td class='lista'><input type="text" name="reseed_minLeechers" value="<tag:reseed_minLeechers />" size="4" /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.RESEED_MIN_TOR />:</td>
        <td class='lista'><input type="text" name="reseed_minTorrentAgeInDays" value="<tag:reseed_minTorrentAgeInDays />" size="4" /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.RESEED_MIN_REQ />:</td>
        <td class='lista'><input type="text" name="reseed_minDaysSinceLast" value="<tag:reseed_minDaysSinceLast />" size="4" /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>