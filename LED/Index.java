/////////////////////////////////////////////////////////////////////
//  Index.java   -- LED Sign V2.5
//  
//  This is just a small class used for a struct
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
//     V1.0: Written July 13 - 14, 1995
//
//  By Darrick Brown
//     dbrown@cs.hope.edu
//     http://www.cs.hope.edu/~dbrown/
//
//  © Copyright 1995
/////////////////////////////////////////////////////////////////////

import java.awt.*;
import java.io.*;
import java.net.*;


//////////////////////////////////////////////////////////////////
// The Index Class (struct)
//////////////////////////////////////////////////////////////////
public class Index
{
   public byte ch;
   public int width;
   public boolean letter[][];

   Index(byte b, int w, int h)
   {
      letter = new boolean[w][h];
      width = w;
      ch = b;
   }
}
