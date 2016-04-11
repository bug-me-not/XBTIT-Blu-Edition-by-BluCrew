<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

  
global $TABLE_PREFIX, $CURUSER;
 
$djfaqtpl=new bTemplate();
 
require(load_language("lang_shoutcast.php"));

$djfaqtpl->set("language",$language);

  ($query = do_sqlquery ('SELECT uid FROM '.$TABLE_PREFIX.'shoutcastdj WHERE active = \'1\' AND uid = \'' . $CURUSER['uid'] . '\'') OR die ());
  if (sql_num_rows ($query) == 0)
  {
    stderr ($language['ERROR'], $language['no']);
  }

  
  //$faq=$language['dj_faq'];
  
  //$djfaqtpl->set("faq",$faq);
?>