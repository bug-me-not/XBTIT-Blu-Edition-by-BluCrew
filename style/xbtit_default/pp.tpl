<p align="center">
<font face="Verdana" size="2px"><b><tag:language.WELCOME /> <tag:user />, <tag:language.AADS_PLEA_1 /> <tag:site /> <tag:language.AADS_PLEA_2 /><br /><br />
</b></font></p>


<p><table align='center' width='98%'>
<tr>
<td class='header' align='center'>
<form action="<tag:url />" method="post">
<center>
<if:vip_show_1><input type="radio" name="item_number" value="1" checked > <tag:language.AADS_GTVR /><else:vip_show_1><if:vip_show_3><input type="radio" name="item_number" value="4" checked ><tag:language.AADS_EXTEND /> <tag:vip_name /> <tag:vip_expire /></if:vip_show_3></if:vip_show_1>
<if:ul_show_1><input type="radio" name="item_number" value="2" <if:vip_show_4><if:check_1>checked</if:check_1></if:vip_show_4> /> <tag:language.AADS_GUA /></if:ul_show_1>
<if:fls_enabled1><input type="radio" name="item_number" value="5"> <tag:language.FLS_FREE_SLOTS /></if:fls_enabled1>
<input type="radio" name="item_number" value="3" <if:check_2><if:check_3>checked</if:check_3></if:check_2> > <tag:language.ANONYMOUS />

<if:ipn_en_1>
<input type="hidden" name="cmd" value="_xclick">
</if:ipn_en_1>
<input type="hidden" name="business" value="<tag:email />">
<if:ipn_en_2>
<input type="hidden" name="item_name" value="<tag:language.AADS_COOLY_DON_TO /> <tag:site />">
</if:ipn_en_2>

</center>

<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<tag:email />">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:site />">
<p align="center">
<br />
<u><tag:language.AADS_PSADA />:</u>
<br /><br />

<select name="amount">
<option selected >---<tag:language.AADS_CDA />---</option>
<loop:poss_don_amnt>
<option value="<tag:poss_don_amnt[] />"><if:signleft><tag:sign /></if:signleft><tag:poss_don_amnt[] /><if:signright> <tag:sign /></if:signright>  <tag:language.DONATION /> </option>
</loop:poss_don_amnt>
</select>

<input type="hidden" name="processor" value="<tag:proc />">
<input type="hidden" name="custom" value="<tag:uid />">
<input type="hidden" name="shipping" value="0">
<input type="hidden" name="currency_code" value="<tag:currency />">
<if:ipn_en_3>
<input type="hidden" name="return" value="<tag:url_back />">
<input type="hidden" name="cancel_return" value="<tag:url_back />">
<input type="hidden" name="notify_url" value="<tag:url_back />/paypal.php"> 
</if:ipn_en_3>

<br />
</p>
<p align="center">
<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="I1" alt="Make payments with PayPal - it's fast, free and secure!">
<br /><br />


<b><tag:language.AADS_CHOICES_1 /><if:vip_show_2><br /><br /><tag:language.AADS_CHOICES_2 /> <tag:vip_name /> <tag:language.AADS_CHOICES_3 /> <span style='color:red' ><tag:days /> <if:days_plural> <tag:language.AADS_CHOICES_4 /><else:days_plural><tag:language.AADS_CHOICES_14 /></if:days_plural> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue' ><tag:today /> <tag:unit_plural /> <tag:language.AADS_CHOICES_6 /></span>
<br /><tag:language.AADS_CHOICES_7 /> <tag:vip_name /> <tag:language.AADS_CHOICES_8 /> <span style='color:red'><tag:daysb /> <if:daysb_plural><tag:language.AADS_CHOICES_4 /><else:daysb_plural><tag:language.AADS_CHOICES_14 /></if:daysb_plural> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:language.AADS_CHOICES_10 /> <tag:count /> <tag:unit_plural /> <tag:language.WORD_AND /> <tag:todayb /> <tag:unit_plural /></span>
<br /><tag:language.AADS_CHOICES_7 /> <tag:vip_name /> <tag:language.AADS_CHOICES_8 /> <span style='color:red'><tag:daysc /> <if:daysc_plural><tag:language.AADS_CHOICES_4 /><else:daysc_plural><tag:language.AADS_CHOICES_14 /></if:daysc_plural> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:countb /> <tag:unit_plural /> <tag:language.AADS_CHOICES_11 /></span>


<else:vip_show_2>


<if:vip_show_5>
<br /><br /><tag:language.AADS_EXTEND /> <tag:vip_name /> <tag:language.AADS_CHOICES_15 /> <span style='color:red' ><tag:days /> <if:days_plural> <tag:language.AADS_CHOICES_4 /><else:days_plural><tag:language.AADS_CHOICES_14 /></if:days_plural> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue' ><tag:today /> <tag:unit_plural /> <tag:language.AADS_CHOICES_6 /></span>
<br /><tag:language.AADS_EXTEND /> <tag:vip_name /> <tag:language.AADS_CHOICES_15 /> <span style='color:red'><tag:daysb /> <if:daysb_plural><tag:language.AADS_CHOICES_4 /><else:daysb_plural><tag:language.AADS_CHOICES_14 /></if:daysb_plural> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:language.AADS_CHOICES_10 /> <tag:count /> <tag:unit_plural /> <tag:language.WORD_AND /> <tag:todayb /> <tag:unit_plural /></span>
<br /><tag:language.AADS_EXTEND /> <tag:vip_name /> <tag:language.AADS_CHOICES_15 /> <span style='color:red'><tag:daysc /> <if:daysc_plural><tag:language.AADS_CHOICES_4 /><else:daysc_plural><tag:language.AADS_CHOICES_14 /></if:daysc_plural> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:countb /> <tag:unit_plural /> <tag:language.AADS_CHOICES_11 /></span>
</if:vip_show_5>







</if:vip_show_2>
<if:ul_show_2><br /><br /><tag:language.AADS_CHOICES_12 /> <span style='color:red'><tag:gb /> <tag:language.AADS_CHOICES_13 /> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:togb /> <tag:unit_plural /> <tag:language.AADS_CHOICES_6 /></span>
<br /><tag:language.AADS_CHOICES_12 /> <span style='color:red'><tag:gbb /> <tag:language.AADS_CHOICES_13 /> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:language.AADS_CHOICES_10 /> <tag:countc /> <tag:unit_plural /> <tag:language.WORD_AND /> <tag:togbb /> <tag:unit_plural /></span>
<br /><tag:language.AADS_CHOICES_12 /> <span style='color:red'><tag:gbc /> <tag:language.AADS_CHOICES_13 /> <tag:unit /></span> <tag:language.AADS_CHOICES_5 /> <span style='color:steelblue'><tag:countd /> <tag:unit_plural /> <tag:language.AADS_CHOICES_11 /></span></if:ul_show_2>


<if:fls_enabled2>
<br /><br /><tag:language.FLS_DONATE_INFO_1 /> <span style="color:steelblue;"><tag:fl_slot_cost /> <tag:unit_plural /></span> <tag:language.FLS_DONATE_INFO_2 />.
</if:fls_enabled2>

</b>


</form></td>
</tr>
</table><br />
</p>
