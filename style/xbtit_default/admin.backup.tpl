<style>
             #frame {
                display: none;
            }
	#sftpframe {
                display: none;
            }
#prbar {
    margin:5px;
    width:500px;
    background-color:transparent;
    overflow:hidden;
    
    /* Rounded Border */
    border: 1px solid #bbbbbb;
    -moz-border-radius: 15px;
    border-radius: 15px;
            
    /* Adding some shadow to the progress bar */
    -webkit-box-shadow: 0px 2px 4px #555555;
    -moz-box-shadow: 0px 2px 4px #555555;
    box-shadow: 0px 2px 4px #555555;            
}
        
/* No rounded corners for Opera, because the overflow:hidden dont work with rounded corners */
doesnotexist:-o-prefocus, #prbar {
  border-radius:0px;
}
        
#prpos {
    width:0%;
    height:30px;
    background-color:#3399ff;
    border-right:1px solid #bbbbbb;
           
    /* CSS3 Progress Bar Transitions */
    transition: width 2s ease;
    -webkit-transition: width 0s ease;
    -o-transition: width 0s ease;
    -moz-transition: width 0s ease;
    -ms-transition: width 0s ease;
   
    /* CSS3 Stripes */
    background-image: linear-gradient(135deg,#3399ff 25%,#99ccff 25%,#99ccff 50%, #3399ff 50%, #3399ff 75%,#99ccff 75%,#99ccff 100%);
    background-image: -moz-linear-gradient(135deg,#3399ff 25%,#99ccff 25%,#99ccff 50%, #3399ff 50%, #3399ff 75%,#99ccff 75%,#99ccff 100%);
    background-image: -ms-linear-gradient(135deg,#3399ff 25%,#99ccff 25%,#99ccff 50%, #3399ff 50%, #3399ff 75%,#99ccff 75%,#99ccff 100%);
    background-image: -o-linear-gradient(135deg,#3399ff 25%,#99ccff 25%,#99ccff 50%, #3399ff 50%, #3399ff 75%,#99ccff 75%,#99ccff 100%);
    background-image: -webkit-gradient(linear, 100% 100%, 0 0,color-stop(.25, #99ccff), color-stop(.25, #3399ff),color-stop(.5, #3399ff),color-stop(.5, #99ccff),color-stop(.75, #99ccff),color-stop(.75, #3399ff),color-stop(1, #3399ff));
    background-image: -webkit-linear-gradient(135deg,#3399ff 25%,#99ccff 25%,#99ccff 50%, #3399ff 50%, #3399ff 75%,#99ccff 75%,#99ccff 100%);
    background-size: 40px 40px;

    /* Background stripes animation */
    animation: bganim 3s linear 2s infinite;
    -moz-animation: bganim 3s linear 2s infinite;
    -webkit-animation: bganim 3s linear 2s infinite;
    -o-animation: bganim 3s linear 2s infinite;
    -ms-animation: bganim 3s linear 2s infinite;
}
        
@keyframes bganim {
    from {background-position:0px;} to { background-position:40px;}
}
@-moz-keyframes bganim {
    from {background-position:0px;} to { background-position:40px;}
}
@-webkit-keyframes bganim {
    from {background-position:0px;} to { background-position:40px;}
}
@-o-keyframes bganim {
    from {background-position:0px;} to { background-position:40px;}
}
@-ms-keyframes bganim {
    from {background-position:0px;} to { background-position:40px;}
}
	</style>

<if:sftp>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
                    	<table cellpadding="0" cellspacing="0" border="0" width="50%" align="center">
                        <tr>
<td>
<div id="prbar">
  <div id="prpos">
  </div>
</div>
</td>
</tr>
<tr>
<td class="block" style="text-align:center;">

</td>
</tr>
</table>
<iframe id="sftpframe" name="sftpframe"></iframe>
<script>
function updateProgress(percentage){
    if(percentage > 100) percentage = 100;
    var prpos = document.getElementById('prpos');
    prpos.style.width = percentage + '%';
    $("#prpos").html('<br />&nbsp;&nbsp;&nbsp;<span style="color:#000000;float:center;font-weight:bold;">'+percentage+'%</span>');
    
    		
					

}




    
     $(document).ready(function() {
     $("#sfForm").submit(function() {
     $('#sftpframe').load('transfer.php?'+$("#sfForm").serialize());
     var auto_refresh = setInterval(
     function()
     {
    $.getJSON('include/check_size.php?bupath=<tag:bupath />&'+$("#sfForm").serialize(), function(data) {
        
        dProgress = Math.ceil(data.fsize / data.size * 100);
        if(dProgress==100)
        {
        window.location = "<tag:redir />";
        }
        else{
        if(dProgress>0)
        updateProgress(dProgress);
        }
    });
}, 3000);
return false;
});
});
</script>
<form method="POST" id="sfForm" action="<tag:frmsf />">
                   	<table cellpadding="0" cellspacing="0" border="0" width="70%">
                        <tr>
                        <td class="header" colspan="2" style="text-align:center"><tag:lang.ACP_BUINFO_EX /></td></tr><tr>
                        <td class="lista" colspan="2" style="text-align:center"><tag:lang.ACP_BUINFO_EXI /></td></tr><tr>
                        <td class="header"><tag:lang.FILE />&nbsp;<tag:lang.ACP_BUINFO_EF />:</td><td class="lista"><input type="text" value="<tag:set.CBT_FILE_FROM />" size="30" name="CBT_FILE_GO"></td>
                        </tr>
                        <tr>
                        <td class="header">S<tag:lang.HACK_FTP_SERVER />:</td><td class="lista"><input type="text" size="30" name="CBT_SFTP_SERV"></td>
                        </tr>
                        <tr>
                        <td class="header">S<tag:lang.HACK_FTP_PORT />:</td><td class="lista"><input type="text" size="30" name="CBT_SFTP_PORT"></td>
                        </tr>
                        <tr>
                        <td class="header">S<tag:lang.HACK_FTP_USERNAME />:</td><td class="lista"><input type="text" size="30" name="CBT_SFTP_USER"></td>
                        </tr>
                        <tr>
                        <td class="header">S<tag:lang.HACK_FTP_PASSWORD />:</td><td class="lista"><input type="password" size="30" name="CBT_SFTP_PASS"></td>
                        </tr>
                        <tr>
                        <td class="header" colspan="2" style="text-align:center;"><input type="submit" value="<tag:lang.SUBMIT />"></td>
                         </tr>
				</table>
				</form>
<else:sftp>	
<if:conf>
<form method="POST" action="<tag:frm />">
                   	<table cellpadding="0" cellspacing="0" border="0" width="70%">
                        <tr>
                        <td class="header"><tag:lang.ACP_BUINFO_BP /></td>
                        <td class="lista"><input type="text" value="<tag:set.CBT_FILE_BACKUP_DIR />" size="20" name="CBT_FILE"> <tag:lang.ACP_BUINFO_FS /></td>
                        </tr>
                        <tr>
                        <td class="header" colspan="2" style="text-align:center;"><input type="submit" value="<tag:lang.SUBMIT />"></td>
                         </tr>
				</table>
				</form>
<else:conf>
<a name='progress'></a>
<div id="wrapper" align="center">
<br />
        	<table cellpadding="0" cellspacing="0" border="0" width="30%" align="center">
                        <tr>
<td class="blocklist" align="left" valign="top" width="100px" style="text-align:center;">
        	<a href="<tag:bk />"><img border='0' alt='<tag:lang.ACP_BUINFO />' src='images/backup.png' title='<tag:lang.ACP_BUINFO />'><br /><tag:lang.ACP_BUINFO /></a></td><td class="blocklist" valign="top" width="100px" align="left" style="text-align:center;"><a href="<tag:cf />"><img border='0' alt='<tag:lang.ACP_BUINFO_C />' src='images/config.png' title='<tag:lang.ACP_BUINFO_C />'><br /><tag:lang.ACP_BUINFO_C /></a></td>
        	<td class="blocklist" valign="top" width="100px" align="left" style="text-align:center;"><a href="<tag:s2 />"><img border='0' alt='<tag:lang.ACP_BUINFO_S />' src='images/sendto.png' title='<tag:lang.ACP_BUINFO_S />'><br /><tag:lang.ACP_BUINFO_S /></a></td>
        	</tr>
        	</table>

        
<if:go>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
                    	<table cellpadding="0" cellspacing="0" border="0" width="50%" align="center">
                        <tr>
<td>
<div id="prbar">
  <div id="prpos">
  </div>
</div>
</td>
</tr>
<tr>
<td class="block" style="text-align:center;">
<tag:lang.ACP_BUINFO2 />
</td>
</tr>
</table>
<iframe id="frame" name="frame"></iframe>
<script>
function updateProgress(percentage){
    if(percentage > 100) percentage = 100;
    var prpos = document.getElementById('prpos');
    prpos.style.width = percentage + '%';
    $("#prpos").html('<br />&nbsp;&nbsp;&nbsp;<span style="color:#000000;float:center;font-weight:bold;">'+percentage+'%</span>');
    
    		
					

}




    
     $(document).ready(function() {
     $('#frame').load('filee.php?go=1');
     var auto_refresh = setInterval(
     function()
     {
    $.getJSON('recurse.php', function(data) {
        
        dProgress = Math.ceil(data.fsize / data.size * 100);
        if(dProgress==100)
        {
        window.location = "<tag:redir />";
        }
        else{
        if(dProgress>0)
        updateProgress(dProgress);
        }
    });
}, 3000);
});
</script>
<else:go>       
        <div id="containerHolder" align="center"><br />
        <tag:alert /><tag:alert2 />
			<div id="container">
                
                
                <div id="mainc">
                	
                    	<table cellpadding="0" cellspacing="0" border="0" width="70%">
                        <tr>
                        <td class="header" colspan="7" style="text-align:center;"><tag:lang.ACP_BUINFO_AB /></td></tr>
                        <tr>
                        <td class="header" style="text-align:center;"><tag:lang.FILE /></td><td class="header" style="text-align:center;"><tag:lang.DOWNLOAD /></td><td  class="header" style="text-align:center;"><tag:lang.DELETE /></td><td  class="header" style="text-align:center;"><tag:lang.ACP_BUINFO_S /></td>
                        </tr>
                        <loop:file>
                        <tr>
                        <td class="lista" style="text-align:center;"><tag:file[].name /></td><td class="lista" style="text-align:center;"><tag:file[].zip /></td><td  class="lista" style="text-align:center;"><tag:file[].delete /></td><td  class="lista" style="text-align:center;"><tag:file[].send /></td>
                         </tr>
                        </loop:file>
				</table>
				<br />
                    
                </div>
                <!-- // #main -->
                
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>	
        <!-- // #containerHolder -->
        
    </div>
    <!-- // #wrapper -->
</if:go>
</if:conf>
</if:sftp>
