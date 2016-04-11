/////////////////////////////////////////////////////////////////////
//  LED.java  -- LED Sign V2.7
//
//  The main for the LED Sign applet.  This applet mimics
//  an LED sign that you typically see displaying messages
//  at airport terminals and the such.
//
//  Revisions:
//     V2.7: "Supped" up V2.5.  See the "Revisions" doc for more
//           info.
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
//     V1.0: Written July 10 - August 6, 1995
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
import FuncInfo;
import Script;
import Letters;
import LEDMessage;


// Just a small struct
// used in randomizing the pixels in the "Pixel" function
class Pixelize
{
   int x;
   int y;
}

/////////////////////////////////////////////////////////////////////
// The java.applet.Applet!!
/////////////////////////////////////////////////////////////////////
public class LED extends java.applet.Applet implements Runnable
{
   // my #defines
   int WIDTH = 400;
   int HEIGHT = 30;
   Color highlight;
   
   Script com;                  // The class that takes care of the script
   FuncInfo fi;                 // All the info for any funtion/transition
   Letters let;                 // The class that contains all the letters
   int ledsize;                 // The size of the LED's!

   Color colors[];              // The array of possible colors
   LEDMessage msg;              // The class that takes care of the message to be displayed
   Color bhilite;               // The highlight color of the border
   Color bcolor;                // The color of the border
   Color bshadow;               // The shadow of the border
   
   Thread led = null;
   String scrpt,endspace,fnt;   // "command line" arguments
   String text;                 // the current message
   String currurl = "LED Sign V2.7";  // The current url that are set in the script
   URL currURL = null;
   String target = new String("");  // Target for frames
   int place;                   // The place where we are in each transition.  How we know when we are done.
   int border;                  // The border width
   int offset;                  // The offset for the sign from the upper left
   int w,h;                     // Width & Height in LEDs
   int swidth;                  // The width of the space character.  Settable in the HTML command line.
   boolean beginning = false;   // make sure we init certain stuff only once
   boolean init = false;        // used to make sure "getinfo" is called only once.
   boolean inapplet;            // Is the mouse cursor in the applet?  (used to display status messages)
   boolean done = false;        // Is the transition done?
   Image pixmapimg,offimg,tmpimg;    // The pixmaps!!  -- These are what make this program possible
   Graphics pixmap,offmap,tmpmap;    // Graphics for the pixmaps
   Pixelize pix[];              // Array of "pixels" used during the Pixel transition
      

   //////////////////////////////////////////////////////////////////
   // get the "command line" arguments from the HTML
   private int getAttrs()
   {
      String s;
      int r,g,b;
      Graphics gr;
      
      if(getParameter("script") !=  null)
      {
         scrpt = new String(getParameter("script"));
      }
      else
      {
         System.out.println("LED Sign Error: No script specified in HTML.");
         currurl = new String("LED Sign Error: No script specified in HTML.");
         return -1;  // Script error;
      }

      if(getParameter("font") !=  null)
      {
         fnt = new String(getParameter("font"));
      }
      else
      {
         System.out.println("LED Sign Error: No font specified in HTML.");
         currurl = new String("LED Sign Error: No font specified in HTML.");
         return -1; // font error
      }
      
      if(getParameter("spacewidth") !=  null)
      {
         swidth = (new Integer(new String(getParameter("spacewidth")))).intValue();
      }
      else
         swidth = 3;

      if(getParameter("ledsize") !=  null)
      {
         ledsize = new Integer(new String(getParameter("ledsize"))).intValue();
         
         // A little error trapping
         if(ledsize < 1)
            ledsize = 1;
         else if(ledsize > 4)
            ledsize = 4;

         ledsize++;    // The user enters 1-4, the applet needs 2-5
      }
      else
         ledsize = 4;
      
      if(getParameter("ht") != null)
      {
         HEIGHT = ledsize*(new Integer(new String(getParameter("ht")))).intValue();
         h = HEIGHT/ledsize;
      }
      else
      {
         System.out.println("LED Sign Warning: parameter \"ht\" (height in LED's) not specified");
         HEIGHT = ledsize*9;
         h = 9;
      }
      
      if(getParameter("wth") !=  null)
      {
         WIDTH = ledsize*(new Integer(new String(getParameter("wth")))).intValue();
         if(WIDTH/ledsize%2 == 1)
            WIDTH += ledsize;  // It must be even!!!

         w = WIDTH/ledsize;
      }
      else
      {
         System.out.println("LED Sign Warning: parameter \"wth\" (width in LED's) not specified");
         WIDTH = 60*ledsize;
         w = 60;
      }
         
      if(getParameter("border") !=  null)
      {
         border = new Integer(new String(getParameter("border"))).intValue();
      }
      else
         border = 0;

      if(getParameter("bordercolor") != null)
      {
         // User specified border color!!
         s = new String(getParameter("bordercolor"));
         s = s.trim();
         r = new Integer(s.substring(0,s.indexOf(","))).intValue();
         s = s.substring(s.indexOf(",")+1);
         g = new Integer(s.substring(0,s.indexOf(","))).intValue();
         s = s.substring(s.indexOf(",")+1);
         b = new Integer(s).intValue();
         
         // Forgive the "if" syntax, I didn't want to bother typing the
         // "normal" ifs for this small part. :)
         bhilite = new Color(r+40<256?r+40:255, g+40<256?g+40:255, b+40<256?b+40:255);
         bcolor = new Color(r,g,b);
         bshadow = new Color(r-40>=0?r-40:0, g-40>=0?g-40:0, b-40>=0?b-40:0);
      }
      else
      {
         // The default gray
         bhilite = Color.white;
         bcolor = Color.lightGray;
         bshadow = Color.darkGray;
      }

      return 1;  // Everthing so far is ok.
      
   } // end getAttrs()

   //////////////////////////////////////////////////////////////////
   // Initialize the Applet
   public void init()
   {
      // Set up the different colors for the sign
      highlight = new Color(100,100,100);
      colors = new Color[9];
      colors[0] = new Color(80,80,80);  // off color
      colors[1] = new Color(255,0,0);   // Default red
      colors[2] = new Color(130,255,0); // green
      colors[3] = new Color(0,130,255); // blue
      colors[4] = new Color(255,255,0); // yellow
      colors[5] = new Color(255,160,0); // orange
      colors[6] = new Color(255,0,255); // purple
      colors[7] = new Color(255,255,255); // white
      colors[8] = new Color(0,255,255); // cyan

      // If the script and/or font are not specified, then stop!
      if(getAttrs() == -1)
         stop();
      else
      {
         offset = 3*border;
         beginning = true;
         init = true;
      }
   }  // End Init

   
   //////////////////////////////////////////////////////////////////
   //  This is called from the run procedure.  This is to allow the
   //  init procedure to finish as fast as possible, thus allowing
   //  it to draw the blank sign to the screen sooner.
   public void getinfo()
   {
      pix = new Pixelize[1];  // load this class now!

      let = new Letters(getDocumentBase(),fnt,swidth);
      if(let.w == -1)
      {
         // Do some error output for a bad font
         System.out.println("LED Sign Error - Bad font path in HTML:");
         System.out.println("   File not found:  "+ "\"" + fnt + "\"");
         currurl = new String("LED Sign Error - Bad font path in HTML.");
         stop();
      }
      else
      {
         if(HEIGHT != let.height()*ledsize)
         {
            System.out.println("LED Sign Warning: parameter \"ht\" should be set to " + let.height()*ledsize + ".");
         }

         // now that we have the dimensions of the applet, draw it now!
         // This will make the applet *seem* to load faster.
         // paint(getGraphics());
   
         msg = new LEDMessage(h,w,let);
         
         // Set up the script
         com = new Script(getDocumentBase(),scrpt);
         if(com.ok == -1)  // Check for bad script path...
         {
            System.out.println("LED Sign Error - Bad script path in HTML:");
            System.out.println("   File not found:  "+ "\""+scrpt+"\"");
            currurl = new String("LED Sign Error: Bad script path in HTML.");
            stop();
         }
         else
         {
            fi = new FuncInfo();

            nextFunc();
            
            resize(WIDTH+2*(offset),HEIGHT+2*(offset));  // Set the applet size
         }
      }

      init = false;

   }  // End getinfo()

   //////////////////////////////////////////////////////////////////
   // Start the applet running and thread the process
   public void start()
   {
      if(led == null) 
      {
         led = new Thread(this);  // Start the applet running
         led.start();
      }
   }

   //////////////////////////////////////////////////////////////////
   // Stop the thread
   public void stop()
   {
      if(led != null)
      {
         led.stop();
         led = null;
      }
   }

   //////////////////////////////////////////////////////////////////
   // The run loop
   public void run()
   {
      if(init)
         getinfo();

      while(led != null)
      {
         repaint();

         try 
         {
            led.sleep(fi.delay);
         }
         catch (InterruptedException e)
         {
         }

         // If we are done with the current transition, then get the
         // next transition (function).
         if(done)
         {
            nextFunc();

            // if fi is null then a reload caused a nonexistant
            // script to be loaded.
            if(fi == null)
            {
               System.out.println("LED Sign Error - Bad script path in HTML:");
               System.out.println("   File not found: "+ scrpt);
               currurl = new String("LED Sign Error: Bad script path in HTML.");
               stop();
            }
            done = false;
         }
      }
   }

   //////////////////////////////////////////////////////////////////
   // The HTML tag parameter information
   public String[][] getParameterInfo() {
      String[][] info = {
         {"script     ","URL        ", "LED script to use (Required)"},
         {"font       ","URL        ", "Font to use (Required)"},
         {"spacewidth ","int        ", "Width of space in columns, default = 3 )"},
         {"wth        ","int        ", "Width of live display (cols, default=60)"},
         {"ht         ","int        ", "Height of live display (rows, default=9)"},
         {"border     ","int        ", "Width of display border (pix, default=0)"},
         {"bordercolor","int,int,int", "Color of border (n,n,n default=lightGray)"},
         {"ledsize    ","int        ", "Diameter of LEDs pixels (1-4), default=3)"}
      };
      return info;
   }

   //////////////////////////////////////////////////////////////////
   // The "about" stuff.
   public String getAppletInfo() {
      return "LED Sign V2.7 by Darrick Brown. 3-22-96";
   }


   //////////////////////////////////////////////////////////////////
   // Trap for a mouse click on the applet to check to see if they
   // want to go to another page.
   public boolean mouseDown(java.awt.Event evt, int x, int y)
   {
      if (currURL != null)
      {
         if(target.length() > 0)  // They have specified a target
         {
            getAppletContext().showDocument(currURL,target);
         }
         else
         {
            getAppletContext().showDocument(currURL);
         }
      }

      return true;
   }

   //////////////////////////////////////////////////////////////////
   // If the mouse cursor enters the applet, then display something
   // in the status bar of the browser.
   public boolean mouseEnter(java.awt.Event evt, int x, int y)
   {
      inapplet = true;

      showStatus(currurl);

      return true;
   }

   //////////////////////////////////////////////////////////////////
   // If the mouse cursor exits the applet, then clear the status
   // bar.
   public boolean mouseExit(java.awt.Event evt, int x, int y)
   {
      inapplet = false;
      
      showStatus(" ");

      return true;
   }

   //////////////////////////////////////////////////////////////////
   // set the next function
   // This function is only called when the previous
   // function/transition has finished.
   void nextFunc()
   {
      int i,j;
      Pixelize temp;
      int rand;

      // get the next function
      fi = com.nextFunc();

      // Parse the text line to expand any time/date tags
      fi = com.parseLine(fi);

      // Create the message in LED format (boolean)
      msg.setmsg(fi);

      // Set up some initial stuff for each of the transitions
      switch(fi.func)
      {
         case 0:
            place = 0;
            break;
         case 1:
            place = 0;
            break;
         case 2:
            place = 0;
            break;
         case 3:
            place = msg.length()-1;
            break;
         case 4:
            place = 0;
            break;
         case 5:
            place = h-1;
            break;
         case 6:
            place = 0;

            // This randomizes the "LEDs" for the
            // Pixel function.

            pix = new Pixelize[w*h];

            for(i=0;i<w;i++)
            {
               for(j=0;j<h;j++)
               {
                  pix[h*i+j] = new Pixelize();
                  pix[h*i+j].x = i;
                  pix[h*i+j].y = j;
               }
            }
            
            // Randomly sort all the LED's so all we have to do
            // is draw them in "order" and they come out all pixelly
            for(i=0;i<WIDTH/ledsize*h;i++)
            {
                  rand = (int)(Math.random()*(double)(WIDTH/ledsize)*(double)h);
                  temp = pix[i];
                  pix[i] = pix[rand];
                  pix[rand] = temp;
            }
            break;
         case 7:
            place = fi.times*2;  // on AND off
            break;
         case 8:
            place = 0;
            break;
         case 9:
            place = 0;
            break;
         case 10:
            place = 0;
            break;
         case 11:
            place = w;
            break;
         case 12:
            place = h-1;
            break;
         case 13:
            place = 0;
            break;
      }

      if(fi.url != null)
      {
         currurl = fi.url.toString();
         currURL = fi.url;
         target = fi.target;
      }
      else
      {
         currurl = new String("LED Sign V2.7");
         currURL = null;
         target = new String("");
      }

      if(inapplet)
      {
         showStatus(currurl);
      }
   }

   //////////////////////////////////////////////////////////////////
   // Draw a pretty little LED
   private void drawLED(int x, int y, boolean on, int col, Graphics gr)
   {
      if(on)
      {
         gr.setColor(colors[col]);
      }
      else  // its off
      {
         gr.setColor(colors[0]);
      }

      switch(ledsize)
      {
         case 2:    // Just a pixel
            gr.drawLine(x,y,x,y);
            break;

         case 3:    // A 2x2 rectangle
            gr.fillRect(x,y,2,2);
            break;

         case 4:   // A 3x3 '+'
            gr.drawLine(x,y+1,x+2,y+1);
            gr.drawLine(x+1,y,x+1,y+2);
            break;

         case 5:   // The original size seen in previous versions
            gr.fillRect(x+1,y,2,4);
            gr.fillRect(x,y+1,4,2);
            break;
      }

      if(ledsize == 5 && !on)
      {
         gr.setColor(highlight);
         gr.drawLine(x+1,y+1,x+1,y+1);  // the cool little highlight
      }
   }
         
   //////////////////////////////////////////////////////////////////
   // My version of paint3DRect (variable width) 
   void draw3DRect(Graphics gr, int x, int y, int lx, int ly, int width, boolean raised)
   {
      int i;

      for(i=0; i<width; i++)
      {
         if(raised)
            gr.setColor(bhilite);
         else
            gr.setColor(bshadow);
            
         gr.drawLine(x+i,y+i,lx-i,y+i);
         gr.drawLine(x+i,y+i,x+i,ly-i);
         
         if(raised)
            gr.setColor(bshadow);
         else
            gr.setColor(bhilite);
            
         gr.drawLine(lx-i,y+i,lx-i,ly-i);
         gr.drawLine(x+i,ly-i,lx-i,ly-i);
      }
   }

   //////////////////////////////////////////////////////////////////
   public void paint(Graphics gr)
   {
      int i,j;
      int p,p2;
      
      // don't do any of this if the thread is null
      if(led != null)
      {   
         if(border > 0)
         {
            draw3DRect(gr,0,0,WIDTH+2*offset-1,HEIGHT+2*offset-1,border,true);
            gr.setColor(bcolor);
            gr.fillRect(border,border,WIDTH+4*border,HEIGHT+4*border);
            draw3DRect(gr,2*border,2*border,WIDTH+4*border-1,HEIGHT+4*border-1,border,false);
         }

         // If the applet has just start, set up the pixmaps
         // and draw all the LEDs off
         if(beginning)
         {
            // OK, lets quickly set up the "offimage" (has all LED's turned
            // off) so that we can draw it to the screen quicker when the
            // applet first starts.
            offimg = createImage(WIDTH, HEIGHT);
            offmap = offimg.getGraphics();
            offmap.setColor(Color.black);
            offmap.fillRect(0,0,WIDTH,HEIGHT);

            for(i=0;i<HEIGHT;i+=ledsize)
               for(j=0;j<WIDTH;j+=ledsize)
               {
                  drawLED(j,i,false,1,offmap);
               }
                  
            gr.drawImage(offimg,offset,offset, this);

            // Now that we at least have the initial image up, create the other
            // pixmaps we need.
            pixmapimg = createImage(WIDTH, HEIGHT);
            tmpimg = createImage(WIDTH, HEIGHT);
            
            pixmap = pixmapimg.getGraphics();
            tmpmap = tmpimg.getGraphics();
            
            pixmap.setColor(Color.black);
            pixmap.fillRect(0,0,WIDTH,HEIGHT);

            for(i=0;i<HEIGHT;i+=ledsize)
               for(j=0;j<WIDTH;j+=ledsize)
               {
                  drawLED(j,i,false,1,pixmap);
               }
            
            beginning = false;
         }
         else
         {
            gr.drawImage(pixmapimg,offset,offset, this);
         }
      }
   }


   //////////////////////////////////////////////////////////////////
   // This procedure contains all the different transitions
   // Each transition does one iteration and returns to the
   // "run" procedure to use its delay.  This also allows
   // the applet to be redrawn (if needed) more quickly.
   public void update(Graphics gr)
   {
      int i,j;
      int count;

      if(done)
         return;

      // if we have not initialized our applet, don't do anything here.
      if( (led != null) && (pixmap != null) && (offmap != null) && (tmpmap != null))
      {
         switch(fi.func)
         {
            case 0:  // Appear
               if(fi.text == null)
               {
                  gr.drawImage(offimg,offset,offset, this);  // Turn all the LEDs off
               }
               else
               {
                  for(i=0;i<w;i++)
                     for(j=0;j<h;j++)
                        drawLED(i*ledsize,j*ledsize,msg.getLED(i,j),msg.getColor(i),pixmap);

                  gr.drawImage(pixmapimg,offset,offset, this);
               }

               done = true;
               
               break;

            case 1:  // Sleep
               done = true;  // We don't do anything here

               break;

            case 2:  // ScrollLeft
               pixmap.copyArea(ledsize,0,WIDTH-ledsize,HEIGHT,-ledsize,0);

               for(i=0;i<HEIGHT;i+=ledsize)
                  drawLED(WIDTH-ledsize,i,msg.getLED(place,i/ledsize),msg.getColor(place),pixmap);

               gr.drawImage(pixmapimg,offset,offset, this);

               place++;

               if(!msg.inRange(place))
                  done = true;

               break;

            case 3:  // ScrollRight
               pixmap.copyArea(0,0,WIDTH-ledsize,HEIGHT,ledsize,0);

               for(i=0;i<HEIGHT;i+=ledsize)
                  drawLED(0,i,msg.getLED(place,i/ledsize),msg.getColor(place),pixmap);

               gr.drawImage(pixmapimg,offset,offset, this);

               place--;

               if(place < 0)
                  done = true;
                  
               break;

            case 4:  // ScrollUp
               pixmap.copyArea(0,ledsize,WIDTH,HEIGHT-ledsize,0,-ledsize);
               
               for(i=0;i<WIDTH;i+=ledsize)
                  if(msg.inRange(i/ledsize))
                     drawLED(i,HEIGHT-ledsize,msg.getLED(i/ledsize,place),msg.getColor(i/ledsize),pixmap);
                  else
                     drawLED(i,HEIGHT-ledsize,false,1,pixmap);

               gr.drawImage(pixmapimg,offset,offset, this);
               
               place++;

               if(place >= h)
                  done = true;
                  
               break;

            case 5:  // ScrollDown
               pixmap.copyArea(0,0,WIDTH,HEIGHT-ledsize,0,ledsize);
               
               for(i=0;i<WIDTH;i+=ledsize)
                  if(msg.inRange(i/ledsize))
                  {
                     drawLED(i,0,msg.getLED(i/ledsize,place),msg.getColor(i/ledsize),pixmap);
                  }
                  else
                  {
                     drawLED(i,0,false,1,pixmap);
                  }

               gr.drawImage(pixmapimg,offset,offset, this);
               
               place--;

               if(place < 0)
                  done = true;

               break;

            case 6: // Pixel
               i = place + fi.times;
               while(place < WIDTH/ledsize*h && place < i)
               {
                  if(msg.inRange(pix[place].x))
                  {
                     drawLED(pix[place].x*ledsize,pix[place].y*ledsize,msg.getLED(pix[place].x,pix[place].y),msg.getColor(pix[place].x),pixmap);
                  }
                  else
                  {
                     drawLED(pix[place].x*ledsize,pix[place].y*ledsize,false,1,pixmap);
                  }

                  place++;
               }
               gr.drawImage(pixmapimg,offset,offset, this);
               
               if(place >= w*h)
                  done = true;
               
               break;
               
            case 7:  // Blink
               if(place%2 == 0)
                  gr.drawImage(offimg,offset,offset, this);
               else
                  gr.drawImage(pixmapimg,offset,offset, this);

               place--;

               if(place == 0)
                  done = true;

               break;

            case 8:  // OverRight
               if(msg.inRange(place))
                  for(i=0;i<h;i++)
                     drawLED(place*ledsize,i*ledsize,msg.getLED(place,i),msg.getColor(place),pixmap);
               else
                  for(i=0;i<h;i++)
                     drawLED(place*ledsize,i*ledsize,false,1,pixmap);

               gr.drawImage(pixmapimg,offset,offset, this);

               place++;

               if(place >= w)
                  done = true;

               break;
                     
            case 9:  // ScrollCenter
               // The right side
               if(w >= place*2)
               {
                  pixmap.copyArea(WIDTH/2,0,WIDTH/2-ledsize,HEIGHT,ledsize,0);
                  for(i=0;i<h;i++)
                     if(msg.inRange(w-place))
                        drawLED(WIDTH/2,i*ledsize,msg.getLED(w-place,i),msg.getColor(w-place),pixmap);
                     else
                        drawLED(WIDTH/2,i*ledsize,false,1,pixmap);
               }

               if(place < w/2)
               {
                  pixmap.copyArea(ledsize,0,WIDTH/2-ledsize,HEIGHT,-ledsize,0);
                  for(i=0;i<h;i++)
                     if(msg.inRange(place))
                        drawLED(WIDTH/2-ledsize,i*ledsize,msg.getLED(place,i),msg.getColor(place),pixmap);
                     else
                        drawLED(WIDTH/2-ledsize,i*ledsize,false,1,pixmap);
               }

               gr.drawImage(pixmapimg,offset,offset, this);
               
               place++;

               if(place >= w/2 && place*2 > w)
                  done = true;

               break;

            case 10:  // OverCenter
               // The right side
               if(w >= place+w/2)
               {
                  for(i=0;i<h;i++)
                     if(msg.inRange(w/2+place+1))
                        drawLED(WIDTH/2+place*ledsize+ledsize,i*ledsize,msg.getLED(w/2+place+1,i),msg.getColor(w/2+place+1),pixmap);
                     else
                        drawLED(WIDTH/2+place*ledsize+ledsize,i*ledsize,false,1,pixmap);
               }

               if(place < w/2)
               {
                  for(i=0;i<h;i++)
                     if(msg.inRange(w/2-place))
                        drawLED(WIDTH/2-place*ledsize,i*ledsize,msg.getLED(w/2-place,i),msg.getColor(w/2-place),pixmap);
                     else
                        drawLED(WIDTH/2-place*ledsize,i*ledsize,false,1,pixmap);
               }

               gr.drawImage(pixmapimg,offset,offset, this);
               
               place++;

               if(w < w/2+place && place >= w/2)
                  done = true;

               break;

            case 11:  // OverLeft
               if(msg.inRange(place))
                  for(i=0;i<h;i++)
                     drawLED(place*ledsize,i*ledsize,msg.getLED(place,i),msg.getColor(place),pixmap);
               else
                  for(i=0;i<h;i++)
                     drawLED(place*ledsize,i*ledsize,false,1,pixmap);

               gr.drawImage(pixmapimg,offset,offset, this);

               place--;

               if(place == 0)
                  done = true;

               break;
               
            case 12:  // OverUp
               for(i=0;i<w;i++)
               {
                  if(msg.inRange(i))
                     drawLED(i*ledsize,place*ledsize,msg.getLED(i,place),msg.getColor(i),pixmap);
                  else
                     drawLED(i*ledsize,place*ledsize,false,1,pixmap);
               }

               gr.drawImage(pixmapimg,offset,offset, this);

               place--;

               if(place < 0)
                  done = true;

               break;

            case 13:  // OverDown
               for(i=0;i<w;i++)
               {
                  if(msg.inRange(i))
                     drawLED(i*ledsize,place*ledsize,msg.getLED(i,place),msg.getColor(i),pixmap);
                  else
                     drawLED(i*ledsize,place*ledsize,false,1,pixmap);
               }

               gr.drawImage(pixmapimg,offset,offset, this);

               place++;

               if(place >= h)
                  done = true;

               break;
         }  // End switch() statement
      }  // End if(led != null)

      return;

   }  // End update()
}  // End LED class
