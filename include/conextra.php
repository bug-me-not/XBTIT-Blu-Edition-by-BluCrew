<?php

function getConnection () {

    $CURRENTPATH = dirname(__FILE__);

    include($CURRENTPATH."/settings.php"); # contains the given DB setup $database, $dbhost, $dbuser, $dbpass

    $Econn = new mysqli($dbhost, $dbuser, $dbpass);
    if ($Econn->connect_error) {
            echo "Connection to DB was not possible!";
            end;
        }
      if(!$Econn->select_db($database)){
         echo "No DB with that name seems to exist on the server!";
         end;
      }


        if($GLOBALS["charset"]=="UTF-8")
            $Econn->query("SET NAMES utf8");

        return $Econn;
}

function getPrefix () {

    $CURRENTPATH = dirname(__FILE__);

    include($CURRENTPATH."/settings.php"); # contains the given DB setup $database, $dbhost, $dbuser, $dbpass

    return $TABLE_PREFIX;
}
?>
