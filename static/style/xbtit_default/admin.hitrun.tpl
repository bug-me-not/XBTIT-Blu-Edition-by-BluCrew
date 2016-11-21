<if:is_edit>
<br />
<form name='hitrun' action='index.php?page=admin&user=<tag:CURUSER.uid />&code=<tag:CURUSER.random />&do=hitrun&job=save&id=<tag:this_id />' method='post'>

  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td class='header'><b><tag:language.RANK /></b></td>
      <td class="lista"><select name='hnr_rank'><tag:select /></select></td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_METHOD /></b></td>
      <td class='lista'>
        <select name='hnr_method'>
          <option value='0'><tag:now.method /></option>
          <option value='1'><tag:language.HNR_TS_ONLY /></option>
          <option value='2'><tag:language.HNR_RATIO_ONLY /></option>
          <option value='3'><tag:language.HNR_TS_OR_RATIO /></option>
          <option value='4'><tag:language.HNR_TS_AND_RATIO /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_MIN_ST /></b></td>
      <td class='lista'><input type='text' name='hnr_seeding_trigger' size='10'  value='<tag:msh />' />
        <select name='hnr_seeding_type'>
          <option value='0'><tag:hord /></option>
          <option value='1'><tag:language.HNR_HOURS /></option>
          <option value='2'><tag:language.HNR_DAYS /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_MIN_RATIO /></b></td>
      <td class='lista'><input type='text' name='hnr_ratio_trigger' size='10' value='<tag:now.min_ratio />' />
      </td>

    <tr>
      <td class='header'><b><tag:language.HNR_TOLERANCE /></b></td>
      <td class='lista'><input type='text' name='hnr_tolerance' size='10'  value='<tag:th />' />
        <select name='hnr_tolerance_type'>
          <option value='0'><tag:tol /></option>
          <option value='1'><tag:language.HNR_HOURS /></option>
          <option value='2'><tag:language.HNR_DAYS /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_DL_TRIGGER /></b></td>
      <td class='lista'><input type='text' name='hnr_download_trigger' size='10' value='<tag:trigamt />' />
        <select name='hnr_dl_tr_type'>
          <option value='0'><tag:trig /></option>
          <option value='1'><tag:language.HNR_BYTES /></option>
          <option value='2'><tag:language.HNR_KB /></option>
          <option value='3'><tag:language.HNR_MB /></option>
          <option value='4'><tag:language.HNR_GB /></option>
          <option value='5'><tag:language.HNR_TB /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_BLSO /></b></td>
      <td class='lista'>
        <select name='hnr_bl'>
          <option value='0' <tag:hl />><tag:language.NO /></option>
          <option value='1' <tag:hl />><tag:language.YES /></option>
        </select>
      <tag:language.HNR_AFTER /> <input type='text' name='hnr_bl_count' size='10' value='<tag:now.block_leech />' /> <tag:language.HNR_WARNINGS />
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_CFP /></b></td>
      <td class='lista'>
        <select name='hnr_fp'>
          <option value='0'<tag:fy />><tag:language.NO /></option>
          <option value='1'<tag:fy />><tag:language.YES /></option>
        </select>
      In <select name='hnr_fp_id'>
        <tag:select2 />
        </select>
      </td>
    </tr>
    <tr>
      <td colspan='2' class='block' align='center'><input type='submit' name='submit' value='Edit' /></td>
    </tr>
  </table>
</form>
<else:is_edit>

<br />
<form name='hitrun' action='index.php?page=admin&user=<tag:CURUSER.uid />&code=<tag:CURUSER.random />&do=hitrun&job=insert' method='post'>

  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td class='header'><b><tag:language.RANK /></b></td>
      <td class="lista"><select name='hnr_rank'><tag:select /></select></td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_METHOD /></b></td>
      <td class='lista'>
        <select name='hnr_method'>
          <option value='0'>----</option>
          <option value='1'><tag:language.HNR_TS_ONLY /></option>
          <option value='2'><tag:language.HNR_RATIO_ONLY /></option>
          <option value='3'><tag:language.HNR_TS_OR_RATIO /></option>
          <option value='4'><tag:language.HNR_TS_AND_RATIO /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_MIN_ST /></b></td>
      <td class='lista'><input type='text' name='hnr_seeding_trigger' size='10'  value='' />
        <select name='hnr_seeding_type'>
          <option value='0'>----</option>
          <option value='1'><tag:language.HNR_HOURS /></option>
          <option value='2'><tag:language.HNR_DAYS /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_MIN_RATIO /></b></td>
      <td class='lista'><input type='text' name='hnr_ratio_trigger' size='10' value='' />
      </td>

    <tr>
      <td class='header'><b><tag:language.HNR_TOLERANCE /></b></td>
      <td class='lista'><input type='text' name='hnr_tolerance' size='10'  value='' />
        <select name='hnr_tolerance_type'>
          <option value='0'>----</option>
          <option value='1'><tag:language.HNR_HOURS /></option>
          <option value='2'><tag:language.HNR_DAYS /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_DL_TRIGGER /></b></td>
      <td class='lista'><input type='text' name='hnr_download_trigger' size='10' value='' />
        <select name='hnr_dl_tr_type'>
          <option value='0'>----</option>
          <option value='1'><tag:language.HNR_BYTES /></option>
          <option value='2'><tag:language.HNR_KB /></option>
          <option value='3'><tag:language.HNR_MB /></option>
          <option value='4'><tag:language.HNR_GB /></option>
          <option value='5'><tag:language.HNR_TB /></option>
        </select>
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_BLSO /></b></td>
      <td class='lista'>
        <select name='hnr_bl'>
          <option value='0'><tag:language.NO /></option>
          <option value='1'><tag:language.YES /></option>
        </select>
      <tag:language.HNR_AFTER /> <input type='text' name='hnr_bl_count' size='10' value='' /> <tag:language.HNR_WARNINGS />
      </td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.HNR_CFP /></b></td>
      <td class='lista'>
        <select name='hnr_fp'>
          <option value='0'><tag:language.NO /></option>
          <option value='1'><tag:language.YES /></option>
        </select>
      In <select name='hnr_fp_id'>
        <tag:select2 />
        </select>
      </td>
    </tr>
    <tr>
      <td colspan='2' class='block' align='center'><input type='submit' name='submit' value='<tag:language.HNR_NEW_GROUP />' /></td>
    </tr>
  </table>
</form>

<if:is_loop>
  <br /><br />
  <table width='100%'>
    <tr>
      <td class='header' align='center'><b><tag:language.RANK /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_METHOD /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_MINSEED /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_MINRAT /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_TOL /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_DLTRIG /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_BLOLEECH /></b></td>
      <td class='header' align='center'><b><tag:language.HNR_FORPOST /></b></td>
      <td class='header' align='center'><b><tag:language.EDIT /></b></td>
      <td class='header' align='center'><b><tag:language.DELETE /></b></td>
    </tr>
    <loop:hnrloop>
      <tr>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].rank /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].method /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].msh /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].mrat /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].tol /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].dltrig /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].block_leech /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].forum_post /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].edit /></td>
        <td class='lista' style='text-align:center;'><tag:hnrloop[].delete /></td>
      </tr>
    </loop:hnrloop>
</table>
</if:is_loop>
</if:is_edit>
