<?php
    /*
        -------------------------------------------------------------------
        NFO Viewer v1 by Richard Davey, Core PHP (rich@corephp.co.uk)
        Released 3rd May 2007
        Includes base font from the Damn NFO Viewer
        -------------------------------------------------------------------
        You are free to use this in any product, or on any web site.
        I'd appreciate it if you email and tell me where you use it, thanks.
        Latest builds at: http://nfo.corephp.co.uk
        -------------------------------------------------------------------
        
        This script accepts the following $_REQUEST parameters:
        
        bg              optional        The background colour of the image (default black)
        filename        required        The NFO file to load and display
        colour          required        The font to use when rendering
    */

    //  This should be set to the top level directory where the NFO files exist.
    //  For example if the NFO files live in: /usr/corephp/www/nfo
    //  then that is what baredir should point to. If this file sits one level below the NFOs
    //  then you can leave this line un-changed.
    //  XBTIT DT FM 2014
    $basedir = dirname(__FILE__);

    //    PHP Version sanity check
    if (version_compare('4.0.6', phpversion()) == 1)
    {
        echo 'This version of PHP is not fully supported. You need 4.0.6 or above.';
        exit();
    }

    //    GD check
    if (extension_loaded('gd') == false && !dl('gd.so'))
    {
        echo 'You are missing the GD extension for PHP, sorry but I cannot continue.';
        exit();
    }

    //    bgc (the background colour used, defaults to black if not given)
    if (isset($_REQUEST['bg']) == false)
    {
        $red = 0;
        $green = 0;
        $blue = 0;
    }
    else
    {
        //    Extract the hex colour
        $hex_bgc = $_REQUEST['bg'];
        
        //    Does it start with a hash? If so then strip it
        $hex_bgc = str_replace('#', '', $hex_bgc);
        
        switch (strlen($hex_bgc))
        {
            case 6:
                $red = hexdec(substr($hex_bgc, 0, 2));
                $green = hexdec(substr($hex_bgc, 2, 2));
                $blue = hexdec(substr($hex_bgc, 4, 2));
                break;
                
            case 3:
                $red = substr($hex_bgc, 0, 1);
                $green = substr($hex_bgc, 1, 1);
                $blue = substr($hex_bgc, 2, 1);
                $red = hexdec($red . $red);
                $green = hexdec($green . $green);
                $blue = hexdec($blue . $blue);
                break;
                
            default:
                //    Wrong values passed, default to black
                $red = 0;
                $green = 0;
                $blue = 0;
        }
    }

	$filename = $_REQUEST['nfo'];
	$colour = $_REQUEST['colour'];
    
    if (file_exists("$basedir/$filename"))
    {
        $nfo = file("$basedir/$filename");
    }
    else
    {
        echo "Aborting, cannot find or read from $basedir/$filename - is the path correct?";
        exit();
    }
    
    $fontpath = dirname(__FILE__);
    
    if (file_exists("$fontpath/nfogen.png"))
    {
        $fontset = imagecreatefrompng("$fontpath/nfogen.png");
    }
    else
    {
        echo "Aborting, cannot find the required fontset nfogen.png in path: $fontpath";
        exit();
    }

	$x = 0;
	$y = 0;
	$fontx = 5;
	$fonty = 12;
	$colour = $colour * $fonty;
	
	//	Calculate max width and height of image needed - height is easy, do first:
	$image_height = count($nfo) * 12;
	$image_width = 0;

	//	Width needs a loop through the text
	for ($c = 0; $c < count($nfo); $c++)
	{
		$line = $nfo[$c];
		$temp_len = strlen($line);
		if ($temp_len > $image_width)
		{
			$image_width = $temp_len;
		}
	}

	$image_width = $image_width * $fontx;
	
	//	Sanity Checks
	if ($image_width > 1600)
	{
		$image_width = 1600;
	}

    $im = imagecreatetruecolor($image_width, $image_height);
    $bgc = imagecolorallocate($im, $red, $green, $blue);
    imagefill($im, 0, 0, $bgc);
	
	for ($c = 0; $c < count($nfo); $c++)
	{
		$x = $fontx;
		$line = $nfo[$c];

		for ($i = 0; $i < strlen($line); $i++)
		{
			$current_char = substr($line, $i, 1);
			if ($current_char !== "\r" && $current_char !== "\n")
			{
				$offset = ord($current_char) * 5;
				imagecopy($im, $fontset, $x, $y, $offset, $colour, $fontx, $fonty);
				$x += $fontx;
			}
		}

		$y += $fonty;
	}

	header("Content-type: image/png");
	imagepng($im);
	imagedestroy($im);
?>