<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//   SPORT BETTING HACK , orginal TBDEV 2009 by Soft & Bigjoos 
//   XBTIT conversion by DiemThuy , April 2010
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

if (!defined("IN_BTIT"))
      die("non direct access!");


require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

if ($CURUSER["admin_access"]=="no")
    stderr($language["ERROR"], $language["SB_ACC_DEN"]);

$id = isset($_GET['id']) && is_valid_id($_GET['id']) ? $_GET['id'] : 0;

$betopttweetpl = new bTemplate();
$betopttweetpl->set("language", $language);
$betopttweetpl->set("id",htmlspecialchars($id));

$a = get_result("SELECT * FROM {$TABLE_PREFIX}betgames where id =".sqlesc($id),true,$btit_settings["cache_duration"]);
$b = $a[0];

$expireday=date("j",$b["endtime"]);
$expiremonth=date("n",$b["endtime"]);
$expireyear=date("Y",$b["endtime"]);
$expirehour=date("H",$b["endtime"]);
$expiremin=date("i",$b["endtime"]);


$selectbox="<select name='endday'>
          <option value='na'>----</option>
          <option value='1'".(($expireday==1)?" selected='yes'":"").">1st</option>
          <option value='2'".(($expireday==2)?" selected='yes'":"").">2nd</option>
          <option value='3'".(($expireday==3)?" selected='yes'":"").">3rd</option>
          <option value='4'".(($expireday==4)?" selected='yes'":"").">4th</option>
          <option value='5'".(($expireday==5)?" selected='yes'":"").">5th</option>
          <option value='6'".(($expireday==6)?" selected='yes'":"").">6th</option>
          <option value='7'".(($expireday==7)?" selected='yes'":"").">7th</option>
          <option value='8'".(($expireday==8)?" selected='yes'":"").">8th</option>
          <option value='9'".(($expireday==9)?" selected='yes'":"").">9th</option>
          <option value='10'".(($expireday==10)?" selected='yes'":"").">10th</option>
          <option value='11'".(($expireday==11)?" selected='yes'":"").">11th</option>
          <option value='12'".(($expireday==12)?" selected='yes'":"").">12th</option>
          <option value='13'".(($expireday==13)?" selected='yes'":"").">13th</option>
          <option value='14'".(($expireday==14)?" selected='yes'":"").">14th</option>
          <option value='15'".(($expireday==15)?" selected='yes'":"").">15th</option>
          <option value='16'".(($expireday==16)?" selected='yes'":"").">16th</option>
          <option value='17'".(($expireday==17)?" selected='yes'":"").">17th</option>
          <option value='18'".(($expireday==18)?" selected='yes'":"").">18th</option>
          <option value='19'".(($expireday==19)?" selected='yes'":"").">19th</option>
          <option value='20'".(($expireday==20)?" selected='yes'":"").">20th</option>
          <option value='21'".(($expireday==21)?" selected='yes'":"").">21st</option>
          <option value='22'".(($expireday==22)?" selected='yes'":"").">22nd</option>
          <option value='23'".(($expireday==23)?" selected='yes'":"").">23rd</option>
          <option value='24'".(($expireday==24)?" selected='yes'":"").">24th</option>
          <option value='25'".(($expireday==25)?" selected='yes'":"").">25th</option>
          <option value='26'".(($expireday==26)?" selected='yes'":"").">26th</option>
          <option value='27'".(($expireday==27)?" selected='yes'":"").">27th</option>
          <option value='28'".(($expireday==28)?" selected='yes'":"").">28th</option>
          <option value='29'".(($expireday==29)?" selected='yes'":"").">29th</option>
          <option value='30'".(($expireday==30)?" selected='yes'":"").">30th</option>
          <option value='31'".(($expireday==31)?" selected='yes'":"").">31st</option>
        </select>

        <select name='endmonth'>
          <option value='na'>--------</option>
          <option value='1'".(($expiremonth==1)?" selected='yes'":"").">January</option>
          <option value='2'".(($expiremonth==2)?" selected='yes'":"").">February</option>
          <option value='3'".(($expiremonth==3)?" selected='yes'":"").">March</option>
          <option value='4'".(($expiremonth==4)?" selected='yes'":"").">April</option>
          <option value='5'".(($expiremonth==5)?" selected='yes'":"").">May</option>
          <option value='6'".(($expiremonth==6)?" selected='yes'":"").">June</option>
          <option value='7'".(($expiremonth==7)?" selected='yes'":"").">July</option>
          <option value='8'".(($expiremonth==8)?" selected='yes'":"").">August</option>
          <option value='9'".(($expiremonth==9)?" selected='yes'":"").">Sepember</option>
          <option value='10'".(($expiremonth==10)?" selected='yes'":"").">October</option>
          <option value='11'".(($expiremonth==11)?" selected='yes'":"").">November</option>
          <option value='12'".(($expiremonth==12)?" selected='yes'":"").">December</option>
        </select>

        <select name='endyear'>
          <option value='na'>----</option>
          <option value='2012'".(($expireyear==2012)?" selected='yes'":"").">2012</option>
          <option value='2013'".(($expireyear==2013)?" selected='yes'":"").">2013</option>
          <option value='2014'".(($expireyear==2014)?" selected='yes'":"").">2014</option>
          <option value='2015'".(($expireyear==2015)?" selected='yes'":"").">2015</option>
          <option value='2016'".(($expireyear==2016)?" selected='yes'":"").">2016</option>
          <option value='2017'".(($expireyear==2017)?" selected='yes'":"").">2017</option>
          <option value='2018'".(($expireyear==2018)?" selected='yes'":"").">2018</option>
          <option value='2019'".(($expireyear==2019)?" selected='yes'":"").">2019</option>
          <option value='2020'".(($expireyear==2020)?" selected='yes'":"").">2020</option>
          <option value='2021'".(($expireyear==2021)?" selected='yes'":"").">2021</option>
        </select>
        
        &nbsp;&nbsp;<b><span style='font-size:12pt'>at</span></b>&nbsp;&nbsp;

        <select name='endhour'>
          <option value='na'>----</option>
          <option value='00'".(($expirehour=="00")?" selected='yes'":"").">00</option>
          <option value='01'".(($expirehour=="01")?" selected='yes'":"").">01</option>
          <option value='02'".(($expirehour=="02")?" selected='yes'":"").">02</option>
          <option value='03'".(($expirehour=="03")?" selected='yes'":"").">03</option>
          <option value='04'".(($expirehour=="04")?" selected='yes'":"").">04</option>
          <option value='05'".(($expirehour=="05")?" selected='yes'":"").">05</option>
          <option value='06'".(($expirehour=="06")?" selected='yes'":"").">06</option>
          <option value='07'".(($expirehour=="07")?" selected='yes'":"").">07</option>
          <option value='08'".(($expirehour=="08")?" selected='yes'":"").">08</option>
          <option value='09'".(($expirehour=="09")?" selected='yes'":"").">09</option>
          <option value='10'".(($expirehour=="10")?" selected='yes'":"").">10</option>
          <option value='11'".(($expirehour=="11")?" selected='yes'":"").">11</option>
          <option value='12'".(($expirehour=="12")?" selected='yes'":"").">12</option>
          <option value='13'".(($expirehour=="13")?" selected='yes'":"").">13</option>
          <option value='14'".(($expirehour=="14")?" selected='yes'":"").">14</option>
          <option value='15'".(($expirehour=="15")?" selected='yes'":"").">15</option>
          <option value='16'".(($expirehour=="16")?" selected='yes'":"").">16</option>
          <option value='17'".(($expirehour=="17")?" selected='yes'":"").">17</option>
          <option value='18'".(($expirehour=="18")?" selected='yes'":"").">18</option>
          <option value='19'".(($expirehour=="19")?" selected='yes'":"").">19</option>
          <option value='20'".(($expirehour=="20")?" selected='yes'":"").">20</option>
          <option value='21'".(($expirehour=="21")?" selected='yes'":"").">21</option>
          <option value='22'".(($expirehour=="22")?" selected='yes'":"").">22</option>
          <option value='23'".(($expirehour=="23")?" selected='yes'":"").">23</option>
        </select>

        &nbsp;&nbsp;<b><span style='font-size:12pt'>:</span></b>&nbsp;&nbsp;

        <select name='endmin'>
          <option value='na'>----</option>
          <option value='00'".(($expiremin=="00")?" selected='yes'":"").">00</option>
          <option value='01'".(($expiremin=="01")?" selected='yes'":"").">01</option>
          <option value='02'".(($expiremin=="02")?" selected='yes'":"").">02</option>
          <option value='03'".(($expiremin=="03")?" selected='yes'":"").">03</option>
          <option value='04'".(($expiremin=="04")?" selected='yes'":"").">04</option>
          <option value='05'".(($expiremin=="05")?" selected='yes'":"").">05</option>
          <option value='06'".(($expiremin=="06")?" selected='yes'":"").">06</option>
          <option value='07'".(($expiremin=="07")?" selected='yes'":"").">07</option>
          <option value='08'".(($expiremin=="08")?" selected='yes'":"").">08</option>
          <option value='09'".(($expiremin=="09")?" selected='yes'":"").">09</option>
          <option value='10'".(($expiremin=="10")?" selected='yes'":"").">10</option>
          <option value='11'".(($expiremin=="11")?" selected='yes'":"").">11</option>
          <option value='12'".(($expiremin=="12")?" selected='yes'":"").">12</option>
          <option value='13'".(($expiremin=="13")?" selected='yes'":"").">13</option>
          <option value='14'".(($expiremin=="14")?" selected='yes'":"").">14</option>
          <option value='15'".(($expiremin=="15")?" selected='yes'":"").">15</option>
          <option value='16'".(($expiremin=="16")?" selected='yes'":"").">16</option>
          <option value='17'".(($expiremin=="17")?" selected='yes'":"").">17</option>
          <option value='18'".(($expiremin=="18")?" selected='yes'":"").">18</option>
          <option value='19'".(($expiremin=="19")?" selected='yes'":"").">19</option>
          <option value='20'".(($expiremin=="20")?" selected='yes'":"").">20</option>
          <option value='21'".(($expiremin=="21")?" selected='yes'":"").">21</option>
          <option value='22'".(($expiremin=="22")?" selected='yes'":"").">22</option>
          <option value='23'".(($expiremin=="23")?" selected='yes'":"").">23</option>
          <option value='24'".(($expiremin=="24")?" selected='yes'":"").">24</option>
          <option value='25'".(($expiremin=="25")?" selected='yes'":"").">25</option>
          <option value='26'".(($expiremin=="26")?" selected='yes'":"").">26</option>
          <option value='27'".(($expiremin=="27")?" selected='yes'":"").">27</option>
          <option value='28'".(($expiremin=="28")?" selected='yes'":"").">28</option>
          <option value='29'".(($expiremin=="29")?" selected='yes'":"").">29</option>
          <option value='30'".(($expiremin=="30")?" selected='yes'":"").">30</option>
          <option value='31'".(($expiremin=="31")?" selected='yes'":"").">31</option>
          <option value='32'".(($expiremin=="32")?" selected='yes'":"").">32</option>
          <option value='33'".(($expiremin=="33")?" selected='yes'":"").">33</option>
          <option value='34'".(($expiremin=="34")?" selected='yes'":"").">34</option>
          <option value='35'".(($expiremin=="35")?" selected='yes'":"").">35</option>
          <option value='36'".(($expiremin=="36")?" selected='yes'":"").">36</option>
          <option value='37'".(($expiremin=="37")?" selected='yes'":"").">37</option>
          <option value='38'".(($expiremin=="38")?" selected='yes'":"").">38</option>
          <option value='39'".(($expiremin=="39")?" selected='yes'":"").">39</option>
          <option value='40'".(($expiremin=="40")?" selected='yes'":"").">40</option>
          <option value='41'".(($expiremin=="41")?" selected='yes'":"").">41</option>
          <option value='42'".(($expiremin=="42")?" selected='yes'":"").">42</option>
          <option value='43'".(($expiremin=="43")?" selected='yes'":"").">43</option>
          <option value='44'".(($expiremin=="44")?" selected='yes'":"").">44</option>
          <option value='45'".(($expiremin=="45")?" selected='yes'":"").">45</option>
          <option value='46'".(($expiremin=="46")?" selected='yes'":"").">46</option>
          <option value='47'".(($expiremin=="47")?" selected='yes'":"").">47</option>
          <option value='48'".(($expiremin=="48")?" selected='yes'":"").">48</option>
          <option value='49'".(($expiremin=="49")?" selected='yes'":"").">49</option>
          <option value='50'".(($expiremin=="50")?" selected='yes'":"").">50</option>
          <option value='51'".(($expiremin=="51")?" selected='yes'":"").">51</option>
          <option value='52'".(($expiremin=="52")?" selected='yes'":"").">52</option>
          <option value='53'".(($expiremin=="53")?" selected='yes'":"").">53</option>
          <option value='54'".(($expiremin=="54")?" selected='yes'":"").">54</option>
          <option value='55'".(($expiremin=="55")?" selected='yes'":"").">55</option>
          <option value='56'".(($expiremin=="56")?" selected='yes'":"").">56</option>
          <option value='57'".(($expiremin=="57")?" selected='yes'":"").">57</option>
          <option value='58'".(($expiremin=="58")?" selected='yes'":"").">58</option>
          <option value='59'".(($expiremin=="59")?" selected='yes'":"").">59</option>
        </select>
       &nbsp;&nbsp;";

$betopttweetpl->set("selectbox",$selectbox);
$betopttweetpl->set("heading",htmlspecialchars($b['heading']));
$betopttweetpl->set("undertext",htmlspecialchars($b['undertext']));
$betopttweetpl->set("id2",$b['id']);

?>