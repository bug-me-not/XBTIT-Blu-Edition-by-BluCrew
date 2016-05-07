<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//    This file is part of xbtitFM v.1.1 by BluCrew
//
//    Invite List Coverted - by HDVinnie
//
////////////////////////////////////////////////////////////////////////////////////
ob_start();

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    err_msg(ERROR.NOT_AUTHORIZED." ",SORRY."...");
    stdfoot();
    exit();
   }
else
    {

$id = (int)$_GET["id"];
  
echo "<br><center><b><p class='text-primary'>Accepted Invite List</p></b></center>";

?>
  <table class="table table-bordered">
  <tr>
    <td class=header align=center width="auto"><center>Username</center></td>
    <td class=header align=center width="auto"><center>Joinded</center></td>
   </tr>
   
<?php

  $sql="SELECT * FROM {$TABLE_PREFIX}users WHERE invited_by = ".$id;
  $row = do_sqlquery($sql,true);
  
if (sql_num_rows($row)==0)
{
?>

           <tr>
          <td class=lista align=center><b><center>No Users Invited</center></b></td>
          <td class=lista><b><center>By This User</b></center></td>
            </tr>
<?php	
	
}
else
{
      while($data=$row->fetch_array())

      {
        $rec=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id=$data[id_level]" );
        $recc= $rec->fetch_assoc();
        $users=$recc["prefixcolor"] .$data["username"]. $recc["sufixcolor"];
        $userss="<a href='index.php?page=userdetails&id=".$data[id]."'>".$users."</a>";
    ?>

           <tr>
          <td class=lista align=center><b><center><?php echo $userss ?></center></b></td>
          <td class=lista><b><center><?php echo $data['joined'] ?></b></center></td>
            </tr>
<?php

}
}
}
$module_out=ob_get_contents();
ob_end_clean();
?>