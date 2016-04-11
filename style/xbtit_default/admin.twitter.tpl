<div align=center>
<if:firstrun>
  <br /><span style='font-size:10pt'><tag:language.TWIT_AUTH_1 /> <a href='<tag:registerURL />' target='_blank'><b><tag:language.TWIT_AUTH_2 /></b></a> <tag:language.TWIT_AUTH_3 />:</span><br /><br />

  <img src='<tag:BASEURL />/images/twit_example.png'><br /><br />

  <span style='font-size:10pt'><tag:language.TWIT_AUTH_4 />.</span>

  <form method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=twitter'>
  <input type='text' name='pin' value='' size='7' maxlength='7' />
  <input type=submit name=submit value="<tag:language.TWIT_SUBMIT />" />
  </form>
<else:firstrun>
</if:firstrun>
</div>