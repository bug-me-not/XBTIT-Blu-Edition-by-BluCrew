<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    -- Seedbox Stats Block v1.00( part of Auto Show Seedbox Hack ) by DiemThuy Dec 2009 --
//
//    This file is part of xbtit DT FM.
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
?>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse23">High Speeds</a>
</h4>
    </div>
    <div id="collapse23" class="panel-collapse collapse in">
    <?php
    global $CURUSER,$TABLE_PREFIX,$btit_settings;

    if($CURUSER['view_torrents'] == 'yes')
    {
        $query = do_sqlquery("select ip FROM {$TABLE_PREFIX}seedboxip");
        $seedip = array();

        if(sql_num_rows($query) > 0)
        {
            while ($row = $query->fetch_row())
            {
                $seedip[] = $row[0];
            }

            $implodeS = implode(",",$seedip);

            $id = do_sqlquery("select DISTINCT(infohash) FROM {$TABLE_PREFIX}peers WHERE ip IN ('".$implodeS."')");
            $num = sql_num_rows($id);

            $rowt = $id->fetch_array();
            $od = do_sqlquery("select sum(upload_difference) as upload_difference FROM {$TABLE_PREFIX}peers WHERE ip IN ('".$implodeS."') AND upload_difference !='0'");

            $transferrateUP = 0;

            while ($row=$od->fetch_assoc())
            {
                if ($row["upload_difference"]>0)
                {
                    $transferrateUP += $row['upload_difference'];
                }
            }

            $transferrateUP = "".makesize(round(round($transferrateUP,$btit_settings['rinterval']),2))."";
        }
        else
        {
            $transferrateUP = "".makesize(0)."";
        }

        ?>

      <table class="lista" width="100%">
        <tr>
          <td align="center"><i class="fa fa-server fa-3x"></i></tr>
        <tr>
          <td align="center"><b>Seedbox Torrents</td></tr>
                    <tr><td align="center"><b><font color="red"><?php echo $num; ?></font></b></td>
        </tr>
        <tr>
          <td align="center"><b>Seedbox Current Max UP Speed</td></tr>
                        <tr><td align="center"><b><font color="red"><?php echo $transferrateUP; ?></font></b></td>
        </tr>
      </table>

      <table align="center" cellpadding="1" cellspacing="1" width="100%">
        <tr>
          <style>
            .thisclass {
              background-color: #41383C
            }

          </style>
          <script language="javascript">
            function change(color) {
              var el = event.srcElement
              if (el.tagName == "INPUT" && el.type == "button")
                event.srcElement.style.backgroundColor = color
            }

            function jumpto2(url) {
              window.location = url
            }

          </script>
          <td class="header" align="center">
            <input type="button" name="Button" class="btn btn-danger" value="SB Torrents" onClick="jumpto2('index.php?page=seedbox')">
          </td>
        </tr>
      </table>
      <?php
            }
            else
            {
                ?>
        <table class="lista" width="100%">
          <tr>
            <td>Access Restricted</td>
          </tr>
        </table>
        <?php
            }
            ?>
            </div>
          <div class="panel-footer">
          </div>
  </div>

