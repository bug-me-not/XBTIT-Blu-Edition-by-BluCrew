<?php
/*************************************
Mustafa will refuse to answer any
question you ask. Except, he hates
hearing the same question three
times in a row. Ask him a question
three times in a row and he will
answer you. Fun!
Code by fatepower.
Fixed for btit 16-05-07
http://www.pantherabits.com
*************************************/

//require_once ("include/functions.php");
//require_once ("include/config.php");
if($btit_settings['fmhack_games']=='disabled')
{
  stderr("Closed",'The Games section is closed.');
  die();
}

//dbconn(false);
if ($CURUSER["view_news"]=="yes")
{
//standardheader("Evil Mustafa");
block_begin("Mustafa");
$mustout="";

$mustout.='<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Hoop Hooper -->
<!-- Rewritten and modded by: fatepower -->
<!-- Web Site: http://www.pantherabits.com -->
<!-- Begin
var refusalarray = new Array(
"I\'ll Never Tell You!",
"I spit at the question!  Pptt!",
"Go To Hell, Powers!",
"I will take it to the grave with me!",
"Kiss my ass!",
"You can torture me if you like, I will never tell!",
"I will never tell you!",
"I cannot tell you!",
"My lips are sealed shut, you can\'t open them!"
); // No comma after last item on line above!

var answerarray = new Array(
"Damn, three times.  Yes! That\'s the answer!",
"No way.  There\'s your answer, you happy now?",
"Maybe.  Are you satisfied?",
"Yes, yes, of course!",
"Without a doubt!",
"Yeah, I think so.",
"Probably, why do you care though?"
); // No comma after last item on line above!
var num1, num2, tries = 0;

function ask(frm) {
if (frm.question.value == "") {
alert("Please type your question.");
frm.question.focus();
return "";
}
rand1 = Math.round( (refusalarray.length - 1) * Math.random());
rand2 = Math.round( (answerarray.length - 1) * Math.random());
tries++;
switch (tries) {
case 1 :
case 2 : return refusalarray[rand1];
         break;
case 3 : return answerarray[rand2];
         break;
case 4 : tries = 0;
         frm.question.value = frm.answer.value = "";
         return "";
         break;
   }
}
//  End -->
</script>';

$mustout.='<br/> <br/> <br/><center>
<img src="images/mustafa.gif" width=122 height=167>
<p>
<h2>Ask Mustafa</h2>
<p>

<form name=mustafaform>
Your Question:  <input type=text name=question size=50>
<p>
<input type=button value="Ask Mustafa" onClick="this.form.answer.value = ask(this.form);">
<p>
Mustafa\'s Reply: <input type=text name=answer size=50>
</form>
</center>';
//<!-- fatepower note; Script Size is 2.32 KB -->
//</html>
//<?php
$tpl->set("main_content",$mustout);
}else{
	stderr("ERROR","SORRY, YOUR NOT AUTHORISED...");
    //err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
        }
block_end();

?>
