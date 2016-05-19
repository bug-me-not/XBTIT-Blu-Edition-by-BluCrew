<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////


if(!defined("IN_BTIT") || $CURUSER['id']==1)
  redirect("index.php");

/*if($CURUSER['uid']!=23027)
  stderr($language['ERROR'],"Trouble reaching the Rules.");

if ($limit>0)
  $limitqry="LIMIT $limit";
$res=do_sqlquery("SELECT r.text AS text, r.sort_index AS sort_index, r.id AS id ,rg.title AS cat_title, rg.id AS cat_id, rg.sort_index AS g_sort_index
                    FROM {$TABLE_PREFIX}rules r
                    INNER JOIN {$TABLE_PREFIX}rules_group rg on r.cat_id=rg.id
                    WHERE r.active = '1' AND rg.active = '1' GROUP BY r.sort_index ORDER BY rg.sort_index,r.sort_index ASC $limitqry");

// load language file
//require(load_language("lang_viewrules.php"));

$rulestpl = new bTemplate();
$rulestpl -> set("language",$language);


$rules=array();
$i=0;

$rulestpl -> set("rules_exists", (sql_num_rows($res) > 0),TRUE);

$id='';
$j=1;
$k=1;
while ($rows=$res->fetch_array())
  {
      if($id != $rows['cat_id'])
    {
     $rules[$i]["rules_group_title"] = unesc('<br/>'.$rows["cat_title"].'<br/>');
     $rules[$i]["rules_text"] = format_comment(unesc($rows["sort_index"].'. '.$rows["text"]));
     $id = $rows['cat_id'];
     $j++;
    }
    else
    {

        $rules[$i]["rules_text"] = format_comment(unesc($rows["sort_index"].'. '.$rows["text"]));
        $k++;
    }

    /*  if($id != $rows['cat_id'])
    {

        $rules[$i]["rules_group_title"] = unesc($rows["cat_title"]);
        $rules[$i]["rules_text"] = unesc($rows["text"]);
        $rules[$i]["rules_link"] = unesc("index.php?page=rules#".$rows['id']);
        //rules2
        $rules2[$i]["posted_date"] = date("d/m/Y H:i",$rows["date"]-$offset);
        $rules2[$i]["rules_group_title"] = unesc(" <tr>
             <td class='r_header' align='center'>
              <b>".$rows["cat_title"]."</b>
             </td>
           </tr>");
        $rules2[$i]["rules_text"] = unesc($rows["text"]);
        $rules2[$i]["rules_link"] = unesc($rows['id']);
        $id = $rows['cat_id'];
    }
    else
    {
        $rules[$i]["rules_title"] = unesc($rows["title"]);
        $rules[$i]["rules_text"] = format_comment($rows["description"]);
        $rules[$i]["rules_link"] = unesc("index.php?page=rules#".$rows['id']);
        //rules2
        $rules2[$i]["posted_date"] = date("d/m/Y H:i",$rows["news_date"]-$offset);
        $rules2[$i]["rules_title"] = unesc($rows["title"]);
        $rules2[$i]["rules_text"] = format_comment($rows["description"]);
        $rules2[$i]["rules_link"] = unesc($rows['id']);

    }


      $i++;

  }

$rulestpl -> set("rules", $rules);
$rulestpl -> set("rules2", $rules2);*/

ob_start();
  $text = "<div class='r_fs'><h1><span class='r_highlight'>Blu Rules</span></h1></div>

  <div class='r_wrapper'>

    <div class='r_table'>
      <div class='r_header'>
        <div class='r_cell'>
          General Rules
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          1) Do not defy the expressed wishes of Staff!</br></br>
          2) Possession of multiple BTNET (blu-torrents.net) accounts will result in a ban!</br></br>
          3) All Blu-Torrents BluRG Internal releases uploaded to other sites MUST have the full title, description and TAG left in tact! Also all BluRG uploads will be exclusive to Blu-Torrents for 1 day / 24 hours before it can be uploaded to another Private Tracker. (Failure to follow this rule will result in a BAN) (Please don't upload our Internals to Public Trackers!!!!).</br></br>
          4) Disruptive behaviour in the forums may result in a warning.</br></br>
          5) Asking for/Trading of invites is not allowed anywhere on the site, and will get you permanently banned.</br>
        </div>
      </div>
    </div>

    <div class='r_table'>
      <div class='r_header'>
        <div class='r_cell'>
          Downloading Rules
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          1) You can always download FREE torrents to improve your Share Ratio.</br></br>

          2) HnR is not allowed. The site has a detection system in place to auto warn and/or ban members.</br></br>

          3) All torrents downloaded must be seeded for a minimum of seven days.</br></br>

          4) Keep your ratio high, If your ratio falls below 0.50 you will get a strike after 3 your account will be disabled. Any one having trouble maintaining a good ratio ( that seeds to seeding requirements )  please contact admin as they can assist.</br></br>

          5) Low ratio strikes will be removed after your ratio has remained above 0.50 for a period of 30 days.</br>
        </div>
      </div>
    </div>

    <div class='r_table'>
      <div class='r_header'>
        <div class='r_cell'>
          Uploading Rules
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          1) UPLOADING VIDEO GUIDE HERE: https://www.youtube.com/watch?v=XCDb9D5Y3q8</br></br>

          2) Allowed content:</br>
          Untouched Blurays</br>
          Customs Blurays</br>
          BD25 ReEncodes</br>
          RemuXs</br>
          1080p/720p Encodes</br>
          1080p/720p Web-DL’s</br>
          FanRes Projects</br></br>

          3) Video-</br>
          Resolutions: HD Only</br>
          Codecs: x264, x265, AVC, MVC, VC-1, Apple ProRes, GoPro Cineform, MPEG-2</br>
          Containers: MKV, MK3D, M2TS, TS, MP4, M4V, MOV, .264, MPV</br></br>

          4) Audio-</br>
          Codecs: ATMOS, TrueHD, DTS-HDMA, LPCM, PCM, DTS-HDHR, Dolby Digital Plus, DTS, Dolby Digital, AC-3, AAC, FLAC, ALAC, MKA, M4A</br></br>

          5) Untouched Blurays/Custom Blurays and BD25 ReEncodes can be upped in BDMV Folder Format and or a ISO Image.</br></br>


          6) Upload Descriptions: </br>
          Proper Info Description-
          For Blurays Please Use A Proper BDInfo Scan: </br>
          For everything else (Encodes, Web-DL, Ect.) Please use a proper MediaInfo Scan:</br></br>

          7) SceenShots:</br>
          All uploads excluding Untouched Blurays and Remuxs must contain atleast 3 Screenshots in PNG or TIFF format. Upload screens to a img host such as imgur and use the proper BB Image Code.</br></br>

          8) Torrent title naming convention: (Titles Must Be ENGLISH)</br>
          Proper Examples:</br>

          The Vampire Lovers 1970 BD50 1080p AVC DTS HDMA 2 0 HDVinnie@BluRG</br>
          Mad Max Fury Road 2015 BD25 ReEncode 1080p AVC TrueHD 7 1 j0k3rHD@BluRG  </br>
          Cop Car 2015 1080p WEB DL x264 AC3 NiKON  </br>
          Mad Max: Fury Road 2015 1080p Blu ray ReMuX AVC DTS HD MA 7 1 HiDeFZeN@BluRG  </br>
          Safe House 2012 1080p BluRay DTS HD MA 5 1 x264 SiMPLE  </br>
          101 Dalmations Diamond Edition 1961 BluRay 720p x264 AC3 5 1 LimitedHD@BluRG  </br>
          Hunger Games Mockingjay Part 1 2014 1080p TrueHD ATMOS 7 1 x265 HEVC Scotlandman@BluRG  </br></br>

          9) Make sure to remove all unnecessary dots, if present. (except if the dots are part of the name of the movie i.e. S.W.A.T. or they are used for separation in the audio channel information, i.e. DD5.1)
          Only the Latin alphabet should be used for the title. The characters / : < > | must not be used in the file/folder names and the title.</br></br>

          10) DO NOT dump everything that's in the MediaInfo output - be selective and stick with the most important bits. (Must be in English)</br></br>

          11) While we do preffer uploads to contain english audio it is no longer mandatory, but if it does nt contain english audio is MUST contain english subtitles.</br></br>

          12) Do not use the NFO artwork in your description. Limit those artistic expressions to the NFO only.</br></br>

          13) Your torrent upload must be seeded by you until 3 seeders are on the torrent (not including yourself). If this is not possible because something comes up, please notify staff via The HelpDesk.</br></br>

          14) Please use standard tools to get technical information BDInfo For blu-ray discs and MediaInfo For MKV files. </br></br>

          15) Failure to follow the rules above may result in your upload rights being revoked.</br></br>

          16) If you have something interesting that somehow violates these rules, PM the Staff (Via Helpdesk) and we might make an exception.</br></br>

          17) Uploading of RAR Files are strictly prohibited.</br></br>

          18) ONLY UPLOAD WHAT YOU CAN SEED!</br></br>

          19) All uploads posted by Blu Users or below will be stopped for approval before posting to the site. Once your rank is above Blu User this will no longer happen.</br>
        </div>
      </div>
    </div>


    <div class='r_table'>

      <div class='r_header'>
        <div class='r_cell'>
          General Forum Guidelines
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          1) No aggressive behavior or flaming in the forums.  No trashing of other peoples topics (i.e. SPAM).</br></br>
          2) No systematic foul language (and none at all on titles). </br></br>
          3) Please ensure all questions are posted in the correct section!
        </div>
      </div>
    </div>

    <div class='r_table'>
      <div class='r_header'>
        <div class='r_cell'>
          Avatar Guidelines
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          1) The allowed formats are .gif, .jpg and .png. </br></br>
          2) Do not upload images larger than 2000 kb.</br></br>
          3) Do not upload images that are bigger than 300 x 250.</br></br>
          4) Do not use potentially offensive material involving but no limited to porn, religious material, animal / human cruelty or ideologically charged images.</br>
        </div>
      </div>
    </div>

    <div class='r_table'>

      <div class='r_header'>
        <div class='r_cell'>
          H&R (Hit and Run) Rules
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          Superleech - Must seed for minimum of 7 Days</br></br>
          Leecher - Must seed for minimum of 7 Days</br></br>
          Recruit -  Must seed for a minimum of 7 Days</br></br>
          Blu User- Must seed for a minimum of 7 Days </br></br>
          Blu Warrior - Must seed for minimum of 7 Days </br></br>
          Blu Master - Must seed for minimum of 7 Days </br></br>
          Blu Addict -  Must seed for a minimum of 7 Days</br> </br>
          Blu Junkie - Must seed for a minimum of 7 Days </br></br>
          Blu God - You are a God these H&R rules only apply to mere mortals!</br></br>

          Even if a torrent is free leech you must meet the minimum seeding time of 7 days.</br></br>

          You will not be affected with a H&R if you stop an delete a torrent because you didn't fully download it. Due to it being dead or other reasons. The H&R rule engages once you download 1024MB of the file. Once you have 1024MB of the download complete you are then considered a seeder and the rule goes into effect. </br></br>

          You have up to three days at a time to disconnect from seeding without getting punishment. If you are disconnected (not seeding) for over 3 days and you have not met the seeding requirements you will get a warning by the system. Once you accumulate 2 active warnings your download rights will be disabled. If you accumulate 3 active warnings you will be banned and account disabled.  If you get a warning it will last 14 days. If you don't get another warning within that 14 days it will be cleared. </br>

        </div>
      </div>
    </div>

    <div class='r_table'>
      <div class='r_header'>
        <div class='r_cell'>
          Requests Guidelines
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          A user is only permitted to make only 100 requests.</br> </br>
          Do NOT use external links (to another site) to fill requests. It is meant for the request to be uploaded to Blu-Torrents and then linked to the request.</br></br>
          If you properly fill a members request you will be granted 500 Bonus Points by the System.</br>
        </div>
      </div>
    </div>

    <div class='r_table'>
      <div class='r_header'>
        <div class='r_cell'>
          ReSeed Request Guidelines
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          If a torrent meets the following conditions, a Reseed button will appear:</br></br>
          Amount of seeds: 1 or less</br></br>
          Amount completed: 1 or more</br></br>
          Leechers: 1 or more</br></br>
          Age of torrent (days): 1 or more</br></br>
          Amount of days since the last reseed request: 5</br></br>
        </div>
      </div>
    </div>
"
.//////////////////////lkjsdhfkjdshfkljdshfkjlsadhflkjdshf
"
    <div class='r_table'>

      <div class='r_header'>
        <div class='r_cell'>
          Donation Guidelines
        </div>
      </div>

      <div class='r_row'>
        <div class='r_cell'>
          Any users that are having a donation error, didn't receive freeleech slots, VIP Rank or upload credit. Please contact Vinnie.</br>

        </br>Donation made under \"Get Timed V.I.P Rank\"
      </br>Become a V.I.P for 2 days per donated Euro if you donate 10 Euro or less </br>
      Become a V.I.P for 3 days per donated Euro if you donate between 11 Euro and 20 Euro </br>
      Become a V.I.P for 4 days per donated Euro if you donate 21 Euro or more</br>

    </br>Donation made under \"Get Upload Amount\"</br>
    Get 5 GB per donated Euro if you donate 19 Euro or less </br>
    Get 8 GB per donated Euro if you donate between 20 Euro and 29 Euro </br>
    Get 20 GB per donated Euro if you donate 30 Euro or more</br>

  </br>Donation made under \"Anonymous\"</br>
  In this case your account will be not credited in anyway , but in all cases we thank you for your support!</br>
</div>
</div>
</div>

<div class='r_table'>
  <div class='r_header'>
    <div class='r_cell'>
      Blu Chat Guidelines
    </div>
  </div>
  <div class='r_row'>
    <div class='r_cell'>
      No aggressive behaviour or flaming in chat</br>
    </br>No constant posting of useless things, such as just emotes, pictures, random nonsensical junk, ie: spamming. This could result in a warning or ban from chat.</br>
  </br>Do not mini mod. There is normally a Staff member around. Just because you can't see them, doesn't mean that they can't see you. If there is a serious problem and you see no Staff appear, then feel free to go to the HELPDESK. There is also the /ignore membername feature in chat.</br>
</br>There is to be NO posting serial numbers or license keys in chat.</br>
</br>No advertising/referring or selling of anything is to be posted in chat.</br>
</br>We advise you to not post your contact details e.g address or email address publicly in chat for your own privacy. If found, we will remove it without warning for your protection.</br>
</br>Disruptive behaviour in chat may result in a warning and or ban</br>
</div>
</div>
</div> 
</div>";

ob_end_clean();


?>
