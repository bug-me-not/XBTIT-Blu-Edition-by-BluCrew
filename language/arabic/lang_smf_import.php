<?php

// smf_import.php language file

$lang[0]='نعم';
$lang[1]='لا';
$lang[2]='<center><u><strong><font size="4" face="Arial">المرحلة الاولى: المتطلبات الاولية</font></strong></u></center><br />';
$lang[3]='<center><strong><font size="2" face="Arial">هل ملفات منتديات SMF موجودة فل مجلد SMF<font color="';
$lang[4]='">&nbsp;&nbsp;&nbsp; ';
$lang[5]='</font></center></strong>';
$lang[6]='<br /><center>Please <a target="_new" href="http://www.simplemachines.org/download/">حمل منتديات SMF</a>ثم ارفعها الى مجلد SMF<br />اذا لم يكن لديك مجلد SMF قم بعمل مجلد داخل مجلد التراكر باسم smf<br />ثم ارفع المنتدى اليها<br /><br />'; // p at end is a lowercase p for use with $lang[8]
$lang[7]='<br /><center>P'; // P at end is an uppercase p for use with $lang[8]
$lang[8]='ركب المنتدى<a target="_new" href="smf/install.php">بالكبس هنا</a>*<br /><br /><strong>* الرجاء استخدام معلومات قاعدة البيانات التي تستخدم بالتراكر<br />يمكن استخدام اي بادئة تريد لكن لا تستخدم نفس بادئة التراكر<br />)<br /><br />';
$lang[9]='<font color="#0000FF" size="3">يمكنك تحديث هذه الصفحة بعد عمل المطلوب</font></strong></center>';
$lang[10]='<center><strong>هل تم تركيب SMF؟<font color="';
$lang[11]='الملفات غير موجودة';
$lang[12]='الملف موجود لكن لا يمكن الكتابة عليه';
$lang[13]='<center><strong>هل ملفات smf الانجلزية موجودة؟<font color="';
$lang[14]='<center><strong>smf.sql هل هذا الملف موجود في مجلد قاعدة البيانات<font color="';
$lang[15]='<br /><center><strong>ملف اللغة';
$lang[16]=')<br />غير موجود الرجاء التاكد <font color="#FF0000"><u>ان كل ملفات SMF</u></font> تم رفعها<br /><br />';
$lang[17]=')<br />لا يمكن الكتابة عليه <font color="#FF0000"><u>الرجاء اعطاء هذا الملف صلاحية 777</u></font><br /><br />';
$lang[18]='<br /><center><strong>smf.sql الملف ضائع <font color="#FF0000"><u>الرجاء التاكد ان هذا الملف موجودة في مجلد "sql" </u></font><br />(عليه ان يكون موجود في توزيع اكس بتيت ايضاً!)<br /><br />';
$lang[19]='<br /><center>كل المتطلبات موجودة <a href="';
$lang[20]='">اكبس هنا للمتابعة</a></center>';
$lang[21]='<center><u><strong><font size="4" face="Arial">المرحلة الثانية : التثبيت الاولي</font></strong></u></center><br />';
$lang[22]='<center>بما ان لدينا كل شياء فلنقم بعمل بعض التعديلات على قاعدة البيانات ومطابقة التراكر</center><br />';
$lang[23]='<center><form name="db_pwd" action="smf_import.php" method="GET">ادخل كلمة سر قاعدة البينات:&nbsp;<input name="pwd" size="20" /><br />'."\n".'<br />."\n".<strong>رجاء <input type="submit" name="confirm" value="yes" size="20" /> للاستمرار</strong><input type="hidden" name="act" value="init_setup" /></form></center>';
$lang[24]='<center><u><strong><font size="4" face="Arial">المرحلة الثالثة - استيراد اعضاء التراكر</font></strong></u></center><br />';
$lang[25]='<center>بما ان تعديلات قاعدت البيانات كانت جيدة لنقم بجلب الاعضاء الى المنتدى من التراكر<br />هذا قد ياخذ وقت على حسب عدد اعضاء التراكر عندك<br /><br /><br /><strong>رجاء <a href="'.$_SERVER['PHP_SELF'].'?act=member_import&amp;confirm=yes">اكبس هنا</a> للاستمرار</center>';
$lang[26]='<center><u><strong><font size="4" face="Arial">عذراً</font></strong></u></center><br />';
$lang[27]='<center>هذه الشفرة تستعمل مرة واحدة وقد تم اقفالها، اذهب الى منتدى الدعم لمعرفة طريقة الفتح</center>';
$lang[28]='<center><br /><strong><font color="#FF0000"><br />';
$lang[29]='</strong></font> تم انشاء حسابات المنتدى <a href="'.$_SERVER['PHP_SELF'].'?act=import_forum&amp;confirm=no">اكبس هنا للاستمرار</a></center>';
$lang[30]='<center><u><strong><font size="4" face="Arial">الخطوة الاخيرة استيراد المنتدى والمشاركات</font></strong></u></center><br />';
$lang[31]='<center>هذه هي المرحلة الاخيرة سوف يتم استيراد المنتدى والمواضيع من المتتبع<br />سوف يتم استيرادها الى مجموعة تدعى "My BTI import",<br />رجاء <a href="'.$_SERVER['PHP_SELF'].'?act=import_forum&amp;confirm=yes">اكبس هنا</a> للمتابعة</center>';
$lang[32]='<center><u><strong><font size="4" face="Arial">تم الاستيراد بنجاح</font></strong></u></center><br />';
$lang[33]='<center><font face="Arial" size="2">رجاء <a target="_new" href="smf/index.php?action=login">قم بتسجيل الدخول لمنتداك</a> باستخدام نفس معلومات التراكر<br />the <strong>قسم الاشراف</strong> ثم حدد <strong>ادارة المنتديات</strong> وقم بتفعيل<br /><strong>Find and repair any errors.</strong> ثم اتبعها <strong>Recount all forum totals<br />and statistics.</strong> لتحسين الاستيراد واعاد عد المواضيع<br /><br /><strong><font color="#0000FF">المنتدى جاهز للاستعمال</font></strong></font></center>';
$lang[34]='<center><u><strong><font size="4" face="Arial" color="#FF0000">ERROR!</font></strong></u></center><br />'."\n".'<br />'."\n".'<center><font face="Arial" size="3">لقد كتبت كلمة سر خطاء او انك لست المالك لهذا المنتدى<br />'."\n".'Please note that your IP has been logged.</font></center>';
$lang[35]='</body>'."\n".'</html>'."\n";
$lang[36]='<center>لم نتمكن من الكتابة الى:<br /><br /><b>';
$lang[37]='</b><br /><br />الرجاء التاكد من انه يمكن الكتابة على الملف ثم اعد الكرة</center>';
$lang[38]='<center><br /><font color="red" size="4"><b>منع الوصول</b></font></center>';
?>