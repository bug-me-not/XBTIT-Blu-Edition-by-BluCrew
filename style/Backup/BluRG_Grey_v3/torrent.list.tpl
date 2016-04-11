<script type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
if(!document.forms[FormName])
return;
var objCheckBoxes = document.forms[FormName].elements[FieldName];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = CheckValue;
else
// set the check value for all check boxes
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = CheckValue;
}
</script>
<if:rtorr_enabled>
<div align="center">
<table width="100%">
  <tr>
    <td>
      <table width="100%" class="lista" cellspacing=1>
        <tr>
          <td class="block" colspan="14" align="center"><b><tag:language.RTORR_OUR_TEAM /></b></td>
        </tr>
        <tr>
          <td class="header" align="center" width="45"><tag:language.CATEGORY /></td>
          <td align="center" class="header" ><tag:language.FILE /></td>
		  <if:reql1>
		  
		  </if:reql1>
          
          <td align="center" class="header" width="85"><tag:language.ADDED /></td>
		  <td align="center" class="header" width="30"><tag:language.SHORT_S /></td>
          <td align="center" class="header" width="30"><tag:language.SHORT_L /></td>
		  <td align="center" class="header" width="30"><tag:req_header_complete /></td>
		  <if:reql2>
		  <td align="center" class="header" width="100"><tag:language.UPLOADER /></td>
          <td align="center" class="header" width="70"><tag:language.SIZE /></td>
		  </if:reql2>
		  <if:XBTT_1>
          <else:XBTT_1>
          
          </if:XBTT_1>
		  
          <td align="center" class="header" width="100"><tag:language.RTORR_REC_BY /></td>
          <if:rtorr_del_1>
          <td align="center" class="header" width="40"><tag:language.RTORR_REMOVE /></td>
          </if:rtorr_del_1>
        </tr>

        <loop:tora>
        <tr>
          <td style="text-align:center;" class="lista"><a href="index.php?page=torrents&amp;category=<tag:tora[].catid />"><tag:tora[].image /></td>
          <if:usepopup>
          <td class="lista"><a href="javascript:popdetails('index.php?page=torrent-details&amp;id=<tag:tora[].hash />')"><tag:tora[].filename /></a><if:free_leech_enabled_req><tag:tora[].free /></if:free_leech_enabled_req><if:gast_enabled_req><tag:tora[].gold /></if:gast_enabled_req><tag:tora[].EXT /></td>
          <else:usepopup>
          <td class="lista"><a href="index.php?page=torrent-details&amp;id=<tag:tora[].hash />"><tag:tora[].filename /></a><if:free_leech_enabled_req><tag:tora[].free /></if:free_leech_enabled_req><if:gast_enabled_req><tag:tora[].gold /></if:gast_enabled_req><tag:tora[].EXT /></td>
          </if:usepopup>
		  <if:reql3>
		  
		  </if:reql3>
          
          <td style="text-align:center;" class="lista"><tag:tora[].date /></td>
		  <tag:tora[].rp17 />
          <tag:tora[].rp18 />
		  <td style="text-align:center;" class="lista"><tag:tora[].complete /></td>
		  <if:reql4>
          <td style="text-align:center;" class="lista"><tag:tora[].uploader /></td>
		  <td style="text-align:center;" class="lista"><tag:tora[].size /></td>
		  </if:reql4>
          <if:XBTT_2>
          <else:XBTT_2>
          
          </if:XBTT_2>
		  
          <td style="text-align:center;" class="lista"><tag:tora[].recommender /></td>
          <if:rtorr_del_2>
          <td style="text-align:center;" class="lista"><a href="index.php?page=torrents&action=remove&info_hash=<tag:tora[].hash />"><tag:tora[].del_img /></a></td>
          </if:rtorr_del_2>
        </tr>
        </loop:tora>
      </table>
    </td>
  </tr>
</table><br />
</div>
</if:rtorr_enabled>

<div align="center">
<form action="<tag:torrent_script />" method="get" name="torrent_search">
  <input type="hidden" name="page" value="torrents" />
  <table border="0" class="lista" align="center">
    <tr>
      <td class="block"><tag:language.TORRENT_SEARCH /></td>
      <td class="block"><tag:language.CATEGORY_FULL /></td>
      <if:ash_enabled_1>
      <td class="block"><tag:language.TORRENT_OPTIONS /></td>
      </if:ash_enabled_1>
      <td class="block"><tag:language.TORRENT_STATUS /></td>
      <td class="block">&nbsp;</td>
    </tr>
    <tr>
      <td><input type="text" name="search" size="25" maxlength="50" value="<tag:torrent_search />" /></td>
      <td>
        <tag:torrent_categories_combo />
      </td>

      <if:ash_enabled_2>
      <td>
        <select name="options" size="1">
        <option value="0" <tag:torrent_selected_file />><tag:language.FIL /></option>
        <option value="1" <tag:torrent_selected_filedes />><tag:language.FILDES /></option>
        <option value="2" <tag:torrent_selected_des />><tag:language.DES /></option>
        <option value="3" <tag:torrent_selected_upl />><tag:language.UPLS /></option>
        <if:imdb_enabled>
        <option value="18" <tag:torrent_selected_gen />><tag:language.IMDB_GENRE /></option>
        <option value="4" <tag:torrent_selected_im />><tag:language.IMDB_SEARCH /></option>
        </if:imdb_enabled>
        <if:gold_enabled>
        <option value="5" <tag:torrent_selected_gold />><tag:language.IS_GOLD /> <tag:language.TORRENTS /></option>
        <option value="6" <tag:torrent_selected_silver />><tag:language.IS_SILVER /> <tag:language.TORRENTS /></option>
        <option value="7" <tag:torrent_selected_bronze />><tag:language.IS_BRONZE /> <tag:language.TORRENTS /></option>
        </if:gold_enabled>
        <if:mult_enabled>
        <option value="8" <tag:torrent_selected_mul1 />>1x <tag:language.UPM_UPL_MULT /></option>
        <option value="9" <tag:torrent_selected_mul2 />>2x <tag:language.UPM_UPL_MULT /></option>
        <option value="10" <tag:torrent_selected_mul3 />>3x <tag:language.UPM_UPL_MULT /></option>
        <option value="11" <tag:torrent_selected_mul4 />>4x <tag:language.UPM_UPL_MULT /></option>
        <option value="12" <tag:torrent_selected_mul5 />>5x <tag:language.UPM_UPL_MULT /></option>
        <option value="13" <tag:torrent_selected_mul6 />>6x <tag:language.UPM_UPL_MULT /></option>
        <option value="14" <tag:torrent_selected_mul7 />>7x <tag:language.UPM_UPL_MULT /></option>
        <option value="15" <tag:torrent_selected_mul8 />>8x <tag:language.UPM_UPL_MULT /></option>
        <option value="16" <tag:torrent_selected_mul9 />>9x <tag:language.UPM_UPL_MULT /></option>
        <option value="17" <tag:torrent_selected_mul10 />>10x <tag:language.UPM_UPL_MULT /></option>
        </if:mult_enabled>
        </select>
      </td>
      </if:ash_enabled_2>

      <td>
        <select name="active" size="1">
        <if:arc_enabled>
          <if:new_allowed1>
            <option value="0" <tag:torrent_selected_all />><tag:language.ALL /> (<tag:language.ARC_NEW />)</option>
          </if:new_allowed1>
          <if:arc_allowed1>
            <option value="3" <tag:torrent_selected_all2 />><tag:language.ALL /> (<tag:language.ARC_ARC />)</option>
          </if:arc_allowed1>
          <if:new_allowed2>
            <option value="1" <tag:torrent_selected_active />><tag:language.ACTIVE_ONLY /> (<tag:language.ARC_NEW />)</option>
          </if:new_allowed2>
          <if:arc_allowed2>
            <option value="4" <tag:torrent_selected_active2 />><tag:language.ACTIVE_ONLY /> (<tag:language.ARC_ARC />)</option>
          </if:arc_allowed2>
          <if:new_allowed3>
            <option value="2" <tag:torrent_selected_dead />><tag:language.DEAD_ONLY /> (<tag:language.ARC_NEW />)</option>
          </if:new_allowed3>
          <if:arc_allowed3>
            <option value="5" <tag:torrent_selected_dead2 />><tag:language.DEAD_ONLY /> (<tag:language.ARC_ARC />)</option>
          </if:arc_allowed3>
        <else:arc_enabled>
          <option value="0" <tag:torrent_selected_all />><tag:language.ALL /></option>
          <option value="1" <tag:torrent_selected_active />><tag:language.ACTIVE_ONLY /></option>
          <option value="2" <tag:torrent_selected_dead />><tag:language.DEAD_ONLY /></option>
        </if:arc_enabled>
        </select>
      </td>
      <td><input type="submit" class="btn" value="<tag:language.SEARCH />" /></td>
     </tr>
  </table>
</form>
</div>

<table width="100%">

  <tr>
    <td colspan="2" align="center"> <tag:torrent_pagertop /></td>
  </tr>
<if:multi_del><form name="deltorrent" action="index.php?page=torrents&do=del" method="post"></if:multi_del>

  <tr>
    <td>
      <table width="100%" class="lista">
        <tr>
          <td align="center" width="45" class="header"><tag:torrent_header_category /></td>
          <if:fls_enabled1>
            <td align="center" width="45" class="header"><tag:language.FLS_CUSTOM_FL /></td>
          </if:fls_enabled1>
          <td align="center" class="header"><tag:torrent_header_filename /></td>

          <if:torlang1>
          <td align="center" class="header"><tag:torrent_header_language /></td>
          </if:torlang1>

          <if:usacotl1>
          <td align="center" width="30"class="header"><tag:torrent_header_comments /></td>
          </if:usacotl1>

          <if:WT>
          <td align="center" width="20" class="header"><tag:torrent_header_waiting /></td>
          <else:WT>
          </if:WT>
          <td align="center" width="20" class="header"><tag:torrent_header_download /></td>

          <if:imdb_enabled_2>
          <td align="center" width="20" class="header"><tag:torrent_header_imdb /></td>
          </if:imdb_enabled_2>

          <td align="center" width="85" class="header"><tag:torrent_header_added /></td>
          <td align="center" width="30" class="header"><tag:torrent_header_seeds /></td>
          <td align="center" width="30" class="header"><tag:torrent_header_leechers /></td>
          <td align="center" width="30" class="header"><tag:torrent_header_complete /></td>
          <if:usacotl2>
          <if:show_uploader1>
          <td align="center" width="30" class="header"><tag:torrent_header_uploader /></td>
          </if:show_uploader1>
          <td align="center" width="30" class="header"><tag:torrent_header_size /></td>
          </if:usacotl2>

          <if:XBTT>
          <else:XBTT>
          <td align="center" width="45" class="header"><tag:torrent_header_speed /></td>
          </if:XBTT>
          <td align="center" width="45" class="header"><tag:torrent_header_average /></td>

          <if:show_recommended_1>
          <td align="center" width="45" class="header"><tag:language.RTORR_REC /></td>
          </if:show_recommended_1>
          <tag:torrent_header_allow />
        </tr>
        <loop:torrents>
        <tag:torrents[].dt />
        <tr>
          <td align="center" width="45" class="lista" style="text-align: center;<if:sticky_enabled_1><tag:torrents[].color /></if:sticky_enabled_1>"><tag:torrents[].category /></td>
          <if:fls_enabled2>
            <td align="center" width="45" class="lista" style="text-align: center;<if:sticky_enabled_15><tag:torrents[].color /></if:sticky_enabled_15>"><tag:torrents[].custom_freeleech /></td>
          </if:fls_enabled2>
          <td class="lista" valign="middle" onMouseOver="this.className='post'" onMouseOut="this.className='lista'" style="padding-left:10px;overflow:auto;<if:sticky_enabled_2><tag:torrents[].color /></if:sticky_enabled_2>"><tag:torrents[].filename /><if:free_leech_enabled><tag:torrents[].free /></if:free_leech_enabled><if:gast_enabled><tag:torrents[].gold /></if:gast_enabled>
<tag:torrents[].imdb_genre /></td>
          <if:torlang2>
          <td align="center" width="45" class="lista" style="text-align: center;"><tag:torrents[].language /></td>
          </if:torlang2>
          <if:usacotl3>
          <td align="center" width="30" class="lista" style="white-space:wrap;padding-left:10px;<if:sticky_enabled_11><tag:torrents[].color /></if:sticky_enabled_11>"><tag:torrents[].comments />
          </if:usacotl3>

          <if:WT1>
          <td align="center" width="20" class="lista" style="text-align: center;<if:sticky_enabled_3><tag:torrents[].color /></if:sticky_enabled_3>"><tag:torrents[].waiting /></td>
          <else:WT1>
          </if:WT1>
          <td align="center" width="20" class="lista" style="text-align: center;<if:sticky_enabled_4><tag:torrents[].color /></if:sticky_enabled_4>"><tag:torrents[].download /></td>

		  <if:imdb_enabled_3>
          <td align="center" width="20" class="lista" style="text-align: center;<if:sticky_enabled_14><tag:torrents[].color /></if:sticky_enabled_14>"><tag:torrents[].imdb /></td>
          </if:imdb_enabled_3>

          <td align="center" width="85" class="lista" style="white-space:wrap; text-align:center;<if:sticky_enabled_5><tag:torrents[].color /></if:sticky_enabled_5>"><tag:torrents[].added /></td>
          <td align="center" width="30" class="lista <tag:torrents[].classe_seeds />" style="text-align: center;<if:sticky_enabled_6><tag:torrents[].color /></if:sticky_enabled_6>"><tag:torrents[].seeds /></td>
          <td align="center" width="30" class="lista <tag:torrents[].classe_leechers />" style="text-align: center;<if:sticky_enabled_7><tag:torrents[].color /></if:sticky_enabled_7>"><tag:torrents[].leechers /></td>
          <td align="center" width="30" class="lista" style="text-align: center;<if:sticky_enabled_8><tag:torrents[].color /></if:sticky_enabled_8>"><tag:torrents[].complete /></td>
          <if:usacotl4>
          <if:show_uploader2>
          <td align="center" width="30" class="lista"<if:sticky_enabled_12> style="<tag:torrents[].color />"</if:sticky_enabled_12>><tag:torrents[].uploader /></td>
          </if:show_uploader2>
          <td align="center" width="30" class="lista"<if:sticky_enabled_13> style="<tag:torrents[].color />"</if:sticky_enabled_13>><tag:torrents[].size /></td>
          </if:usacotl4>

         <if:XBTT1>
          <else:XBTT1>
          <td align="center" width="45" class="lista" style="text-align: center;<if:sticky_enabled_9><tag:torrents[].color /></if:sticky_enabled_9>"><tag:torrents[].speed /></td>
          </if:XBTT1>
          <td align="center" width="45" class="lista" style="text-align: center;<if:sticky_enabled_10><tag:torrents[].color /></if:sticky_enabled_10>"><tag:torrents[].average /></td>

          <if:show_recommended_2>
          <td align="center" width="45" class="lista" style="text-align: center;"><tag:torrents[].recommended /></td>
          </if:show_recommended_2>
          <tag:torrents[].allow />
          
        </tr>
        </loop:torrents>
        <if:multi_del1>
        <tr>
        <td align="right" colspan="12">
        <tag:delit />
       </tr>
       <if:multi_del1>
  <tr>
    <td colspan="12" align="center"> <tag:torrent_pagerbottom /></td>
  </tr>
</table></td>
</tr></table>
<if:multi_del3>
</form>
</if:multi_del3>