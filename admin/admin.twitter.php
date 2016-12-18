<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");


$admintpl->set("language",$language);
$admintpl->set("BASEURL",$BASEURL);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("uid",$CURUSER["uid"]);

if(isset($_POST) && !empty($_POST))
{
    $admintpl->set("firstrun",false,true);
    (isset($_POST["pin"]) && !empty($_POST["pin"]) && is_numeric($_POST["pin"]) && strlen($_POST["pin"])==7) ? $pin=(int)0+$_POST["pin"] : $pin=false;
    if($pin===false)
    {
        stderr($language["ERROR"],$language["TWIT_BAD_PIN"]);
    }
    else
    {
        // Retrieve our previously generated request token & secret
        $res=do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}settings` WHERE `key` LIKE 'twitter_request_token%'",true);
        while($row=$res->fetch_assoc())
        {
            if($row["key"]=="twitter_request_token")
                $requestToken=$row["value"];
            elseif($row["key"]=="twitter_request_token_secret")
                $requestTokenSecret=$row["value"];
        }

        if($requestToken=="" || $requestTokenSecret=="")
        {
            stderr($language["ERROR"],$language["TWIT_REG_MISS_1"] . " <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=twitter'>" . $language["TWIT_AUTH_2"] . "</a> " . $language["TWIT_REG_MISS_2"]);
        }

        // Include class file & create object passing request token/secret also
        require_once("twitteroauth/twitteroauth/twitteroauth.php");
        $oauth = new TwitterOAuth('i3wrpWOyahTF4VO0Fo1EmQ', '4Ng72fOHs7p1nayKZZjcyWGmULhhnjmUX4MQdGzOvg', $requestToken, $requestTokenSecret);

        // Generate access token by providing PIN for Twitter
        $request = $oauth->getAccessToken(NULL, $pin);
        $accessToken = sqlesc($request['oauth_token']);
        $accessTokenSecret = sqlesc($request['oauth_token_secret']);

        // Save our access token/secret
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$accessToken."' WHERE `key`='twitter_oauth_token'",true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$accessTokenSecret."' WHERE `key`='twitter_oauth_token_secret'",true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='' WHERE `key` LIKE 'twitter_request_token%'",true);
        success_msg($language["SUCCESS"], $language["TWIT_SUCCESS"]);
        stdfoot();
        exit;
    }
}
else
{
    require_once('twitteroauth/twitteroauth/twitteroauth.php');
    $oauth = new TwitterOAuth('i3wrpWOyahTF4VO0Fo1EmQ','4Ng72fOHs7p1nayKZZjcyWGmULhhnjmUX4MQdGzOvg');

    $request = $oauth->getRequestToken();
    $requestToken = sqlesc($request['oauth_token']);
    $requestTokenSecret = sqlesc($request['oauth_token_secret']);

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$requestToken."' WHERE `key`='twitter_request_token'",true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$requestTokenSecret."' WHERE `key`='twitter_request_token_secret'",true);

    // display Twitter generated registration URL
    $registerURL = $oauth->getAuthorizeURL($request);
    $admintpl->set("firstrun",true,true);
    $admintpl->set("registerURL",$registerURL);
}
?>
