<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
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


// fetch page with right template
switch ($pageID) {

   // for admin page we will display page with header and only left column (for menu)
   case 'admin':
   case 'usercp':
   stdfoot(false,false,true);
   break;

   // for torrents and forums pages we will display page with header and no columns (for full view)
   case 'torrents':
   case 'torrent-details':
   case 'forum':
   case 'upload':
   case 'userdetails':
   case 'viewrequests':
   case 'requests':
   case 'reqdetails':
   case 'viewexpected':
   case 'expected':
   case 'expectdetails':
   case 'faq':
   case 'peers':
   case 'seedbox':
   case 'staffchecks':
      stdfoot(false,true,false,true,true);
   break;

   // if popup enabled then we display the page without header and no columns, else full page
   case 'comment':
   case 'torrent_history':
   case 'peers':
   case 'donation_options':
      stdfoot(($GLOBALS["usepopup"]?false:true));
   break;

   // we display the page without header and no columns
   case 'allshout':
   //start private shout
   case 'allPshout':
   case 'Pshout':
   //end private shout
   case 'moresmiles':
      stdfoot(false);
   break;

   //full screen chat
   case 'modules':
   //end full screen chat
      stdfoot(false,true,false,true,true);
   break;
   // full page
   default:
      stdfoot();
   break;
   }


   ?>
