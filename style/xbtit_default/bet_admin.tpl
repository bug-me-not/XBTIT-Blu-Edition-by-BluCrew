<if:admin_access>
<div align=center>
<br />
<img src='images/betting.png' alt='<tag:language.SB_BET />' title='<tag:language.SB_BETTING />' width='400' height='125' />
<h1><tag:language.SB_ADMIN /></h1>
<table align='center' class='main' width='200' cellspacing='0' cellpadding='5' border='0'><br />
  <tr>
    <td align='center' class='navigation'><a href='index.php?page=bet'><tag:language.SB_CURR_BETS /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betgameinfo'><tag:language.SB_BET_INFO /></a></td>
    <td align='center' class='navigation'><a href='index.php?page=betfinish'><tag:language.SB_END_BETS /></a></td>
  </tr>
</table>


<form method='post' action='index.php?page=bettakenew'>
  <table align='center' cellpadding='5'>
    <tr>
      <td class='header'><tag:language.SB_BET_TITLE />:</td><td class='lista'><input type='text' name='heading' size='52' /></td>
    </tr>
    <tr>
      <td class='header'><i><tag:language.SB_BETTING_ON />:</i></td><td class='lista'><input type='text' name='undertext' size='52' value='<tag:language.SB_ENTER_WAGER />' /></td>
    </tr>
    <tr>
      <td class='header' align='center'><tag:language.SB_ENDTIME /></td>
      <td class=lista>
        <select name='endday'>
          <option value='na'>----</option>
          <option value='1'>1st</option>
          <option value='2'>2nd</option>
          <option value='3'>3rd</option>
          <option value='4'>4th</option>
          <option value='5'>5th</option>
          <option value='6'>6th</option>
          <option value='7'>7th</option>
          <option value='8'>8th</option>
          <option value='9'>9th</option>
          <option value='10'>10th</option>
          <option value='11'>11th</option>
          <option value='12'>12th</option>
          <option value='13'>13th</option>
          <option value='14'>14th</option>
          <option value='15'>15th</option>
          <option value='16'>16th</option>
          <option value='17'>17th</option>
          <option value='18'>18th</option>
          <option value='19'>19th</option>
          <option value='20'>20th</option>
          <option value='21'>21st</option>
          <option value='22'>22nd</option>
          <option value='23'>23rd</option>
          <option value='24'>24th</option>
          <option value='25'>25th</option>
          <option value='26'>26th</option>
          <option value='27'>27th</option>
          <option value='28'>28th</option>
          <option value='29'>29th</option>
          <option value='30'>30th</option>
          <option value='31'>31st</option>
        </select>

        <select name='endmonth'>
          <option value='na'>--------</option>
          <option value='1'>January</option>
          <option value='2'>February</option>
          <option value='3'>March</option>
          <option value='4'>April</option>
          <option value='5'>May</option>
          <option value='6'>June</option>
          <option value='7'>July</option>
          <option value='8'>August</option>
          <option value='9'>Sepember</option>
          <option value='10'>October</option>
          <option value='11'>November</option>
          <option value='12'>December</option>
        </select>

        <select name='endyear'>
          <option value='na'>----</option>
          <option value='2011'>2011</option>
          <option value='2012'>2012</option>
          <option value='2013'>2013</option>
          <option value='2014'>2014</option>
          <option value='2015'>2015</option>
          <option value='2016'>2016</option>
          <option value='2017'>2017</option>
          <option value='2018'>2018</option>
          <option value='2019'>2019</option>
          <option value='2020'>2020</option>
        </select>
        
        &nbsp;&nbsp;<b><span style='font-size:12pt'>at</span></b>&nbsp;&nbsp;

        <select name='endhour'>
          <option value='na'>----</option>
          <option value='00'>00</option>
          <option value='01'>01</option>
          <option value='02'>02</option>
          <option value='03'>03</option>
          <option value='04'>04</option>
          <option value='05'>05</option>
          <option value='06'>06</option>
          <option value='07'>07</option>
          <option value='08'>08</option>
          <option value='09'>09</option>
          <option value='10'>10</option>
          <option value='11'>11</option>
          <option value='12'>12</option>
          <option value='13'>13</option>
          <option value='14'>14</option>
          <option value='15'>15</option>
          <option value='16'>16</option>
          <option value='17'>17</option>
          <option value='18'>18</option>
          <option value='19'>19</option>
          <option value='20'>20</option>
          <option value='21'>21</option>
          <option value='22'>22</option>
          <option value='23'>23</option>
        </select>

        &nbsp;&nbsp;<b><span style='font-size:12pt'>:</span></b>&nbsp;&nbsp;

        <select name='endmin'>
          <option value='na'>----</option>
          <option value='00'>00</option>
          <option value='01'>01</option>
          <option value='02'>02</option>
          <option value='03'>03</option>
          <option value='04'>04</option>
          <option value='05'>05</option>
          <option value='06'>06</option>
          <option value='07'>07</option>
          <option value='08'>08</option>
          <option value='09'>09</option>
          <option value='10'>10</option>
          <option value='11'>11</option>
          <option value='12'>12</option>
          <option value='13'>13</option>
          <option value='14'>14</option>
          <option value='15'>15</option>
          <option value='16'>16</option>
          <option value='17'>17</option>
          <option value='18'>18</option>
          <option value='19'>19</option>
          <option value='20'>20</option>
          <option value='21'>21</option>
          <option value='22'>22</option>
          <option value='23'>23</option>
          <option value='24'>24</option>
          <option value='25'>25</option>
          <option value='26'>26</option>
          <option value='27'>27</option>
          <option value='28'>28</option>
          <option value='29'>29</option>
          <option value='30'>30</option>
          <option value='31'>31</option>
          <option value='32'>32</option>
          <option value='33'>33</option>
          <option value='34'>34</option>
          <option value='35'>35</option>
          <option value='36'>36</option>
          <option value='37'>37</option>
          <option value='38'>38</option>
          <option value='39'>39</option>
          <option value='40'>40</option>
          <option value='41'>41</option>
          <option value='42'>42</option>
          <option value='43'>43</option>
          <option value='44'>44</option>
          <option value='45'>45</option>
          <option value='46'>46</option>
          <option value='47'>47</option>
          <option value='48'>48</option>
          <option value='49'>49</option>
          <option value='50'>50</option>
          <option value='51'>51</option>
          <option value='52'>52</option>
          <option value='53'>53</option>
          <option value='54'>54</option>
          <option value='55'>55</option>
          <option value='56'>56</option>
          <option value='57'>57</option>
          <option value='58'>58</option>
          <option value='59'>59</option>
        </select>
       &nbsp;&nbsp;
      </td>
    </tr>
    <tr>
      <td class='header'><tag:language.SB_ORDERING /></td>
      <td class='lista'><input type='radio' name='sort' value='1' checked='checked' /><tag:language.SB_BY_ID /><input type='radio' name='sort' value='0' /><tag:language.SB_BY_ODDS /></td>
    </tr>
    <tr>
      <td colspan='2' align='center'><input  type='submit' value='<tag:language.SB_SUBMIT />' /></td>
    </tr>
  </table>
</form>

<if:result>
  <br /><br />
  <table align='center' cellpadding='5'>
    <tr>
      <td class='header'><b><tag:language.SB_CREATOR /></b></td>
      <td class='header'><b><tag:language.SB_ENDTIME /></b></td>
      <td class='header'><b><tag:language.SB_BET_TITLE /></b></td>
      <td class='header'><b><tag:language.SB_BETTING_ON /></b></td>
      <td class='header'><b><tag:language.SB_SET_ACTIVE /></b></td>
      <td class='header'><b><tag:language.SB_ADD_OPTIONS /></b></td>
      <td class='header'><b><tag:language.EDIT /></b></td>
    </tr>
    <loop:loop1>
      <tr>
        <td class='lista' align='left'><tag:loop1[].creator /></td>
        <td class='lista' align='center'><tag:loop1[].open_italics /><tag:loop1[].endtime /><tag:loop1[].close_italics /></td>
        <td class='lista' align='center'><tag:loop1[].heading /></td>
        <td class='lista' align='center'><i><tag:loop1[].undertext /></i></td>
        <td class='lista' align='center'><tag:loop1[].link /></td>
        <td class='lista' align='center'><a href='index.php?page=betoption&id=<tag:loop1[].id />'><tag:language.SB_ADD_OPTIONS /></a></td>
        <td class='lista' align='center'><a href='index.php?page=betopttwee&id=<tag:loop1[].id />'><tag:language.EDIT /></a></td>
      </tr>
    </loop:loop1>
  </table><br /><br />
</if:result>

</div>
</if:admin_access>