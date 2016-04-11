///////////////////////////////////////////////////////////////////
//  FuncInfo.java   -- LED Sign V2.5
//
//  Contains the following classes:
//      FuncInfo   -- a class (struct) to hold all the 
//                    information for any function.
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
//     V1.0: Written July 17 - August 6, 1995
//
//  by Darrick Brown
//     dbrown@cs.hope.edu
//     http://www.cs.hope.edu/~dbrown/
//
//  © Copyright 1995
///////////////////////////////////////////////////////////////////


import java.awt.*;
import java.io.*;
import java.util.*;
import java.net.*;

///////////////////////////////////////////////////////////////////
// The "struct" that contains all the information
// than any function/transition would need.
public class FuncInfo
{
   public int func;
   public int delay;
   public int startspace, endspace;
   public int times, remaining;
   public boolean centered;
   public String color;
   public String text;
   public String store;  // store the original text line
   public String target; // Target frame
   public URL url;       // The url associated with this message
   public linkList ret;  // pointer to the return place in the script (for loops);
}
