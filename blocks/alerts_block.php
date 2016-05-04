<center><div class="page-header">
<h1><p class="text-danger">Site Alerts</p><small> Ratio Free Enabled | Bootstrap {LESS} Enabled</small>
</h1></div></center>

<?php
       if($btit_settings["fmhack_free_leech_with_happy_hour"]=="enabled")
   {
      $query = get_result("SELECT free, happy_hour, happy, UNIX_TIMESTAMP(`free_expire_date`) AS `timestamp` FROM `{$TABLE_PREFIX}files` WHERE `external`='no' LIMIT 1",true,$btit_settings["cache_interval"]);
      $row = $query[0];

      if(($row["free"]=="no" AND $row["happy_hour"] =="no") || (@sql_num_rows($query)==0))
      {
         $freec="blue";
         $till='';
         $col=$language['FL_FREE_LEECH'];
         $post=' '.$language['FL_NOT_TODAY'];
         $img='';
      }
    
     if($row["free"]=="yes")
      {
         $freec="green";
         $till=' '.$language['FL_TO'].' ';
         $col=$language['FL_FREE_LEECH'];
         $post=date("l F jS Y \a\\t g:i a",$row["timestamp"]);
         $img='';
      }

 print("</tr><tr><td class=\"mainuser\" align=\"center\" colspan=\"10\" style=\"text-align:center; padding-top:12px; padding-left:20px; float:none; font-style:italic; font-family: Verdana, Arial, Helvetica, sans-serif;\"><font color='$freec'>".$col."".$till."".ucfirst($post)."</font>".(($img!="")?"&nbsp;&nbsp;&nbsp;".$img:"")."</td>\n");
 print("<td class=\"header\" align=\"center\"><a class=\"mainmenu\">".$col."<font color='$freec'>$till".ucfirst($post)."</font> $pic</td>\n");
   }

               ?>
