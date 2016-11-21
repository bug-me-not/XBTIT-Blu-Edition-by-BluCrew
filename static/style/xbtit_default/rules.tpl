<!-- rules.PHP Template - Just plain HTML and CSS + Template TAGS-->
<if:rules_exists>
  <div style="float:left; width:100%; text-align:left;padding-left:10px;padding-top:10px;">

  <div style="float:left; text-weight:bold;">
  
  <loop:rules>
  <b><tag:rules[].rules_group_title /></b><br/>
  <tag:rules[].rules_text />
  </loop:rules>

	
  </div>
  </div>
  <else:rules_exists>
</if:rules_exists>
