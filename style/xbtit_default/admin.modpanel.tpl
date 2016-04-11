<script type="text/javascript">

var amp=new sack();

function show_wait()
{
  document.getElementById('mod_panel').style.display='none';
  document.getElementById('loading').style.display='block';
}

function ShowUpdate()
{
  var mytext=amp.response + '';
  document.getElementById('mod_panel').style.display='block';
  document.getElementById('loading').style.display='none';
  document.getElementById('mod_panel').innerHTML = mytext;
}

function Show_ModPanel(idl)
{

  amp.resetData();
  amp.onLoading=show_wait;
  amp.requestFile='admin/admin.modpanel.php';
  amp.setVar('list',"'1'");
  amp.setVar('code','<tag:usercode />');
  amp.setVar('user','<tag:userid />');
  if (typeof(idl)!='undefined')
    {
    amp.setVar('current_id',arguments[0]);
    if (typeof(arguments[1])!='undefined')
     {
      amp.setVar('do',arguments[1]);
      if (arguments[1]==1)
        {
          var node=document.aut_list.elements;
          var post_el=new Array();
          for (var i=0; i<node.length; i++)
            {
              if (node[i].type=='checkbox')
                 amp.setVar(node[i].name,node[i].checked);
          }
      }
      else if (arguments[1]==2)
        {
          var node=document.aut_list.elements;
          var post_el=new Array();
          for (var i=0; i<node.length; i++)
            {
              if (node[i].type=='text')
              {
                 if (node[i].value=='')
                   {
                    alert('no empty field!');
                    return;
                 }
                 else
                     amp.setVar(node[i].name,node[i].value);
               }
          }
      }
    }
  }
  amp.onCompletion = ShowUpdate;
  amp.runAJAX();
}

</script>
<div id="loading" style="display:none;"><img src="images/ajax-loader.gif" alt="" title="ajax-loader" /></div>
<div id="mod_panel"></div>
<script type="text/javascript">Show_ModPanel();</script>
