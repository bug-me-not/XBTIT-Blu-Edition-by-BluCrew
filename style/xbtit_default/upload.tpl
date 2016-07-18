<script type="text/javascript">
  function showTorrents(file) {
    if (file == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
      }
    }

    var file = document.getElementById('torrent').value;
    xmlhttp.open("GET", "upcheck.php?q=" + file, true);
    xmlhttp.send();
  }

  function checkExtension() {
    // for mac/linux, else assume windows
    if (navigator.appVersion.indexOf('Mac') != -1 || navigator.appVersion.indexOf('Linux') != -1)
      var fileSplit = '/';
    else
      var fileSplit = '\\';

    var fileType = '.torrent';
    var fileName = document.getElementById('torrent').value; // current value
    var extension = fileName.substr(fileName.lastIndexOf('.'), fileName.length);

    if (extension != fileType) {
      alert('<tag:language.ERR_PARSER />');
      return false;
    }

    return true;
  }

  //Source: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt
  function filterInt(value) {
    if (/^(\-|\+)?([0-9]+)$/.test(value))
      return true;
    return false;
  }

  function CheckForm() {
    // file extension
    if (checkExtension() == false)
      return false;

    var name = document.getElementsByName('filename')[0];
    //File Name
    if (name.value.length == 0) {
      alert('<tag:language.WRITE_FILE_NAME />');
      name.focus();
      return false;
    }

    var cat = document.getElementsByName('category')[0];
    // categories
    if (cat.value == '0') {
      alert('<tag:language.WRITE_CATEGORY />');
      cat.focus();
      return false;
    }

    var desc = document.getElementsByName('info')[0];
    // description
    if (desc.value.length == 0) {
      alert('<tag:language.EMPTY_DESCRIPTION />');
      desc.focus();
      return false;
    }

    var imdb = document.getElementsByName('imdb')[0];
    //IMDB
    if (!filterInt(imdb.value)) {
      alert("Please fill IMDB. Otherwise enter 0 if not available.");
      imdb.focus();
      return false;
    }

    var tvdb = document.getElementsByName('tvdb_number')[0];
    //TVDB
    if (!filterInt(tvdb.value)) {
      alert("Please fill TVDB ID. Otherwise enter 0 if not available.");
      tvdb.focus();
      return false;
    }
    // all filled...
    return true;
  }

  function showimages(str) {
    if (str.length == 0) {
      document.getElementById("imagesearch").innerHTML = "";
      document.getElementById("imagesearch").style.border = "0px";
      return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("imagesearch").innerHTML = xmlhttp.responseText;
        document.getElementById("imagesearch").style.border = "1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET", "googly/scan.php?searchtag=" + str, true);
    xmlhttp.send();
  }
  var $w = jQuery.noConflict();
  $w(document).ready(function() {

    //select all the a tag with name equal to modal
    $w('a[name=modal]').click(function(e) {
      //Cancel the link behavior
      e.preventDefault();

      //Get the A tag
      var id = $w(this).attr('href');

      //Get the screen height and width
      var maskHeight = $w(document).height();
      var maskWidth = $w(window).width();

      //Set heigth and width to mask to fill up the whole screen
      $w('#mask').css({
        'width': maskWidth,
        'height': maskHeight
      });

      //transition effect
      $w('#mask').fadeIn(1000);
      $w('#mask').fadeTo("slow", 0.8);

      //Get the window height and width
      var winH = $w(window).height();
      var winW = $w(window).width();

      //Set the popup window to center
      $w(id).css('top', winH / 2 - $w(id).height() / 2);
      $w(id).css('left', winW / 2 - $w(id).width() / 2);

      var collect = document.forms.upload.info.value;
      $w(id).load("preview.php", {
        dataType: "text",
        type: "POST",
        data: collect,
        success: function(data) {
          var test = collect;
          if (test == '') {
            alert('No Data!');
            window.setTimeout('location.reload()', 0);
          }
        },

      }).fadeIn(2000);

    });

    //if escape key is pressed
    $w('body').keydown(function(e) {
      if (e.keyCode == 27) {
        e.preventDefault();
        $w('#mask').hide();
        $w('.window').hide();
      }
    });


    //if close button is clicked
    $w('.window .close').click(function(e) {
      //Cancel the link behavior
      e.preventDefault();

      $w('#mask').hide();
      $w('.window').hide();
    });

    //if mask is clicked
    $w('#mask').click(function() {
      $w(this).hide();
      $w('.window').hide();
    });

    $w(window).resize(function() {

      var box = $w('#boxes .window');

      //Get the screen height and width
      var maskHeight = $w(document).height();
      var maskWidth = $w(window).width();

      //Set height and width to mask to fill up the whole screen
      $w('#mask').css({
        'width': maskWidth,
        'height': maskHeight
      });

      //Get the window height and width
      var winH = $w(window).height();
      var winW = $w(window).width();

      //Set the popup window to center
      box.css('top', winH / 2 - box.height() / 2);
      box.css('left', winW / 2 - box.width() / 2);

    });
  });
</script>


<div style="background: #075ca0;border: none;width:auto;height:45px; border:solid 1px #101010; border-radius:3px;color: #fff;text-align: center;line-height:45px;font-size: 15px;margin-bottom: 3px;">Please Ensure That You Fill In All The Fields Below </div>
<div style="background: #249D57;border: none;width:auto;height:40px;border:solid 1px #249D57;border-radius:3px;color: #fff;text-align: center;line-height:20px;font-size: 12px;margin-bottom: 3px;">
  <center><font size="3">Tracker Announce URL:</font>
    <br>
    <tag:tracker_url />
  </center>
</div>
<div style="background: #E54C4D;border: none;width:auto;height:25px;border:solid 1px #E54C4D;border-radius:3px;color: #fff;text-align: center;line-height:20px;font-size: 15px;margin-bottom: 3px;">Before Uploading Please Make Sure You Have Read Our Uploading Rules</div>
<form name="upload" method="post" onsubmit="return CheckForm();" action="index.php?page=upload" enctype="multipart/form-data">
  <input type="hidden" name="user_id" size="50" value="" />
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"></h3>
    </div>
    <div class="panel-body">
      <if:auto_announce_enabled>
        <center>
          <p class="text-warning">
            <tag:language.AUTO_ANNOUNCE />
            <tag:language.AUTO_ANNOUNCE2 />
        </center>
        </p>
      </if:auto_announce_enabled>

      <table class="table table-bordered">

        <!-- TORRENT START -->
        <tr>
          <td class="header">
            <tag:language.TORRENT_FILE />
          </td>
          <if:upcheck_enabled>
            <td class="lista" align="left">
              <input type="file" class="btn btn-primary btn-anchor" id="torrent" name="torrent" onchange='CopyName()' onchange="showTorrents();" />
              <div align=center id="txtHint"></div>
            </td>
            <else:upcheck_enabled>
              <td class="lista" align="left">
                <input type="file" class="btn btn-primary btn-anchor" id="torrent" name="torrent" onchange='CopyName()' />
              </td>
          </if:upcheck_enabled>
        </tr>
        <!-- TORRENT END -->

        <!-- FILENAME START -->
        <tr>
          <td class="header">
            <tag:language.FILE_NAME />
          </td>
          <td class="lista" align="left">
            <input type="text" id="filename" name="filename" size="50" maxlength="200" class="form-control" />
          </td>
          <if:arc_enabled>
            <if:arc_both>
              <tr>
                <td class="header">
                  <tag:language.ARC_UPLOAD_TYPE />
                </td>
                <td class="lista" align="left">
                  <tag:language.ARC_NEW />&nbsp;
                  <input type="radio" class="btn btn-primary btn-anchor" name="arc_upload_type" value="1" checked="checked" />&nbsp;&nbsp;&nbsp;&nbsp;
                  <tag:language.ARC_ARC />&nbsp;
                  <input type="radio" name="arc_upload_type" value="2" />
                </td>
              </tr>
              <else:arc_both>
                <if:arc_only_new>
                  <input type="hidden" name="arc_upload_type" value="1" />
                  <else:arc_only_new>
                    <if:arc_only_arc>
                      <input type="hidden" name="arc_upload_type" value="2" />
                    </if:arc_only_arc>
                </if:arc_only_new>
            </if:arc_both>
          </if:arc_enabled>
          <!-- FILENAME END -->

          <!-- NFO START -->
          <if:nfo_enabled>
            <tr>
              <td class="header">
                <tag:language.NFO_NFO />
              </td>
              <td class="lista" align="left">
                <input type="file" class="btn btn-primary btn-anchor" name="nfo" />
              </td>
            </tr>
          </if:nfo_enabled>
          <!-- NFO END -->

          <!-- CATEGORY START -->
          <tr>
            <td class="header">
              <tag:language.CATEGORY_FULL />
            </td>
            <td class="lista" align="left">
              <select class="form-control" <tag:upload_categories_combo /></select>
            </td>
          </tr>
          <!-- CATEGORY END -->

          <!-- RG START -->
          <tr>
            <td class="header">
              <tag:language.RG />
            </td>
            <td class="lista" align="left">
              <select class="form-control" name="release_group">
                <option value="0">---</option>
                <option value="1">
                  <tag:language.BluRG />
                </option>
                <option value="2">
                  <tag:language.SiMPLE />
                </option>
                <option value="3">
                  <tag:language.Legion />
                </option>
                <option value="4">
                  <tag:language.Unit3d />
                </option>
              </select>
            </td>
          </tr>
          <!-- RG END -->

          <!-- LANGUAGE START -->
          <if:torlang>
            <tr>
              <td class="header">
                <tag:language.LANGUAGE />
              </td>
              <td class="lista" align="left">
                <select class="form-control" name="language">
                  <option value="0">---</option>
                  <option value="1">
                    <tag:language.LANG_ENG />
                  </option>
                  <option value="2">
                    <tag:language.LANG_FRE />
                  </option>
                  <option value="3">
                    <tag:language.LANG_DUT />
                  </option>
                  <option value="4">
                    <tag:language.LANG_GER />
                  </option>
                  <option value="5">
                    <tag:language.LANG_SPA />
                  </option>
                  <option value="6">
                    <tag:language.LANG_ITA />
                  </option>
                  <option value="7">
                    <tag:language.LANG_FIN />
                  </option>
                  <option value="8">
                    <tag:language.LANG_GRE />
                  </option>
                  <option value="9">
                    <tag:language.LANG_ICE />
                  </option>
                  <option value="10">
                    <tag:language.LANG_JAP />
                  </option>
                  <option value="11">
                    <tag:language.LANG_KOR />
                  </option>
                  <option value="12">
                    <tag:language.LANG_LAT />
                  </option>
                  <option value="13">
                    <tag:language.LANG_NOR />
                  </option>
                  <option value="14">
                    <tag:language.LANG_PHI />
                  </option>
                  <option value="15">
                    <tag:language.LANG_POL />
                  </option>
                  <option value="16">
                    <tag:language.LANG_POR />
                  </option>
                  <option value="17">
                    <tag:language.LANG_SLO />
                  </option>
                  <option value="18">
                    <tag:language.LANG_RUS />
                  </option>
                  <option value="19">
                    <tag:language.LANG_CAS />
                  </option>
                  <option value="20">
                    <tag:language.LANG_SWE />
                  </option>
                  <option value="21">
                    <tag:language.LANG_TUR />
                  </option>
                  <option value="22">
                    <tag:language.LANG_DAN />
                  </option>
                  <option value="23">
                    <tag:language.LANG_CZE />
                  </option>
                  <option value="24">
                    <tag:language.LANG_CHI />
                  </option>
                  <option value="25">
                    <tag:language.LANG_BUL />
                  </option>
                  <option value="26">
                    <tag:language.LANG_ARA />
                  </option>
                  <option value="27">
                    <tag:language.LANG_VIE />
                  </option>
                </select>
              </td>
            </tr>
          </if:torlang>
          <!-- LANGUAGE END -->

          <!-- TEAMS START -->
          <if:teams_enabled>
            <tag:upload_teams_combo />
          </if:teams_enabled>
          <!-- TEAMS END -->

          <!-- FREELEECH START -->
          <if:gast_enabled>
            <if:upload_gold_level>
              <tr>
                <td class="header">
                  <tag:language.GOLD_TYPE />
                </td>
                <td class="lista" align="left">
                  <select class="form-control" <tag:upload_gold_combo /></select>
                </td>
              </tr>
            </if:upload_gold_level>
          </if:gast_enabled>
          <!-- FREELEECH END -->

          <!-- UPLOAD MULTIPLIER START -->
          <if:mult_enabled>
            <tr>
              <td align='left' class='header'>
                <tag:language.UPM_UPL_MULT />
              </td>
              <td align='left' class='lista' colspan='2'>
                <select class="form-control" name='multiplier'>
                  <tag:multie3 />
                </select>
              </td>
            </tr>
          </if:mult_enabled>
          <!-- UPLOAD MULTIPLIER END -->

          <!-- MODER START -->
          <if:tmod_enabled>
            <tr>
              <input type="hidden" name="moder" value="<tag:moder />" />
            </tr>
          </if:tmod_enabled>
          <!-- MODER END -->

          <!-- DIRECT LINK START-->
          <if:ddl_enabled>
            <tr>
              <td class="header">
                <tag:language.DIRECT_LINK />
              </td>
              <td class="lista">
                <input type="text" name="direct_link" value="" size="50" maxlength="255">
              </td>
            </tr>
          </if:ddl_enabled>
          <!-- DIRECT LINK END -->

          <!-- STAFF COMMENTS START -->
          <if:st_comm_enabled>
            <if:LEVEL_SC>
              <tr>
                <td class="header">
                  <tag:language.STAFF_COMMENT />
                </td>
                <td class="lista" align="left">
                  <textarea name="staff_comment" rows="3" cols="45" class="form-control"></textarea>
                </td>
              </tr>
            </if:LEVEL_SC>
          </if:st_comm_enabled>
          <!-- STAFF COMMENTS END -->

          <!-- TVDB START -->
          <if:tvdb_enabled>
            <tr>
              <td class="header">
                <tag:language.TVDB_UL_TITLE />
              </td>
              <td class="lista" align="left">
                <tag:language.TVDB_UL_1 />
                <input type="text" name="tvdb_number" value="0" size="10" maxlength="10" class="form-control" />
                <tag:language.TVDB_UL_2 />
              </td>
            </tr>
          </if:tvdb_enabled>
          <!-- TVDB END -->

          <!-- IMDB START -->
          <if:imdb_enabled>
            <tr>
              <td class="header">IMDB</td>
              <td class="lista" align="left"><b>tt<b><input type='text' name='imdb' value='0' size='10' maxlength='10' class="form-control" />&nbsp;The numbers after the <font color="red">tt</font> ,for EXAMPLE Tron Legacy (http://www.imdb.com/title/tt<font color="red">1104001</font>) <tag:language.IMDB__EDIT_FORM /></td>
            </tr>
          </if:imdb_enabled>
          <!-- IMDB END -->

          <!-- IMAGE UPLOAD START -->
          <if:imageup_enabled>
          <if:imageon>
            <tr>
              <td class="header" ><tag:language.IMAGE />:</td>
              <td class="lista" align="left"><input type="file" name="userfile" size="2000" class="btn btn-primary btn-anchor" /></td>
            </tr>
          </if:imageon>
          </if:imageup_enabled>
          <!-- IMAGE UPLOAD END -->

          <!-- UPLOAD DESCRIPTION START -->
            <tr>
              <td class="header" valign="top"><tag:language.DESCRIPTION /></td>
              <td class="lista" ><tag:textbbcode /></td>
            </tr>
          <!-- UPLOAD DESCRIPTION END -->

          <!-- SCREENS UPLOAD START -->
          <if:imageup_enabled2>
          <if:screenon>
            <tr>
              <td class="header"><tag:language.SCREEN /> (<tag:language.FACOLTATIVE />):</td>
              <td class="lista">
              <table class="lista" border="0" cellspacing="0" cellpadding="0">
              <td class="lista" align="left"><input type="file" name="screen1" size="5" /></td>
              <td class="lista" align="left"><input type="file" name="screen2" size="5" /></td>
              <td class="lista" align="left"><input type="file" name="screen3" size="5" /></td>
            </table>
            </td>
            </tr>
            </if:screenon>
            </if:imageup_enabled2>
          <!-- SCREENS UPLOAD END -->

          <!-- STICKY TORRENT START -->
          <if:sticky_enabled>
          <if:LEVEL_OK>
            <tr>
              <td class="header" ><tag:language.STICKY_TORRENT /></td>
              <td class="lista" align="left">
              <input type="checkbox" name="sticky"> - <tag:language.STICKY_TORRENT_EXPLAIN /></td>
            </tr>
          </if:LEVEL_OK>
          </if:sticky_enabled>
          <!-- STICKY TORRENT END -->

          <!-- ANON UPLOAD START -->
            <tr>
              <td class="header"><tag:language.TORRENT_ANONYMOUS /></td>
              <td class="lista">&nbsp;&nbsp;<tag:language.YES /><input type="radio" name="anonymous" value="true" />&nbsp;&nbsp;<tag:language.NO /><input type="radio" name="anonymous" value="false" checked="checked" /></td>
            </tr>
          <!-- ANON UPLOAD END -->

          <!-- REQUESTED START -->
          <if:nar_enabled>
            <tr>
              <td class="header"><tag:language.TNR_REQUESTED /></td>
              <td class="lista">&nbsp;&nbsp;<tag:language.YES /><input type="radio" name="req" value="true" />&nbsp;&nbsp;<tag:language.NO /><input type="radio" name="req" value="false" checked="checked" /></td>
            </tr>
          <!-- REQUESTED END -->

          <!-- NUKED START -->
            <tr>
              <td class="header"><tag:language.TNR_NUKED /></td>
              <td class="lista">&nbsp;&nbsp;<tag:language.YES /><input type="radio" name="nuk" value="true" />&nbsp;&nbsp;<tag:language.NO /><input type="radio" name="nuk" value="false" checked="checked" />
              <input type="text" name="nuk_rea" size="43" maxlength="100" class="form-control"></td>
            </tr>
            </if:nar_enabled>
          <!-- NUKED END -->
          </br>  
          </table>

          <!-- BUTTONS START -->
          <table>
            <tr>
              <center><input type="submit" class="btn btn-primary" value="<tag:language.FRM_SEND />" />&nbsp;&nbsp;&nbsp;
              <input type="reset" class="btn btn-danger" value="<tag:language.FRM_RESET />" />&nbsp;&nbsp;&nbsp;<a border="0" href="#dialog" name="modal"><button class="btn btn-success"><tag:language.UP_PREV /></button></a></center>
            </tr>
          </table>
          <!-- BUTTONS END -->
          
          </form>
          </div>
          </div>

