<script type="text/javascript">
<!--
function switchGoldRevert()
{
    document.towmethod.goldRevert[0].checked=true;
}
function switchMultiRevert()
{
    document.towmethod.multiRevert[0].checked=true;
}
-->
</script>

<div align='center'>
  <if:initialRun>
    <form name='towsearch' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=tow&search=true'>
      <table>
        <tr>
          <td class='header' align='right'><tag:language.TOW_TORRENT_SEARCH />:</td>
          <td class='lista'><input type="text" name="torrentsearch" value="" size="40" />&nbsp;
          </td>
        </tr>
        <tr>
          <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
        </tr>
      </table>
    </form>
  <else:initialRun>
    <if:searchFoundTorrents>
      <form name='towsearch' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=tow&search=true&selected=true'>
        <table width="100%" class="lista">      
          <tr>
            <td align="center" width="45" class="header"><tag:language.CATEGORY /></td>
            <td align="left" class="header"><tag:language.FIL /></td>
            <td align="center" width="85" class="header"><tag:language.ADDED /></td>
            <td align="center" width="30" class="header"><tag:language.SHORT_S /></td>
            <td align="center" width="30" class="header"><tag:language.SHORT_L /></td>
            <td align="center" width="30" class="header"><tag:language.SHORT_C /></td>
            <td align="center" width="10" class="header"><tag:language.TOW_CHOOSE /></td>
          </tr>
          <loop:foundTorrents>
            <tr>
              <td class="lista" style="text-align:center;"><tag:foundTorrents[].category /></td>
              <td class="lista" style="text-align:left;"><tag:foundTorrents[].filename /><tag:foundTorrents[].currentGoldIcon /><tag:foundTorrents[].currentMultiIcon /></td>
              <td class="lista" style="text-align:center;"><tag:foundTorrents[].upload_date /></td>
              <td class="lista" style="text-align:center;"><tag:foundTorrents[].seeds /></td>
              <td class="lista" style="text-align:center;"><tag:foundTorrents[].leechers /></td>
              <td class="lista" style="text-align:center;"><tag:foundTorrents[].finished /></td>
              <td class="lista" style="text-align:center;"><tag:foundTorrents[].radio /></td>
            </tr>
          </loop:foundTorrents>
          <tr>
            <td class='blocklist' align='center' colspan='7'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
          </tr>
        </table>
      </form>
    </if:searchFoundTorrents>
    <if:haveGotTorrent>
      <form name='towmethod' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=tow&search=true&selected=true&method=true'>
        <table width="100%" class="lista">      
          <tr>
            <td class="blocklist" colspan="6" style="text-align:center;font-weight:bold;"><tag:language.TOW_SEL_TORR /></td>
          </tr>
          <tr>
            <td align="center" width="100" class="header"><tag:language.CATEGORY /></td>
            <td align="left" class="header"><tag:language.FIL /></td>
            <td align="center" width="85" class="header"><tag:language.ADDED /></td>
            <td align="center" width="50" class="header"><tag:language.SHORT_S /></td>
            <td align="center" width="50" class="header"><tag:language.SHORT_L /></td>
            <td align="center" width="50" class="header"><tag:language.SHORT_C /></td>
          </tr>
          <tr>
            <td class="lista" style="text-align:center;"><tag:gotCategory /></td>
            <td class="lista" style="text-align:left;"><tag:gotFilename /><tag:currentGoldIcon /><tag:currentMultiIcon /></td>
            <td class="lista" style="text-align:center;"><tag:gotUploadDate /></td>
            <td class="lista" style="text-align:center;"><tag:gotSeeds /></td>
            <td class="lista" style="text-align:center;"><tag:gotLeechers /></td>
            <td class="lista" style="text-align:center;"><tag:gotFinished /></td>
          </tr>
          <tr>
            <td class="blocklist" colspan="6" style="text-align:center;font-weight:bold;"><tag:language.TOW_CHOOSE_SET /></td>
          </tr>
          <tr>
            <td class="header" colspan="1"><tag:language.TOW_SEL_FOR />:</td>
            <td class="lista" colspan="1"><tag:language.TOW_THIS_WEEK /> <input type="radio" name="whichWeek" value="this" checked /> <tag:language.TOW_NEXT_WEEK /> <input type="radio" name="whichWeek" value="next" /></td>
            <td class="header" colspan="1"><tag:language.TOW_IMPRI />:</td>
            <td class="lista" colspan="3">
              <table>
                <tr>
                  <td><tag:language.TVDB_PRIORITY_1 /></td>
                  <td><select name="priority1">
                    <option value="1" selected="selected"><tag:language.IMGFL_IU /></option>
                    <option value="2"><tag:language.IMGFL_IMDB /></option>
                    <option value="3"><tag:language.IMGFL_TVDB /></option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><tag:language.TVDB_PRIORITY_2 /></td>
                  <td><select name="priority2">
                    <option value="1"><tag:language.IMGFL_IU /></option>
                    <option value="2" selected="selected"><tag:language.IMGFL_IMDB /></option>
                    <option value="3"><tag:language.IMGFL_TVDB /></option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><tag:language.TVDB_PRIORITY_3 /></td>
                  <td><select name="priority3">
                    <option value="1"><tag:language.IMGFL_IU /></option>
                    <option value="2"><tag:language.IMGFL_IMDB /></option>
                    <option value="3" selected="selected"><tag:language.IMGFL_TVDB /></option>
                    </select>
                  </td>
                </tr>
              </table>
            </td>
         </tr>
         <if:multiAllowed>
         </tr>
            <td class="header" colspan="1"><tag:language.TOW_SET_MULTI />:</td>
            <td class="lista" colspan="1">
              <select name="multiplier">
                <option value="1"<if:is1X> selected="selected"</if:is1X> onclick="switchMultiRevert();">1x</option>
                <option value="2"<if:is2X> selected="selected"</if:is2X> onclick="switchMultiRevert();">2x</option>
                <option value="3"<if:is3X> selected="selected"</if:is3X> onclick="switchMultiRevert();">3x</option>
                <option value="4"<if:is4X> selected="selected"</if:is4X> onclick="switchMultiRevert();">4x</option>
                <option value="5"<if:is5X> selected="selected"</if:is5X> onclick="switchMultiRevert();">5x</option>
                <option value="6"<if:is6X> selected="selected"</if:is6X> onclick="switchMultiRevert();">6x</option>
                <option value="7"<if:is7X> selected="selected"</if:is7X> onclick="switchMultiRevert();">7x</option>
                <option value="8"<if:is8X> selected="selected"</if:is8X> onclick="switchMultiRevert();">8x</option>
                <option value="9"<if:is9X> selected="selected"</if:is9X> onclick="switchMultiRevert();">9x</option>
                <option value="10"<if:is10X> selected="selected"</if:is10X> onclick="switchMultiRevert();">10x</option>
              </select>
            </td>
            <td class="header" colspan="1"><tag:language.TOW_REV_AFTER />:</td>
            <td class="lista" colspan="3"><tag:language.YES /> <input type="radio" name="multiRevert" id="multiRevert" value="yes" /> <tag:language.NO /> <input type="radio" name="multiRevert" value="no"  checked /></td>
          </tr>
         </if:multiAllowed>
         <if:goldAllowed>
         </tr>
            <td class="header" colspan="1"><tag:language.TOW_SET_GOLD />:</td>
            <td class="lista" colspan="1">
              <tag:classicDesc /> <input type="radio" name="goldType" value="0" <if:isClassic>checked </if:isClassic> onclick="switchGoldRevert();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <tag:goldIcon /> <input type="radio" name="goldType" value="2" <if:isGold>checked </if:isGold> onclick="switchGoldRevert();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <tag:silverIcon /> <input type="radio" name="goldType" value="1" <if:isSilver>checked </if:isSilver> onclick="switchGoldRevert();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <tag:bronzeIcon /> <input type="radio" name="goldType" value="3" <if:isBronze>checked </if:isBronze> onclick="switchGoldRevert();" />
            </td>
            <td class="header" colspan="1"><tag:language.TOW_REV_AFTER />:</td>
            <td class="lista" colspan="3"><tag:language.YES /> <input type="radio" name="goldRevert" id="goldRevert" value="yes" /> <tag:language.NO /> <input type="radio" name="goldRevert" value="no" checked /></td>
          </tr>
          </if:goldAllowed>
         <tr>
            <td class='blocklist' align='center' colspan='6'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
          </tr>
        </table>
        <input type="hidden" name="torrentId" value="<tag:torrentId />" />
        <input type="hidden" name="originalGold" value="<tag:originalGold />" />
        <input type="hidden" name="originalMulti" value="<tag:originalMulti />" />
      </form>
    </if:haveGotTorrent>
  </if:initialRun>
</div>