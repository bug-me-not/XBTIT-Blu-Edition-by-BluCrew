<?php
error_reporting(E_ALL);
 ini_set("display_errors", 1);
require"include/functions.php";
dbconn();



function paypal_form($amount,$mail,$item,$curr)
{
global $CURUSER, $btit_settings, $TABLE_PREFIX, $BASEURL;
// get user's style
    $resheet=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]." LIMIT 1",TRUE,$btit_settings["cache_duration"]);
    if (!$resheet)
    {
        $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
        $STYLEURL="$BASEURL/style/xbtit_default";
    }
    else
    {
        $resstyle=$resheet->fetch_array();
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
    }
// get settings
$zap_pp = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'");
$settings = $zap_pp->fetch_array();
$form = '
	<html>
		<head><title>processing</title><link rel="stylesheet" type="text/css" href="'.$STYLEURL.'/main.css" /></head>
		<body onload="document.paypal.submit();"><br/><br/><br/><br/><br/>
			<table width=30% align=center><tr><td class="block"><center><b>Processing</b></center></td></tr><tr>
                        <td class=lista><center><img border="0" src="images/safe-secure.gif"></td></tr></table>
			<form action="'.($settings["test"]=="true"?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr").'" method="post" name="paypal">
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="no_note" value="1" />
				<input type="hidden" name="no_shipping" value="1" />
				<input type="hidden" name="business" value="'.$mail.'" />
				<input type="hidden" name="item_number" value="'.$item.'" />
				<input type="hidden" name="item_name" value="Donation from uid: '.$CURUSER['uid'].'" />
				<input type="hidden" name="quantity" value="1" />
				<input type="hidden" name="amount" value="'.$amount.'" />
				<input type="hidden" name="currency_code" value="'.$curr.'" />
				<input type="hidden" name="email" value="'.$CURUSER['email'].'" />
				<input type="hidden" name="address1" value="" />
				<input type="hidden" name="address2" value="" />
				<input type="hidden" name="city" value="" />
				<input type="hidden" name="country" value="" />
				<input type="hidden" name="zip" value="" />
				<input type="hidden" name="night_phone_a" value="" />
				<input type="hidden" name="night_phone_b" value="" />
				<input type="hidden" name="return" value="'.($return_to_address ? $return_to_address['true'] : $BASEURL.'/index.php?page=success').'" />
				<input type="hidden" name="cancel_return" value="'.($return_to_address ? $return_to_address['false'] : $BASEURL.$_SERVER['SCRIPT_NAME'].'?do=cancel').'" />
			</form>
		</body>
	</html>';
if ($CURUSER['uid'] === 0 OR $CURUSER['username'] === 'Guest')
	{
		unset($CURUSER);
	}
	return $form;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$amount = 0 + $_POST['amount'];
	$processor = htmlspecialchars($_POST['processor']);
    $mail=htmlspecialchars($_POST['business']);
    $item=(int)$_POST['item_number'];
    $curr=htmlspecialchars($_POST['currency_code']);
	if (!empty($amount) && $processor == 'paypal' or $processor == 'sandbox')
	{
		echo paypal_form($amount,$mail,$item,$curr);
		exit;
	}

}
?>
