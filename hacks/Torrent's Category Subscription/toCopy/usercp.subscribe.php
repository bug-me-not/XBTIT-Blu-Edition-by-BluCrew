<?php

if (!defined("IN_BTIT"))
      die("non direct access!");


switch ($action)
{
    case 'post':
        $subscription="";
         if (isset($_POST["subs"]))
          {
          $_POST["subs"]=array_map(intval,$_POST["subs"]);
          $subscription=implode(",",$_POST["subs"]);
        }
        do_sqlquery("UPDATE {$TABLE_PREFIX}users SET subscription=".($subscription==""?"NULL":sqlesc($subscription))." WHERE id=".$CURUSER["uid"],true);
        redirect("index.php?page=usercp&do=subscribe&action=change&uid=".$CURUSER["uid"]);
        die();
     break;

    case '':
    case 'change':
    default:
        $cat=get_result("SELECT IF(sc.id IS NULL,c.id,sc.id) as id, CONCAT(c.name,IF(sc.name IS NOT NULL,CONCAT(' => ',sc.name),'')) as name FROM {$TABLE_PREFIX}categories c LEFT JOIN {$TABLE_PREFIX}categories sc on c.id=sc.sub where c.sub='0' ORDER BY c.sort_index, sc.sort_index, c.id, sc.id",true,$CACHE_DURATION);
        $sub=get_result("SELECT subscription FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER["uid"]);
        $subscribe=explode(",",$sub[0]["subscription"]);
        $categories_sub="";
        if (count($sub)>0)
          {
            $categories_sub.="\n<table>\n<tr>";
            $i=0;
            foreach ($cat as $subs)
              {
              if ($i>0 && $i % 5 == 0)
                $categories_sub.="\n<tr>";
              $categories_sub.="\n<td align=\"center\">".$subs["name"]."<br />\n";
              if (is_array($subscribe) && in_array($subs["id"],$subscribe))
                 $categories_sub.="<input type=\"checkbox\" name=\"subs[]\" value=\"".$subs["id"]."\" checked=\"checked\" /></td>";
              else
                $categories_sub.="<input type=\"checkbox\" name=\"subs[]\" value=\"".$subs["id"]."\" /></td>";

              $i++;

              if ($i>0 && $i % 5 == 0)
                $categories_sub.="\n</tr>";

            }
            while ($i % 5 != 0)
              {
              $categories_sub.="\n<td>&nbsp;</td>";
              $i++;
            }
            $categories_sub.="\n</tr>\n</table>";
        }
        unset($cat);
        $usercptpl->set("sub_categories",$categories_sub);
        $usercptpl->set("frm_action","index.php?page=usercp&amp;do=subscribe&amp;action=post&amp;uid=".$CURUSER["uid"]);
    break;
}
?>