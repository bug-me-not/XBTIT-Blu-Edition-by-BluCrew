  /*################################################################
  #
  #         Ajax MySQL shoutbox for btit
  #         Version 1.0
  #         Author: miskotes
  #         Created: 11/07/2007
  #         Contact: miskotes [at] yahoo.co.uk
  #         Website: http://www.yu-corner.com
  #         Credits: linuxuser.at, plasticshore.com
  #
  ################################################################*/
var GetChaturl="ajaxchat/getPChatData.php";var SendChaturl="ajaxchat/sendPChatData.php";var lastID=-1;var httpReceiveChat=getHTTPObject();var httpSendChat=getHTTPObject();window.onload=initJavaScript;function initJavaScript(){window.status="";document.forms['chatForm'].elements['chatbarText'].setAttribute('autocomplete','off');checkStatus('');receiveChatText();}
function DeleteShout(){document.forms['chatForm'].elements['chatbarText'].value=document.forms['chatForm'].elements['chatbarText'].value+" "+smile+" ";document.forms['chatForm'].elements['chatbarText'].focus();}
function SmileIT(smile){document.forms['chatForm'].elements['chatbarText'].value=document.forms['chatForm'].elements['chatbarText'].value+" "+smile+" ";document.forms['chatForm'].elements['chatbarText'].focus();}
function PopPhistory(){newWin=window.open('index.php?page=allPshout','shouthistory','height=500,width=490,resizable=yes,scrollbars=yes');if(window.focus){newWin.focus()}}
function PopMoreSmiles(form,name){newWin=window.open('index.php?page=moresmiles&form='+form+'&text='+name,'moresmile','height=500,width=450,resizable=yes,scrollbars=yes');if(window.focus){newWin.focus()}}
function receiveChatText(){if(httpReceiveChat.readyState==4||httpReceiveChat.readyState==0){httpReceiveChat.open("GET",GetChaturl+'?lastID='+lastID+'&rand='+Math.floor(Math.random()*1000000),true);httpReceiveChat.onreadystatechange=handlehHttpReceiveChat;httpReceiveChat.send(null);}}
function handlehHttpReceiveChat(){if(httpReceiveChat.readyState==4){var results=document.getElementById("outputPList");results.innerHTML=httpReceiveChat.responseText;setTimeout('receiveChatText();',30000);}}
function sendComment(){if(httpSendChat.readyState==4||httpSendChat.readyState==0){currentChatText=encodeURIComponent(document.forms['chatForm'].elements['chatbarText'].value);if(currentChatText!=''){currentName=encodeURIComponent(document.forms['chatForm'].elements['name'].value);currentUid=document.forms['chatForm'].elements['uid'].value;currenttoid=document.forms['chatForm'].elements['toid'].value;currentP=document.forms['chatForm'].elements['pchat'].value;param='n='+currentName+'&c='+currentChatText+'&u='+currentUid+'&t='+currenttoid+'&p='+currentP;httpSendChat.open("POST",SendChaturl,true);httpSendChat.setRequestHeader('Content-Type','application/x-www-form-urlencoded');httpSendChat.onreadystatechange=handlehHttpSendChat;httpSendChat.send(param);document.forms['chatForm'].elements['chatbarText'].value='';}}else{setTimeout('sendComment();',1000);}}
function handlehHttpSendChat(){if(httpSendChat.readyState==4){receiveChatText();}}
function checkStatus(focusState){currentChatText=document.forms['chatForm'].elements['chatbarText'];oSubmit=document.forms['chatForm'].elements['submit'];if(currentChatText.value!=''||focusState=='active'){oSubmit.disabled=false;}else{oSubmit.disabled=true;}}
function getHTTPObject(){var xmlhttp;if(!xmlhttp&&typeof XMLHttpRequest!='undefined'){try{xmlhttp=new XMLHttpRequest();}catch(e){xmlhttp=false;}}
return xmlhttp;}