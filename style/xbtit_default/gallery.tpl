<!DOCTYPE html>
<html lang="en">
   <head>
      <title><tag:sitename /></title>
      <meta http-equiv="Page-Enter" content="blendTrans(Duration=0.3)" />
      <meta charset="<tag:charset />" />

      <link rel="stylesheet" href="gallery/style/style.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="css/floatbox.css" type="text/css" />

      <link src="jscript/tooltip.js" type="text/javascript" />
      <link src="jscript/floatbox.js" type="text/javascript" />
      <script type="text/javascript">
         var sitename="<tag:sitename />";
         var baseurl="<tag:baseurl />";
         var dimagedir="<tag:imagedir />";
         var charset="<tag:charset />";
         var requesturl="<tag:request_uri />";
         var bonus="<tag:bonus />";
         var username="<tag:username />";
         var userid="<tag:userid />";
         var userip="<tag:userip />";
      </script>
   </head>
   <body>
      <table class='main' border='0' cellpadding='0' cellspacing='0' width='100%'>
         <tr>
            <td class='embedded'>
               <table width='100%' border='1' cellspacing='0' cellpadding='10'>
                  <tr>
                     <td style="padding='4px; background= url(gallery/images/mainbox_bg.jpg) repeat-x left top'">
                        <strong>
                           <center>
                              <font color="#ffffff">
                                 <tag:sitename /> ->
                              </font>
                                  <tag:language.gallery16 />
                           </center>
                        </strong>
                     </td>
                  </tr>
                  <tr>
                     <td style="padding='4px; background= url(gallery/images/mainbox_bg.jpg) repeat-x left top'">
                        <table style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) left top' border='0' cellpadding='4' cellspacing='1' width='100%'>
                           <tr>
                              <td align="center">
                                 <form>
                                    <input type='button' value="<tag:language.gallery />" onclick="window.location.href='gallery.php'">
                                    <input type='button' value="<tag:language.gallery2 />" onclick="window.location.href='gallery_upload.php'">
                                    <input type='button' value="<tag:language.gallery4 />" onclick="'
                                    history.go(-1);return true;">
                                    <input type='button' value="<tag:language.gallery6 />" onclick="history.go(0)">
                                    <input type='button' value="<tag:language.gallery8 />" onclick="window.location.href='gallery_readme.php'">
                                    <input type='button' value="<tag:language.gallery10 />" onclick="window.close()">
                                 </form>
                              </td>
                           </tr>
                           <tr>
                              <td align="center">
                                 <tag:pagertop />
                              </td>
                           </tr>
                           <if:no_data>
                           <tr>
                              <td align="center">
                                 <p>
                                    <strong>
                                       <tag:language.gallery26 />
                                    </strong>
                                 </p>
                              </td>
                           </tr>
                           </if:no_data>
                           <if:has_data>
                              <table style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) left top' border='1' cellpadding='4' cellspacing='1' width='100%'>
                                 <tr>
                                    <td style='padding:4px; background: url(gallery/images/cellpic3.gif) left top' align='center' width='25%'>
                                       <strong>
                                          <tag:language.gallery27 />
                                       </strong>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/cellpic3.gif) left top' align='center' width='25%'>
                                       <strong>
                                          <tag:language.gallery28 />
                                       </strong>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/cellpic3.gif) left top' align='center' width='25%'>
                                       <strong>
                                          <tag:language.gallery29 />
                                       </strong>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/cellpic3.gif) left top' align='center' width='25%'>
                                       <strong>
                                          <tag:language.gallery30 />
                                       </strong>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/cellpic3.gif) left top' align='center' width='25%'>
                                       <strong>
                                          <tag:language.gallery31 />
                                       </strong>
                                    </td>
                                 <if:mod>
                                    <td style='padding:4px; background: url(gallery/images/cellpic3.gif) left top' align='center' width='25%'>
                                       <strong>
                                          <tag:language.gallery32 />
                                       </strong>
                                    </td>
                                 </if:mod>
                                 </tr>
                              <loop:images>
                                 <tr class='loopgal'>
                                    <td style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' align='center' width='25%'>
                                       <font color='#ffffff'>
                                          <tag:images.date />
                                       </font>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' align='center' width='25%'>
                                       <font color='#ffffff'>
                                          <tag:images.time />
                                       </font>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' align='center' width='25%'>
                                       <font color='#ffffff'>
                                          <a href='index.php?page=userdetails&amp;id=<tag:images.owner_id />'><span> <tag:images.owner /> </span></a>
                                       </font>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' align='center'>
                                       <a href='<tag:images.url />' border='0'>
                                          <font color='#ffffff'>
                                             <tag:images.name />
                                          </font>
                                       </a>
                                    </td>
                                    <td style='padding:4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' class='tcat' width='25%'>
                                       <a href="<tag:images.url />" rel='gallery.group'>
                                          <img src="<tag:images.url />" width='150' height='75' alt="<tag:images.name />" title="<tag:images.name />" class='borderimage' />
                                       </a>
                                    </td>
                                 <if:mod>
                                    <td style='padding: 4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' width='25%'>
                                       <form>
                                          <INPUT TYPE='button' VALUE="<tag:language.gallery33 />"	ONCLICK="window.location.href='?delete=<tag:images.image_id />'">
                                       </form>
                                    </td>
                                 </if:mod>
                              <!-- >
                                 loop data goes here.
                              -->
                                 </tr>
                              </loop:images>
                              </table>
                           </if:has_data>
                           <tr>
                              <td align="center">
                                 <tag:pagerbottom />
                              </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
      </table>
   </body>
</html>
