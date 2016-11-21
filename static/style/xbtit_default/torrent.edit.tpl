<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Edit Upload</h4>
</div>
<div align="center">
  <form<if:tmod1_enabled> id="postmodify"</if:tmod1_enabled><if:nfo_enabled> enctype="multipart/form-data"</if:nfo_enabled> action="<tag:torrent.link />" method="post" name="edit" <if:imageup_enabled>enctype="multipart/form-data"</if:imageup_enabled> >
    <table class="table table-bordered">
      <tr>
        <td align="right" class="header"><tag:language.FILE /></td>
        <td class="lista">
        <div class="input-group">
        <input type="text" class="form-control" name="name" value="<tag:torrent.filename />" id="validate-text" size="50" maxlength="200" required="">
        <span class="input-group-addon danger"><span class="fa fa-times"></span></span>
        </div>
        <if:nfo_enabled2><br /><tag:torrent.nfo /></if:nfo_enabled2>
        </td>
      </tr>

      <if:bump_enabled>
      <tr>
        <td align="right" class="header"><tag:language.BUMP_THIS_TORR /></td>
        <td class="lista"><tag:language.YES />&nbsp;<input type="radio" name="bump_torr" value="yes" />&nbsp;&nbsp;&nbsp;&nbsp;<tag:language.NO />&nbsp;<input type="radio" name="bump_torr" value="no"  checked="checked" /></td>
      </tr>
      </if:bump_enabled>

      <if:ddl_enabled>
      <tr>
        <td align="right" class="header"><tag:language.DIRECT_LINK /></td>
        <td class="lista"><input type="text" name="direct_link" value="<tag:torrent.direct_link />" size="60" maxlength="255" /></td>
      </tr>
      </if:ddl_enabled>

      <if:st_comm_enabled>
      <if:LEVEL_SC>
      <tr>
      <td class="header"><tag:language.STAFF_COMMENT /></td>
      <td class="lista" align="left"><textarea name="staff_comment" rows="3" cols="45"><tag:staff_comment /></textarea></td>
      </tr>
      </if:LEVEL_SC>
      </if:st_comm_enabled>

      <if:tmod2_enabled>
      <tr>
        <td class="header"><tag:language.TORRENT_MODERATION /></td>
        <td class="lista"><tag:torrent.moder /></td>
      </tr>
      </if:tmod2_enabled>

      <if:tvdb_enabled>
      <tr>
        <td align="right" class="header"><tag:language.TVDB_UL_TITLE /></td>
        <td class="lista" align="left"><tag:language.TVDB_UL_1 /> 
        <div class="input-group" data-validate="number">
        <input type="text" class="form-control" value="<tag:tvdb_id />" name="tvdb_number" size="10" maxlength="10" id="validate-number" required>
        <span class="input-group-addon danger"><span class="fa fa-times"></span></span>
        </div>
        <tag:language.TVDB_UL_2 />
        </td>
      </tr>
      </if:tvdb_enabled>

      <if:imdb_enabled>
      <tr>
        <td align="right" class="header">IMDB</td>
        <td class="lista" align="left">
        <div class="input-group" data-validate="number">
        <input type="text" class="form-control" value="<tag:torrent.imdb />" name="imdb" size="10" maxlength="10" id="validate-number" required>
        <span class="input-group-addon danger"><span class="fa fa-times"></span></span>
        </div>&nbsp;The numbers after the <font color="red">tt</font> ,for EXAMPLE Tron Legacy http://www.imdb.com/title/tt<font color="red">1104001</font><tag:language.IMDB__EDIT_FORM /></td>
      </tr>
      </if:imdb_enabled>

      <tr>
        <td align="right" class="header"><tag:language.INFO_HASH /></td>
        <td class="lista"><p class="text-danger"><tag:torrent.info_hash /></p></td>
      </tr>


      <if:imageup_enabled>
      <if:imageon>
      <tr>
      <td class="header" ><tag:language.IMAGE /> (<tag:language.FACOLTATIVE />):<input type="hidden" name="userfileold" value="<tag:torrent.image />" /></td>
      <td class="lista" align="left"><input type="file" class="btn btn-primary btn-anchor" name="userfile" size="15" /></td>
      </tr>
      </if:imageon>
      </if:imageup_enabled>
      <tr>
        <td align="right" class="header"><tag:language.DESCRIPTION /></td>
        <td class="lista"><tag:torrent.description /></td>
      </tr>

      <tr>
        <td align="right" class="header"><tag:language.ANONYMOUS /></td>
        <td class="lista"><input type="radio" name="anonymous" value="true" <if:anon>checked</if:anon>><tag:language.YES />&nbsp;&nbsp;<input type="radio" name="anonymous" value="false" <if:anon1>checked</if:anon1>><tag:language.NO /></td>
      </tr>

     <if:imageup_enabled2>
      <if:screenon>
      <tr>
      <td class="header" ><tag:language.SCREEN /> (<tag:language.FACOLTATIVE />):<input type="hidden" name="userfileold1" value="<tag:torrent.screen1 />" /></td>
      <td class="lista">
      <table class="lista" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td class="lista" align="left"><input type="file" name="screen1" size="5" /></td>
      <td class="lista" align="left"><input type="file" name="screen2" size="5" /></td>
      <td class="lista" align="left"><input type="file" name="screen3" size="5" /></td>
      </tr>
      </table>
      </td>
      </tr>
      </if:screenon>
      </if:imageup_enabled2>

      <tr>
        <td class="header" align="right"><tag:language.CATEGORY_FULL /></td>
        <td class="lista"><tag:torrent.cat_combo /></td>
      </tr>

<tr>
      <td class="header" ><tag:language.RG /></td>
      <td class="lista" align="left">
      <div class="input-group">
      <select class="form-control" name="release_group" id="validate-optional">
										<option value="" <tag:torrent.nogroup />---</option>
										<option value="1" <tag:torrent.blurg /><tag:language.BluRG /></option>
										<option value="2" <tag:torrent.simple /><tag:language.SiMPLE /></option>
                    <option value="3" <tag:torrent.legion /><tag:language.Legion /></option>
                    <option value="4" <tag:torrent.united /><tag:language.United /></option>
        </select>
        <span class="input-group-addon info"><span class="fa fa-asterisk"></span></span>
        </div>
      </td>
    </tr>

    <if:torlang>
    <tr>
      <td class="header" ><tag:language.LANGUAGE /></td>
      <td class="lista" align="left"><div class="input-group">
        <select class="form-control" name="language" id="validate-select" placeholder="Validate Select" required>
										<option value="0" <tag:torrent.nolang />---</option>
										<option value="1" <tag:torrent.english /><tag:language.LANG_ENG /></option>
										<option value="2" <tag:torrent.french /><tag:language.LANG_FRE /></option>
										<option value="3" <tag:torrent.dutch /><tag:language.LANG_DUT /></option>
										<option value="4" <tag:torrent.german /><tag:language.LANG_GER /></option>
										<option value="5" <tag:torrent.spanish /><tag:language.LANG_SPA /></option>
										<option value="6" <tag:torrent.italian /><tag:language.LANG_ITA /></option>
                    <option value="7" <tag:torrent.Finnish /><tag:language.LANG_FIN /></option>
										<option value="8" <tag:torrent.Greek /><tag:language.LANG_GRE /></option>
										<option value="9" <tag:torrent.Icelandic /><tag:language.LANG_ICE /></option>
										<option value="10" <tag:torrent.Japanese /><tag:language.LANG_JAP /></option>
										<option value="11" <tag:language.Korean /><tag:language.LANG_KOR /></option>
                    <option value="12" <tag:language.Latin /><tag:language.LANG_LAT /></option>
										<option value="13" <tag:language.Norwegian /><tag:language.LANG_NOR /></option>
										<option value="14" <tag:language.Phillipino/><tag:language.LANG_PHI /></option>
										<option value="15" <tag:language.Polish /><tag:language.LANG_POL /></option>
										<option value="16" <tag:language.Portuguese /><tag:language.LANG_POR /></option>
										<option value="17" <tag:language.Slovenian /><tag:language.LANG_SLO /></option>
                    <option value="18" <tag:language.Russian /><tag:language.LANG_RUS /></option>
										<option value="19" <tag:language.Castillian /><tag:language.LANG_CAS /></option>
										<option value="20" <tag:language.Swedish /><tag:language.LANG_SWE /></option>
										<option value="21" <tag:language.Turkish /><tag:language.LANG_TUR /></option>
										<option value="22" <tag:language.Danish /><tag:language.LANG_DAN /></option>
										<option value="23" <tag:language.Czech /><tag:language.LANG_CZE /></option>
                    <option value="24" <tag:language.Chinese /><tag:language.LANG_CHI /></option>
                    <option value="25" <tag:language.Bulgarian /><tag:language.LANG_BUL /></option>
										<option value="26" <tag:language.Arabic /><tag:language.LANG_ARA /></option>
                    <option value="27" <tag:language.Vietnamese /><tag:language.LANG_VIE /></option>
           </select>
          <span class="input-group-addon danger"><span class="fa fa-times"></span></span>
        </div>
      </td>
    </tr>
    </if:torlang>

      <if:teams_enabled>
      <tag:torrent.teams_combo />
      </if:teams_enabled>

      <if:nar_enabled>
      <tr>
        <td class="header"><tag:language.TNR_REQUESTED /></td>
        <td class="lista"><tag:torrent.req /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.TNR_NUKED /></td>
        <td class="lista"><tag:torrent.nuk /></td>
      </tr>
      </if:nar_enabled>

      <if:sticky_enabled>
      <if:LEVEL_OK>
      <tr>
        <td align="right" class="header"><tag:language.STICKY /></td>
        <td class="lista"><tag:torrent.sticky /></td>
      </tr>
      </if:LEVEL_OK>
      </if:sticky_enabled>

      <tr>
        <td align=right class="header"><tag:language.SIZE /></td>
        <td class="lista" ><tag:torrent.size /></td>
      </tr>
      <tr>
        <td align=right class="header"><tag:language.ADDED /></td>
        <td class="lista" ><tag:torrent.date /></td>
      </tr>
      <tr>
        <td align=right class="header"><tag:language.DOWNLOADED /></td>
        <td class="lista" ><tag:torrent.complete /></td>
      </tr>
      <tr>
        <td align=right class="header"><tag:language.PEERS /></td>
        <td class="lista" ><tag:torrent.peers /></td>
      </tr>

    <if:gast_enabled>
    <if:edit_gold_level>
      <tr>
        <td align="right" class="header"><tag:language.GOLD_TYPE /></td>
        <td class="lista"><tag:torrent.gold /></td>
      </tr>
    </if:edit_gold_level>
    </if:gast_enabled>

    <if:mult_enabled>
      <tr>
        <td align='right' class='header'><tag:language.UPM_UPL_MULT /></td>
        <td align='left' class='lista' colspan='2'>
        <div class='input-group'>
        <select class='form-control' name='multiplier' id='validate-optional'><tag:multie3 /></select>
        <span class='input-group-addon info'><span class='fa fa-asterisk'></span></span>
        </div>
        </td>
      </tr>
    </if:mult_enabled>

</table>
    <input type="hidden" name="info_hash" value="<tag:torrent.info_hash />" />

    <if:tmod3_enabled>
    <input type="hidden" name="ex_moder" value="<tag:torrent.ex_moder />" />
    </if:tmod3_enabled>

    <table>
      <td align="right">
            <input type="submit" class="btn btn-primary" value="<tag:language.FRM_CONFIRM />" name="action" />
      </td>

      <if:tmod4_enabled>
      <td align="left">
            <input type="submit" class="btn btn-warning" value="<tag:language.FRM_CONFIRM_VALIDATE />" name="action" />
      </td>
      </if:tmod4_enabled>

      <td align="left">
            <input type="submit" class=" btn btn-danger" value="<tag:language.FRM_CANCEL />" name="action" />
      </td>
    </table>
  </form>

   <if:nfo_enabled3>
   <!-- ##############################################################
        # Nfo hack -->

    <script type="text/javascript">
      function ShowHide(id,id1) {
          obj = document.getElementsByTagName("div");
          if (obj[id].style.display == 'block'){
          obj[id].style.display = 'none';
          obj[id1].style.display = 'block';
          }
          else {
          obj[id].style.display = 'block';
          obj[id1].style.display = 'none';
          }
      }
      function windowunder(link) {
        window.opener.document.location=link;
        window.close();
      }
    </script>

   <!-- # End
        ########################################################## -->
   </if:nfo_enabled3>
</div>
<div class="panel-footer">
</div>
</div>
