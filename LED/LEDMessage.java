//////////////////////////////////////////////////////////////////
//  LEDMessage.java   -- LED Sign V2.5
//
//  The class that takes care of parsing the message,
//  storage and retrieval of the message data structure.
//
//  Revisions:
//     V2.7: See "Revisions" doc for more info
//
//     V2.5: Fixed all known bugs in previous versions!  Added
//           the new feature of ledsize, which allows the user
//           to specify in pixels how big the LED's (1-4).
//           Thanks to Robert B. Denny (rdenny@dc3.com) for
//           code and input!
//           Modified Dec 20-26, 1995
//
//     V2.0beta: Modified V1.0 to comply with Pre-Beta java.
//               A problem with delay causes a jerky display.
//               Modified Oct 20 - 29, 1995
// 
//     V1.0: Written July 31 - August 4, 1995
//
//  by Darrick Brown
//     dbrown@cs.hope.edu
//     http://www.cs.hope.edu/~dbrown/
//
//  © Copyright 1995
//////////////////////////////////////////////////////////////////

import java.io.*;
import java.util.*;
import FuncInfo;
import Letters;
import Index;


//////////////////////////////////////////////////////////////////
// Had to call it LEDMessage instead of Message.  Seems as 
// though class Message is already used :(
//////////////////////////////////////////////////////////////////
class LEDMessage
{
   int letcol[];
   boolean msg[][];
   FuncInfo fi;
   int h,w;
   int WIDTH,HEIGHT,TOTAL;
   Letters let;
   Index index;

   //////////////////////////////////////////////////////////////////
   // The constructor
   // set up some variables that we need
   public LEDMessage(int height, int width, Letters l)
   {
      h = height;
      w = width;
      HEIGHT = 5*h;
      WIDTH = 5*w;
      let = l;
   }

   //////////////////////////////////////////////////////////////////
   // Set the messege for the current text
   void setmsg(FuncInfo f)
   {
      int a,b;
      int i,j,k;
      int p;
      int len;
      char c;

      fi = f;

      // Find the length of the text in "LED's"
      len = 0;
      for(i=0;i<fi.text.length();i++)
      {
         len += (let.getLetter(fi.text.charAt(i))).width+1;
      }

      // Can we center the text?
      if(fi.centered && len <= w)
      {
         // Yes! Calculate the centered text.
         a = w;
         a = a - len;
         a = a/2;
         fi.startspace = a;
         fi.endspace = a;
         if(a*2 < w)
            fi.startspace++;  // integer division by 2 can only have an error of 1
      }

      // TOTAL = total length of message (white space included)
      TOTAL = len+fi.startspace+fi.endspace;

      // The message in boolean (LED) format structure
      msg = new boolean[TOTAL][h];

      // Make sure the new message is empty to start
      for(i = 0; i < TOTAL; i++)
         for(j = 0; j < h; j++)
            msg[i][j] = false;

      // The color of each column of LEDs
      letcol = new int[TOTAL];

      for(i=0;i<TOTAL;i++)
         letcol[i] = 1;  // The default red

      p = fi.startspace;
      c = 'r';

      for(i=0;i<fi.text.length();i++)
      {
         // get letter i in fi.text in LED format
         index = let.getLetter(fi.text.charAt(i));

         if(fi.color.length() > 0)
            try
            {
               c = fi.color.charAt(i);
            }
            catch(IndexOutOfBoundsException e)
            {
               System.out.println("Out of bounds in LEDMessage.setmsg");
            }

         k = index.width;
         for(a=0;a<k;a++)
         {
            for(b=0;b<h;b++)
            {
               // Fill the message structure
               try
               {
                  msg[p+a][b] = index.letter[a][b];
               }
               catch(IndexOutOfBoundsException e)
               {
               }

               // Set the colors
               if(c == 'r')
                  letcol[p+a] = 1;
               else if(c == 'g')
                  letcol[p+a] = 2;
               else if(c == 'b')
                  letcol[p+a] = 3;
               else if(c == 'y')
                  letcol[p+a] = 4;
               else if(c == 'o')
                  letcol[p+a] = 5;
               else if(c == 'p')
                  letcol[p+a] = 6;
               else if(c == 'w')
                  letcol[p+a] = 7;
               else if(c == 'c')
                  letcol[p+a] = 8;
            }
         }
         p += index.width+1;
      }
   }

   //////////////////////////////////////////////////////////////////
   // return the state of the LED (on/off)
   boolean getLED(int x, int y)
   {
      if(x >= 0 && x < TOTAL && y >= 0 && y < h)
         return msg[x][y];
      else
         return false;
   }
   
   //////////////////////////////////////////////////////////////////
   // return the color of the LED
   int getColor(int x)
   {
      if(x >= 0 && x < TOTAL)
         return letcol[x];
      else
         return 1;  // default red
   }

   //////////////////////////////////////////////////////////////////
   // get the length of the messege in LEDs
   int length()
   {
      return TOTAL;
   }

   //////////////////////////////////////////////////////////////////
   // Check and see if we're still in the message
   boolean inRange(int x)
   {
      if(x >= 0 && x < TOTAL)
         return true;
      else
         return false;
   }
}
