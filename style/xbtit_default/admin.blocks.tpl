<form name="blocks" action="<tag:frm_action />" method="post">
<if:edit_block>
  <table class="lista" border="1">
  <tr>
    <td class="header"><tag:language.BLOCK_NAME /></td>
    <td class="lista"><tag:combo_blocks_name /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BLOCK_POSITION /></td>
    <td class="lista"><tag:combo_position /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BLOCK_TITLE /></td>
    <td class="lista"><input type="text" name="block_title" value="<tag:block_title />" size="40" maxlength="40" /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BLOCK_USE_CACHE /></td>
    <td class="lista"><input type="checkbox" name="use_cache" <tag:block_cache />/></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BLOCK_MINCLASSVIEW /></td>
    <td class="lista"><tag:combo_min_view /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BLOCK_MAXCLASSVIEW /></td>
    <td class="lista"><tag:combo_max_view /></td>
  </tr>
  </table>
<else:edit_block>
  <table class="lista" width="100%" border="1">
    <tr>
      <td colspan="3" valign="top"><a href="<tag:add_new_block />"><tag:language.BLOCK_ADD_NEW /></a></td>
    </tr>
    <if:top_blocks>
    <tr>
      <td colspan="3" valign="top">
      <loop:tops>
        <table align="center" class="lista" width="100%">
          <tr>
            <td class="block" valign="top" align="center"><tag:tops[].title /></td>
          </tr>
          <tr>
            <td>
              &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:tops[].check />
              &nbsp;<tag:tops[].combo />
              &nbsp;<tag:tops[].pos />
              &nbsp;Min.<tag:tops[].combo_min_view />
              &nbsp;Max.<tag:tops[].combo_max_view />
            </td>
          </tr>
        </table>
        <br />
      </loop:tops>
      </td>
    </tr>
    </if:top_blocks>
    <!--<tr>
      <td width="30%" valign="top">-->
    <if:dropdown_blocks>
    <tr>
      <td colspan="3" valign="top">
      <loop:dropdown>
        <table align="center" class="lista" width="100%">
          <tr>
            <td class="block" valign="top" align="center">Drop Down Menu &nbsp;&nbsp;&nbsp;-<tag:dropdown[].title /></td>
          </tr>
          <tr>
            <td>
              &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:dropdown[].check />
              &nbsp;<tag:dropdown[].combo />
              &nbsp;<tag:dropdown[].pos />
              &nbsp;Min.<tag:dropdown[].combo_min_view />
              &nbsp;Max.<tag:dropdown[].combo_max_view />
            </td>
          </tr>
        </table>
        <br />
      </loop:dropdown>
      </td>
    </tr>
    </if:dropdown_blocks>
    <!--<tr>
      <td width="30%" valign="top">-->
	<if:extra_blocks>
    <tr>
      <td colspan="3" valign="top">
      <loop:extras>
        <table align="center" class="lista" width="100%">
          <tr>
            <td class="block" valign="top" align="center">Classic Main Menu &nbsp;&nbsp;&nbsp;-<tag:extras[].title /></td>
          </tr>
          <tr>
            <td>
              &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:extras[].check />
              &nbsp;<tag:extras[].combo />
              &nbsp;<tag:extras[].pos />
              &nbsp;Min.<tag:extras[].combo_min_view />
              &nbsp;Max.<tag:extras[].combo_max_view />
            </td>
          </tr>
        </table>
        <br />
      </loop:extras>
      </td>
    </tr>
    </if:extra_blocks>
		    <!--<tr>
      <td width="30%" valign="top">-->
	<if:altlogin_blocks>
    <tr>
      <td colspan="3" valign="top">
      <loop:altlogin>
        <table align="center" class="lista" width="100%">
          <tr>
            <td class="block" valign="top" align="center">Alternet Login &nbsp;&nbsp;&nbsp;-<tag:altlogin[].title /></td>
          </tr>
          <tr>
            <td>
              &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:altlogin[].check />
              &nbsp;<tag:altlogin[].combo />
              &nbsp;<tag:altlogin[].pos />
              &nbsp;Min.<tag:altlogin[].combo_min_view />
              &nbsp;Max.<tag:altlogin[].combo_max_view />
            </td>
          </tr>
        </table>
        <br />
      </loop:altlogin>
      </td>
    </tr>
    </if:altlogin_blocks>
    <!-- <tr>
      <td width="30%" valign="top">-->
	<if:adarea_blocks>
    <tr>
      <td colspan="3" valign="top">
      <loop:adarea>
        <table align="center" class="lista" width="100%">
          <tr>
            <td class="block" valign="top" align="center">LED Ticker &nbsp;&nbsp;&nbsp;-<tag:adarea[].title /></td>
          </tr>
          <tr>
            <td>
              &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:adarea[].check />
              &nbsp;<tag:adarea[].combo />
              &nbsp;<tag:adarea[].pos />
              &nbsp;Min.<tag:adarea[].combo_min_view />
              &nbsp;Max.<tag:adarea[].combo_max_view />
            </td>
          </tr>
        </table>
        <br />
      </loop:adarea>
      </td>
    </tr>
    </if:adarea_blocks>
    <tr>
      <td width="30%" valign="top">
      <if:left_blocks>
        <loop:lefts>
          <table align="center" class="lista" width="100%">
            <tr>
              <td class="block" valign="top" align="center"><tag:lefts[].title /></td>
            </tr>
            <tr>
              <td>
                &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:lefts[].check />
                &nbsp;<tag:lefts[].combo />
                &nbsp;<tag:lefts[].pos />
                <br />
                Min.<tag:lefts[].combo_min_view />
                &nbsp;Max.<tag:lefts[].combo_max_view />
              </td>
            </tr>
          </table>
          <br />
        </loop:lefts>
      </if:left_blocks>
      </td>
      <td width="30%" valign="top">
      <if:center_blocks>
        <loop:centers>
          <table align="center" class="lista" width="100%">
            <tr>
              <td class="block" valign="top" align="center"><tag:centers[].title /></td>
            </tr>
            <tr>
              <td>
                &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:centers[].check />
                &nbsp;<tag:centers[].combo />
                &nbsp;<tag:centers[].pos />
                <br />
                Min.<tag:centers[].combo_min_view />
                &nbsp;Max.<tag:centers[].combo_max_view />
              </td>
            </tr>
          </table>
          <br />
        </loop:centers>
      </if:center_blocks>
      </td>
      <td width="30%" valign="top">
      <if:right_blocks>
        <loop:rights>
          <table align="center" class="lista" width="100%">
            <tr>
              <td class="block" valign="top" align="center"><tag:rights[].title /></td>
            </tr>
            <tr>
              <td>
                &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:rights[].check />
                &nbsp;<tag:rights[].combo />
                &nbsp;<tag:rights[].pos />
                <br />
                Min.<tag:rights[].combo_min_view />
                &nbsp;Max.<tag:rights[].combo_max_view />
              </td>
            </tr>
          </table>
          <br />
        </loop:rights>
      </if:right_blocks>
      </td>
    </tr>
    <if:bottom_blocks>
    <tr>
      <td colspan="3" valign="top">
      <loop:bottoms>
        <table align="center" class="lista" width="100%">
          <tr>
            <td class="block" valign="top" align="center"><tag:bottoms[].title /></td>
          </tr>
          <tr>
            <td>
              &nbsp;&nbsp;<tag:language.ENABLED />&nbsp;&nbsp;<tag:bottoms[].check />
              &nbsp;<tag:bottoms[].combo />
              &nbsp;<tag:bottoms[].pos />
              &nbsp;Min.<tag:bottoms[].combo_min_view />
              &nbsp;Max.<tag:bottoms[].combo_max_view />
            </td>
          </tr>
        </table>
        <br />
      </loop:bottoms>
      </td>
    </tr>
    </if:bottom_blocks>
  </table>
</if:edit_block>
<br />
<div align="center">
  <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />
  &nbsp;&nbsp;
  <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
</div>
</form>
<br />

