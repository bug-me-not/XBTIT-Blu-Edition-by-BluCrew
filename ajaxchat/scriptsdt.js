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


var GetChaturl = "ajaxchat/getChatData.php";
var SendChaturl = "ajaxchat/sendChatData.php";
var lastID = -1; //initial value will be replaced by the latest known id

// initiates the two objects for sending and receiving data
var httpReceiveChat = getHTTPObject();
var httpSendChat = getHTTPObject();

window.onload = initJavaScript;

function popvideo(url) {
		newwindow=window.open(url,'YouTube','height=400,width=800,top=200,left=300,resizable=no,scrollbars=no');
		if (window.focus) newwindow.focus();
	}


function initJavaScript() {
window.status = "";
    document.forms['chatForm'].elements['chatbarText'].setAttribute('autocomplete','off'); //this non standard attribute prevents firefox' autofill function to clash with this script
    checkStatus(''); //sets the initial value and state of the input comment
    receiveChatText(); //initiates the first data query
}


//deletes main shout window
function DeleteShout() {
    document.forms['chatForm'].elements['chatbarText'].value = document.forms['chatForm'].elements['chatbarText'].value+" "+smile+" ";  //this non standard attribute prevents firefox' autofill function to clash with this script
    document.forms['chatForm'].elements['chatbarText'].focus();
}


//inserts smilies into form
function SmileIT(smile){
    document.forms['chatForm'].elements['chatbarText'].value = document.forms['chatForm'].elements['chatbarText'].value+" "+smile+" ";  //this non standard attribute prevents firefox' autofill function to clash with this script
    document.forms['chatForm'].elements['chatbarText'].focus();
}


//pops out history window
function Pophistory() {
         newWin=window.open('index.php?page=allshout','shouthistory','height=500,width=490,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}

//pops out private window
function PopPshout(from,name,pchat) {
         newWin=window.open('index.php?page=Pshout&fromid='+from+'&toid='+name+'&pchat='+pchat,'PrivateShout','height=400,width=800,resizable=yes,scrollbars=yes,top=300,left=300');
         if (window.focus) {newWin.focus()}
}
function editup(id,uid){newWin=window.open('chatedit.php?action=edit&msgid='+id,'edit','height=300,width=490,resizable=yes,scrollbars=yes');if(window.focus){newWin.focus()}}

//pops out more smilies window
function PopMoreSmiles(form,name) {
         newWin=window.open('index.php?page=moresmiles&form='+form+'&text='+name,'moresmile','height=500,width=450,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}


//initiates the first data query
function receiveChatText() {
    if (httpReceiveChat.readyState == 4 || httpReceiveChat.readyState == 0) {
    httpReceiveChat.open("GET",GetChaturl + '?lastID=' + lastID + '&rand='+Math.floor(Math.random() * 1000000), true);
      httpReceiveChat.onreadystatechange = handlehHttpReceiveChat; 
    httpReceiveChat.send(null);
    }
}


//deals with the servers' reply to requesting new content
function handlehHttpReceiveChat() {

  if (httpReceiveChat.readyState == 4) {

     var results = document.getElementById("outputList");
     results.innerHTML = httpReceiveChat.responseText;

     setTimeout('receiveChatText();',30000); //executes the next data query in 4 seconds

  }
}


//stores a new comment on the server
function sendComment() {
    if (httpSendChat.readyState == 4 || httpSendChat.readyState == 0) {
    currentChatText = encodeURIComponent(document.forms['chatForm'].elements['chatbarText'].value);
    if (currentChatText != '') {
        currentName = encodeURIComponent(document.forms['chatForm'].elements['name'].value);
        currentUid = document.forms['chatForm'].elements['uid'].value;
        param = 'n='+ currentName+'&c='+ currentChatText+'&u='+ currentUid; 
        httpSendChat.open("POST", SendChaturl, true);
        httpSendChat.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    httpSendChat.onreadystatechange = handlehHttpSendChat;
    httpSendChat.send(param);
    document.forms['chatForm'].elements['chatbarText'].value = '';
    }
    } else {
        setTimeout('sendComment();',1000);
    }
}


//deals with the servers' reply to sending a comment
function handlehHttpSendChat(){if(httpSendChat.readyState==4){receiveChatText();}}


//does clever things to the input and submit
function checkStatus(focusState) {
    currentChatText = document.forms['chatForm'].elements['chatbarText'];
    oSubmit = document.forms['chatForm'].elements['submit'];
    if (currentChatText.value != '' || focusState == 'active') {
        oSubmit.disabled = false;
    } else {
        oSubmit.disabled = true;
    }
}

//initiates the XMLHttpRequest object
//as found here: http://www.webpasties.com/xmlHttpRequest
function getHTTPObject() {
  var xmlhttp;
  /*@cc_on
  @if (@_jscript_version >= 5)
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
  @else
  xmlhttp = false;
  @end @*/
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      xmlhttp = false;
    }
  }
  return xmlhttp;
}