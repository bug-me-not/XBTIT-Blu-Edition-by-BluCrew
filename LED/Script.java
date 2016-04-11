///////////////////////////////////////////////////////////////////
//  Script.java   -- LED Sign V2.5
//
//  Contains the following classes:
//      Script     -- The class that manages the script
//                    including parsing, storage, and
//                    retrieval.
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
import FuncInfo;
import linkList;

///////////////////////////////////////////////////////////////////
// Function            Code
// --------            ----
// Appear               0
// Sleep                1
// ScrollLeft           2
// ScrollRight          3
// ScrollUp             4
// ScrollDown           5
// Pixel                6
// Blink                7
// OverRight            8
// ScrollCenter         9
// OverCenter           10
// OverLeft             11
// OverUp               12
// OverDown             13
// Do                   97
// Repeat               98
// Reload               99
///////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
// The class that parses the script and keeps it in memory 
public class Script
{
   linkList list;               // the linked list for the script
   linkList ptr,start;          // the current line and start of the list
   int ok;
   String scrpt;
   URL documentURL;

   ///////////////////////////////////////////////////////////////////
   // The constructor
   public Script(URL url, String s)
   {
      scrpt = s;
      documentURL = url;
      if(initScript() == -1)
      {
         ok = -1;
      }
      else
      {
         ok = 1;
      }
   }

   ///////////////////////////////////////////////////////////////////
   // get the parameters from the functions in the script
   String getParam(String s, String sub)
   {
      int i,j;
      String tmp;

      i = s.indexOf(sub);
      j = s.indexOf("text");

      if(j == -1 || i <= j)  // if the first occurance of "sub" is before 
      {                      // the "text=" (ie not in the message)
         if(i == -1)
            return null;
         else
         {
            tmp = s.substring(i);  // forget everything before the sub
            i = tmp.indexOf("=");
            if(i == -1)
            {
               System.out.println("Error in '"+sub+"' parameter in "+s);
               return null;
            }
            else
            {
               i++;  // one spot after the "="
               if(sub.compareTo("text") == 0)
                  tmp = tmp.substring(i);
               else
               {
                  tmp = tmp.substring(i);
                  if(tmp.indexOf(" ") != -1)
                     tmp = tmp.substring(0,tmp.indexOf(" "));
               }
               tmp.trim();
               return tmp;
            }
         }
      }
      else
         return null;

   }  // End getParam()
   
   ///////////////////////////////////////////////////////////////////
   // get the function info
   FuncInfo getFunc(String s)
   {
      int i;
      String tmp;
      FuncInfo fi = new FuncInfo();
      
      // Assign the defaults
      fi.func = -1;
      fi.delay = 40;
      fi.startspace = 10;
      fi.endspace = 20;
      fi.times = -1;
      fi.remaining = 0;
      fi.centered = false;
      fi.color = new String("");
      fi.text = new String("No text specified");
      fi.url = null;
      fi.ret = null;
      
      //get rid of any starting (and ending) white space, just to be sure.
      s = s.trim(); 

      ////////////////////////////////////////////////////
      // Any parameters that might exist.  This will
      // read in any command line parameters for each
      // function.  For example: Sleep text=blah blah
      // is accepted, but the text will never be used

      tmp = getParam(s,"delay");
      if(tmp != null)
         fi.delay = (new Integer(tmp)).intValue();

      tmp = getParam(s,"clear");
      if(tmp != null && tmp.compareTo("true") == 0)
      {
         fi.centered = true;
         fi.text = new String("");
      }
      else
      {
         tmp = getParam(s,"center");
         if(tmp != null && tmp.compareTo("true") == 0)
            fi.centered = true;
         else
         {
            fi.centered = false;
            tmp = getParam(s,"startspace");
            if(tmp != null)
               fi.startspace = (new Integer(tmp)).intValue();

            tmp = getParam(s,"endspace");
            if(tmp != null)
               fi.endspace = (new Integer(tmp)).intValue();
         }

         tmp = getParam(s,"text");
         if(tmp != null)
            fi.text = tmp;
      }

      tmp = getParam(s,"times");
      if(tmp != null)
      {
         fi.times = (new Integer(tmp)).intValue();
         fi.remaining = fi.times;
      }

      tmp = getParam(s,"pixels");
      if(tmp != null)
      {
         fi.times = (new Integer(tmp)).intValue();
         fi.remaining = fi.times;
      }

      tmp = getParam(s,"URL");
      if(tmp != null)
      {
         if(tmp.indexOf(',') != -1)
         {
            // They specified a frame target.
            // Separate out the target and URL.
            fi.target = tmp.substring(tmp.indexOf(',') + 1);
            tmp = tmp.substring(0,tmp.indexOf(','));
         }
         else
            fi.target = new String("");

         try
         {
            fi.url = new URL(tmp);
         }
         catch(MalformedURLException e)
         {
            System.out.println("Bad URL: "+tmp);
            fi.url = null;
         }
      }
      else
      {
         fi.url = null;
      }

      ////////////////////////////////////////////////////
      // set the function number (and some minor
      // tweeks/precautions)
      i = s.indexOf(" ");
      if(i != -1)
         tmp = s.substring(0,i);
      else
         tmp = s;
         
      if(tmp.compareTo("Appear") == 0)
      {
         fi.func = 0;
      }
      else if(tmp.compareTo("Sleep") == 0)
      {
         fi.func = 1;
      }
      else if(tmp.compareTo("ScrollLeft") == 0)
      {
         fi.func = 2;
      }
      else if(tmp.compareTo("ScrollRight") == 0)
      {
         fi.func = 3;
      }
      else if(tmp.compareTo("ScrollUp") == 0)
      {
         fi.func = 4;
      }
      else if(tmp.compareTo("ScrollDown") == 0)
      {
         fi.func = 5;
      }
      else if(tmp.compareTo("Pixel") == 0)
      {
         fi.func = 6;
         
         // Just for precautions dealing with a delay problem.
         // This shouldn't be noticable.
         if(fi.delay < 1)
            fi.delay = 1;

         // Can't allow "times" to be 0 or less, it will cause
         // the sign to freeze (not procede).
         if(fi.times < 1)
            fi.times = 15;
      }
      else if(tmp.compareTo("Blink") == 0)
      {
         fi.func = 7;
         
         if(fi.times < 1)
            fi.times = 2;
      }
      else if(tmp.compareTo("OverRight") == 0)
      {
         fi.func = 8;
      }
      else if(tmp.compareTo("ScrollCenter") == 0)
      {
         fi.func = 9;
      }
      else if(tmp.compareTo("OverCenter") == 0)
      {
         fi.func = 10;
      }
      else if(tmp.compareTo("OverLeft") == 0)
      {
         fi.func = 11;
      }
      else if(tmp.compareTo("OverUp") == 0)
      {
         fi.func = 12;
      }
      else if(tmp.compareTo("OverDown") == 0)
      {
         fi.func = 13;
      }
      else if(tmp.compareTo("Do") == 0)
      {
         fi.func = 97;  // This marks a place for the "repeats" to go back to.
      }
      else if(tmp.compareTo("Repeat") == 0)
      {
         fi.func = 98;
      }
      else if(tmp.compareTo("Reload") == 0)
      {
         fi.func = 99;
      }

      fi.store = fi.text;

      return fi;
   }  // End getFunc()

   //////////////////////////////////////////////////////////////////
   // get the next function
   FuncInfo nextFunc()
   {
      FuncInfo fi;

      fi = ptr.fi;
      ptr = ptr.next;

      switch(fi.func)
      {
         case 97:  // Do
            fi = nextFunc();   // skip the "Do function; its just a marker
           break;

         case 98:  // a Repeat

            // If it doesn't repeat infinitely...
            if(fi.times >= 0)
            {
               // One less time
               fi.remaining--;
               if(fi.remaining <= 0)
               {
                  fi.remaining = fi.times;  // reset the loop
                  fi = nextFunc();
               }
               else
               {
                  ptr = fi.ret;  // Jump back to the last "Do"
                  fi = nextFunc();
               }
            }
            else
            {
               ptr = fi.ret;  // Jump back to the last "Do"
               fi = nextFunc();
            }
           break;

         case 99:  // Reload
            // Reload the script from the URL
            if(initScript() == -1)  // If the script path is bad...
            {
               fi = null;
            }
            else
            {
               fi = nextFunc();   // and get the first function.
            }
           break;
      }

      return fi;
   }  // End nextFunc()

   //////////////////////////////////////////////////////////////////
   // just a simple function to see if it is a color code
   boolean isColor(char t)
   {
      if(t == 'r' || t == 'g' || t == 'b' || t == 'y' || t == 'o' || t == 'p' || t == 'w' || t == 'c')
         return true;
      else
         return false;
   }
      

   //////////////////////////////////////////////////////////////////
   // Get the varible defined
   String getVar(String s, int i)
   {
      String t;
      
      if(s.charAt(i) == '{')
      {
         t = s.substring(i+1);
         t = t.substring(0,t.indexOf('}'));
      }
      else
         t = String.valueOf(s.charAt(i));

      return t;
   }

   //////////////////////////////////////////////////////////////////
   // create the final text line from parsing the store line
   //   Add any codes (ie \t, \r, \g, \b, etc.) here to parse
   //   out of the text line.
   FuncInfo parseLine(FuncInfo fi)
   {
      String tmp;
      String time;
      String month[] = {"Jan","Feb","Mar","Apr","May","Jun",
                        "Jul","Aug","Sept","Oct","Nov","Dec"};
      String Month[] = {"January","February","March","April","May","June",
                        "July","August","September","October","November","December"};
      String day[] = {"Sun","Mon","Tues","Wed","Thur","Fri","Sat"};
      String Day[] = {"Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"};
      String ddmmyy;
      int min;
      int pm;
      Date date = new Date();
      int a,b;
      int i;
      char c;
      String t;         // The tag  (eg. text=Hello \ythere,  t=y)

      tmp = fi.store;
      fi.color = "";

      if(fi.func == 0 || (fi.func >= 2 && fi.func <= 97))
      {
         c = 'r';  // the default color
         b = 0;
         while(b < tmp.length())
         {
            if(tmp.charAt(b) == '\\')  // if there is a '\' does the following
            {                                          // letter indicate a color.
               b++;
               // Get the tag!
               if(tmp.charAt(b) == '{')
               {
                  t = tmp.substring(b+1);

                  // cut out the \{XX}
                  tmp = tmp.substring(0,b-1).concat(t.substring(t.indexOf('}')+1));
                  t = t.substring(0,t.indexOf('}'));
                  b -= 1;
               }
               else
               {
                  t = tmp.substring(b,b+1);
                  tmp = (tmp.substring(0,b-1)).concat(tmp.substring(b+1));  // take the "\r" out
                  b -= 1;
               }

               // set the 
               if(t.length() == 1 && isColor(t.charAt(0)))
               {
                  c = t.charAt(0);
               }
               else if(t.compareTo("tt") == 0)
               {
                  // it is the "time" variable!!
                  if(date.getHours() >= 12)
                     pm = 1;
                  else 
                     pm = 0;

                  if(pm == 1)
                  {
                     a = date.getHours();
                     if(a == 12)
                        time  = String.valueOf(12);
                     else
                        time = String.valueOf(date.getHours()-12);
                  }
                  else
                  {
                     a = date.getHours();
                     if(a == 0)
                        time = String.valueOf(12);
                     else
                        time = String.valueOf(a);
                  }

                  time = time.concat(":");
                  
                  min = date.getMinutes();
                  if(min >= 10)
                     time = time.concat(String.valueOf(min));
                  else
                  {
                     time = time.concat("0");
                     time = time.concat(String.valueOf(min));
                  }

                  if(pm == 1)
                     time = time.concat(" pm");
                     else
                     time = time.concat(" am");

                  tmp = ((tmp.substring(0,b)).concat(time)).concat(tmp.substring(b));

                  b += time.length();

                  for(i = 0; i < time.length(); i++)
                     fi.color = (fi.color).concat((new Character(c)).toString());

               } // End time
               else if(t.compareTo("dd") == 0 || t.compareTo("DD") == 0)   // Set the current date
               {
                  if(t.compareTo("dd") == 0)
                     ddmmyy = day[date.getDay()];
                  else
                     ddmmyy = Day[date.getDay()];
                  
                  // Set up the color
                  for(i = 0; i < ddmmyy.length(); i++)
                     fi.color = (fi.color).concat((new Character(c)).toString());

                  tmp = ((tmp.substring(0,b)).concat(ddmmyy)).concat(tmp.substring(b));
                  b += ddmmyy.length();
               }
               else if(t.compareTo("dn") == 0)
               {
                  ddmmyy = String.valueOf(date.getDate());

                  // Set up the color
                  for(i = 0; i < ddmmyy.length(); i++)
                     fi.color = (fi.color).concat((new Character(c)).toString());

                  tmp = ((tmp.substring(0,b)).concat(ddmmyy)).concat(tmp.substring(b));
                  b += ddmmyy.length();
               }
               else if(t.compareTo("mm") == 0 || t.compareTo("MM") == 0)  
               {
                  if(t.compareTo("mm") == 0)
                     ddmmyy = month[date.getMonth()];
                  else
                     ddmmyy = Month[date.getMonth()];

                  // Set up the color
                  for(i = 0; i < ddmmyy.length(); i++)
                     fi.color = (fi.color).concat((new Character(c)).toString());

                  tmp = ((tmp.substring(0,b)).concat(ddmmyy)).concat(tmp.substring(b));
                  b += ddmmyy.length();
               }
               else if(t.compareTo("mn") == 0)
               {
                  ddmmyy = String.valueOf(date.getMonth()+1);

                  // Set up the color
                  for(i = 0; i < ddmmyy.length(); i++)
                     fi.color = (fi.color).concat((new Character(c)).toString());

                  tmp = ((tmp.substring(0,b)).concat(ddmmyy)).concat(tmp.substring(b));
                  b += ddmmyy.length();
               }
               else if(t.compareTo("yy") == 0 || t.compareTo("YY") == 0)
               {
                  if(t.compareTo("YY") == 0)
                     ddmmyy = String.valueOf(date.getYear()+1900);
                  else
                     ddmmyy = String.valueOf(date.getYear()%100);

                  // Set up the color 
                  for(i = 0; i < ddmmyy.length(); i++)
                     fi.color = (fi.color).concat((new Character(c)).toString());

                  tmp = ((tmp.substring(0,b)).concat(ddmmyy)).concat(tmp.substring(b));
                  b += ddmmyy.length();

               }  // End short date
               else if(t.compareTo("\\") == 0)  // Are they trying to delimit the backslash?
               {
                  tmp = (tmp.substring(0,b)).concat(tmp.substring(b+1));  // delimit the '\'
                  b--;
               }
               else
               {
                  // A little error output
                  System.out.println("Backslash (\\) error in text line: "+ fi.store);
               }
               
            }  // END - if(tmp.charAt(b) == '\\') 
            else
            {
               b++;
               fi.color = fi.color.concat((new Character(c)).toString());
            }
            
         }  // END - for(...) 

      } // END - if(fi.func == ...)

      fi.text = tmp;
      
      return fi;
      
   }

   //////////////////////////////////////////////////////////////////
   // Read in the script into a linked list of FuncInfo's 
   int initScript()
   {
      InputStream file;
      DataInputStream dis;
      URL url;
      String line;
      int listlen;
      int dos;
      int a;

      try
      {
         url = new URL(documentURL,scrpt);
            
         file = url.openStream();
         dis = new DataInputStream(file);
      }
      catch(IOException e)
      {
         e.printStackTrace();
         return -1;
      }

      try
      {
         list = new linkList();                                    // The linked list
         start = list;                                             // The head of the list
         ptr = list;                                               // The current element
         listlen = 0;
         dos = 0;                                                  // Used to know how many Do's there are
         while((line = dis.readLine()) != null)
         {
            line = line.trim();                                    // cut off white space at the beginning and end
            if(!(line.startsWith("!!")) && (line.length() != 0))   // Not a comment or blank line
            {
               listlen++;
               ptr.fi = getFunc(line);                             // Get the function number
               if(ptr.fi.func == 97)
                  dos++;                                           // Chalk up another "Do"
               ptr.next = new linkList();
               ptr = ptr.next;  // advance to the next command
            }
         }

         // Ok now lets set the return pointers for the loops
         ptr = start;
         linkList stack[] = new linkList[dos];  // Allocate the array
         dos = 0;
         for(a=0;a<listlen;a++)
         {
            if(ptr.fi.func == 97) // A "Do"
            {
               stack[dos] = new linkList();
               stack[dos] = ptr;
               dos++;
            }
            else if(ptr.fi.func == 98)  // A Repeat
            {
               if(dos > 0)
               {
                  dos--;
                  ptr.fi.ret = stack[dos];
               }
               else
               {
                  // OMYGOSH!! Script error output!!!!
                  System.out.println("Repeat error in line : Repeat times="+ptr.fi.times);
                  System.out.println("     Mismatched Do/Repeats?");
               }
            }
            ptr = ptr.next;
         }

         ptr = start;

         file.close();
         dis.close();
      }
      catch (IOException e)
      {
         // Error!
         return -1;  // We could not read from the script.  This is a bad script path.
      }
      
      return 1;
   }  // End initScript()
}  // End Class Script
