<p align="center">
<font face="Verdana" size="2px"><b><tag:language.WELCOME /> <tag:user />, <tag:language.AADS_PLEA_1 /> <tag:site /> <tag:language.AADS_PLEA_2 />
</b></font></p>
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
<br />
<if:fls_enabled2>
<br /><br /><tag:language.FLS_DONATE_INFO_1 /> <span style="color:steelblue;"><tag:fl_slot_cost /> <tag:unit_plural /></span> <tag:language.FLS_DONATE_INFO_2 />.
</if:fls_enabled2>
</b>
<br />
<if:vip_show_1><input type="radio" name="item_number" value="1" checked > <tag:language.AADS_GTVR /><else:vip_show_1><if:vip_show_3><input type="radio" name="item_number" value="4" checked ><tag:language.AADS_EXTEND /> <tag:vip_name /> <tag:vip_expire /></if:vip_show_3></if:vip_show_1>
<if:ul_show_1><input type="radio" name="item_number" value="2" <if:vip_show_4><if:check_1>checked</if:check_1></if:vip_show_4> /> <tag:language.AADS_GUA /></if:ul_show_1>

<input type="radio" name="item_number" value="3" <if:check_2><if:check_3>checked</if:check_3></if:check_2> > <tag:language.ANONYMOUS />
<if:ipn_en_1>
<input type="hidden" name="cmd" value="_xclick">
</if:ipn_en_1>
<input type="hidden" name="business" value="<tag:email />">
<if:ipn_en_2>
<input type="hidden" name="item_name" value="<tag:language.AADS_COOLY_DON_TO /> <tag:site />">
</if:ipn_en_2>
<br />
<br />
<table align='center' width='98%'border="1">
<tr>
<td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>                 
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>                    
</td>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>             
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>              
</td>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>               
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>            
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>
</td>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>               
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>            
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>
</td>
</tr>
<tr>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>                 
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>                    
</td>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>             
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>              
</td>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>               
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>            
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>
</td>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>               
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>            
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>
<else:fls_enabled3>
</td>
</tr>
<tr>
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>             
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>  
</td>              
            <td><br />
            	<center><font size="1.5px"><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></font></center>             
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form>  
<if:fls_enabled1>		 
			 </td>
			 <td>&nbsp;
			 <center><font size="1.5px"><span style='color:red'>Freeleech (place your amount here) <tag:sign /></span></font></center>
<center><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></center>
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form> 		 
			 </td>
			 <td>&nbsp;
			 <center><font size="1.5px"><span style='color:red'>Freeleech (place your amount here) <tag:sign /></span></font></center>
<center><span style='color:red'><tag:language.DONATE_1 /> (place your amount here) <tag:sign /> <tag:language.RECEIVE /></span></center>
                    <span><ul>                      
                        <li>Place</li>
                        <li>your</li>
                        <li>donation</li>
                        <li>offers here</li>
					         </ul></span>
<form action='index.php?page=donatebc' method='post' target="_blank">
<input type="hidden" name="item_name" value="<tag:language.AADS_DON_TO /> <tag:email />">
<input type="hidden" name="amount" value="(place your amount here)">
<center><input type="submit" name="submit" value="<tag:language.BC_DONATE />" /></center><br />
</form> 
</if:fls_enabled1>
</td>
</tr>
</table>