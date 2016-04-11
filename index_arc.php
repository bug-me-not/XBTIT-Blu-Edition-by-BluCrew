<?php
//Here you will find all relevant code moved from index.php to index_arc.php
//Code has been moved here for convience and simplicity.

$arcswitch =do_sqlquery("SELECT status FROM {$TABLE_PREFIX}blocks WHERE content = 'arcade'");
$arcon=$arcswitch->fetch_array();
if ($arcon["status"]=='1')
{

   $user = $CURUSER['uid'];

   $arcuser =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = ".$user);
   $arcus=$arcuser->fetch_array();

   $arcadeuser = $arcus["username"];

   $upbon=($btit_settings["arc_upl"]*1024*1024);
   $seedbon=$btit_settings["arc_sb"];
   if ($btit_settings["arc_aw"] == true)
   {
      $arte=$btit_settings["arc_upl"].' MB upload';
   }
   else
   {
      $arte=$btit_settings["arc_sb"].' seedbonus points';
   }

   if($_GET["act"]=="Arcade")
   {

      // flood protection
      $arflood =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores ORDER BY date DESC LIMIT 1");
      $arcflow=$arflood->fetch_array();
      $time_A=strtotime(now);
      $time_B = strtotime($arcflow["date"]);
      if (($time_A-$time_B)<10)
      {
         redirect("index.php?page=arcadex");
      }
      else
      {

         if($_POST['gname'] == "yeti1")
         {
            $game = 1;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='1' ORDER BY score DESC LIMIT 1");
            $arcad =$ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti Penguin\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti Penguin is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yeti11.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yetitoursm")
         {
            $game = 2;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='2' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti Pentathlon\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti Pentathlon is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yetitoursm1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yeti7")
         {
            $game = 3;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='3' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti Snowboard\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti Snowboard is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yeti71.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yeti6")
         {
            $game = 4;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='4' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti BigWave\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti BigWave is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yeti61.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yeti5pro")
         {
            $game = 5;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='5' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti Safari\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti Safari is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yeti5pro1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "pacman")
         {
            $game = 6;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='6' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Pacman\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Pacman is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/pacman1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yeti4")
         {
            $game = 7;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='7' ORDER BY score DESC LIMIT 1");
            $arcad =$ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti Overload\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti Overload is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yeti41.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "summergames04")
         {
            $game = 8;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='8' ORDER BY score DESC LIMIT 1");
            $arcad =$ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Summergames\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Summergames is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/summergames041.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yeti_stagedive")
         {
            $game = 9;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='9' ORDER BY score DESC LIMIT 1");
            $arcad =$ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti StageDive\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti StageDive is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/yeti_stagedive1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "BubbleShooterSte")
         {
            $game = 10;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='10' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Bubble Shooter\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Bubble Shooter is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/BubbleShooterSte1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "SuperFlashMarioBrosSte")
         {
            $game = 11;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='11' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Super Mario Bros\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Super Mario Bros is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/SuperFlashMarioBrosSte1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "blackknight")
         {
            $game = 12;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='12' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Black Knight\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Black Knight is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/blackknight1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "matrix_dock_defense_Ste")
         {
            $game = 13;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='13' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Matrix Dock Defense\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Matrix Dock Defense is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);
               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/matrix_dock_defense_Ste1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "fishermansam")
         {
            $game = 14;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='14' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Fisherman Sam\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Fisherman Sam is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);
               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/fishermansam1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "alloyarena")
         {
            $game = 15;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='15' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Alloy Arena\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Alloy Arena is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/alloyarena1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "BabycalThrowSte")
         {
            $game = 16;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='16' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Babycal Throw\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Babycal Throw is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/BabycalThrowSte1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "junglekidSte")
         {
            $game = 17;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='17' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Jungle Kid\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Jungle Kid is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/junglekidSte1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "supersplashBH")
         {
            $game = 18;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='18' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Super Splash\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Super Splash is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/supersplashBH1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }

         if($_POST['gname'] == "autobahn")
         {
            $game = 19;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='19' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Auto Bahn\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Auto Bahn is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/autobahn1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }

         if($_POST['gname'] == "chainreactionGS")
         {
            $game = 20;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='20' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Chain Reaction\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Chain Reaction is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/chainreactionGS1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "yeti9v32JS")
         {
            $game = 21;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='21' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Yeti Final Spit\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Yeti Final Spit is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/y10.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "DestroyAllHumansSte")
         {
            $game = 22;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='22' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Destroy All Humans\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Destroy All Humans is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/DestroyAllHumansSte1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "sonicblox")
         {
            $game = 23;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='23' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Sonic Blox\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Sonic Blox is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/sonicblox1.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "trappedinawell")
         {
            $game = 24;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='24' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Trapped In A Well\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Trapped In A Well is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/trappedinawell.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         if($_POST['gname'] == "colorball2")
         {
            $game = 25;
            $level = 1;
            $score = $_POST['gscore'];
            $ardresult = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}flashscores WHERE game ='25' ORDER BY score DESC LIMIT 1");
            $arcad = $ardresult->fetch_array();
            $loser=$arcad["user"];
            if ($score > $arcad["score"])
            {
               if ($btit_settings["arc_aw"] == true)
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=uploaded+'".$upbon."' WHERE `id`=".$user."", true);
               }
               else
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=seedbonus+'".$seedbon."' WHERE `id`=".$user."", true);
               }
               send_pm(0,$user,sqlesc('You Beat The Highscore!'), sqlesc("You did beat the highscore for Trapped In A Well\n\n Congratulations , you did recieve a ".$arte." bonus !!\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               if ($user!=$loser)
               {
                  send_pm(0,$loser,sqlesc('Your Highscore Is Broken!'), sqlesc("Your highscore for Trapped In A Well is broken\n\n Time to visit the arcade and get it back ;)\n\n [color=red]This is a automatic system message , so DO NOT reply ![/color]"));
               }
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='0' WHERE `id`=".$loser."", true);
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `trophy`='1' WHERE `id`=".$user."", true);

               $al =do_sqlquery("SELECT * FROM {$TABLE_PREFIX}chat ORDER BY id DESC LIMIT 1");
               $rw=$al->fetch_assoc();
               $ct =  ($rw["count"]+1);
               quickQuery("INSERT INTO {$TABLE_PREFIX}chat (uid, time, name, text,count) VALUES (0,".time().", 'System','[color=red]NEW HIGHSCORE FOR[/color]: [img]$BASEURL/flash/colorball2.gif[/img] Score: ".$score." By ".$arcadeuser." Award: ".$arte."',".$ct.")");
            }
         }
         quickQuery("INSERT INTO `{$TABLE_PREFIX}flashscores` ( `ID` , `game` , `user` , `level` , `score` ,`date` ) VALUES ( '', '".$game."', '".$user."', '".$level."', '".$score."',NOW());") OR DIE(sql_error());
         redirect("index.php?page=arcadex");
      }
   }
}
?>
