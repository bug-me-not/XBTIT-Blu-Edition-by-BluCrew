<?php 
header('Content-Type:text/css');
include_once('_theme.config.php')?>
/*
* jQuery UI CSS Framework extend
* Copyright (c) 2009 AUTHORS.txt (http://ui.jquery.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
*?<?php foreach($themes as $key=>$value){
      echo $key.'='.$value.'&';
      }
?>

*/
/*layout*/
.ui-layout{ border: 1px solid #<?php echo $themes["borderColorLayout"]?>; color: #<?php echo $themes["fcLayout"]?>; }
.ui-layout a { color: #<?php echo $themes["lcLayout"]?>; }
/*toolbar*/
.ui-toolbar{ border: 1px solid #<?php echo $themes["borderColorToolbar"]?>; <?php echo texture_bg("bgColorToolbar","bgTextureToolbar","bgImgOpacityToolbar")?> color: #<?php echo $themes["fcToolbar"]?>; }
.ui-toolbar a{ color: #<?php echo $themes["lcToolbar"]?>; }
/* Component containers
----------------------------------*/
.ui-widget { font-family: <?php echo $themes["ffDefault"]?>; font-size: <?php echo $themes["fsDefault"]?>; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: <?php echo $themes["ffDefault"]?>; font-size: 1em; }
.ui-widget-content { border: 1px solid #<?php echo $themes["borderColorContent"]?>; <?php echo texture_bg("bgColorContent","bgTextureContent","bgImgOpacityContent")?> color: #<?php echo $themes["fcContent"]?>; }
.ui-widget-content a { color: #<?php echo $themes["lcContent"]?>; }
.ui-widget-header { border: 1px solid #<?php echo $themes["borderColorHeader"]?>; <?php echo texture_bg("bgColorHeader","bgTextureHeader","bgImgOpacityHeader")?> color: #<?php echo $themes["fcHeader"]?>; font-weight: bold; }
.ui-widget-header a { color: #<?php echo $themes["lcHeader"]?>; }

/* Interaction states
----------------------------------*/
/*light*/
.ui-state-light, .ui-widget-content .ui-state-light ,.ui-layout .ui-state-light{border: 1px solid #<?php echo $themes["borderColorLight"]?>; <?php echo texture_bg("bgColorLight","bgTextureLight","bgImgOpacityLight")?> color: #<?php echo $themes["fcLight"]?>; }
.ui-state-light a{color: #<?php echo $themes["lcLight"]?>; }
.ui-state-light .ui-icon {<?php echo texture_bg("iconColorLight")?> }

.ui-state-default, .ui-widget-content .ui-state-default , .ui-layout .ui-state-default{ border: 1px solid #<?php echo $themes["borderColorDefault"]?>; <?php echo texture_bg("bgColorDefault","bgTextureDefault","bgImgOpacityDefault")?> font-weight: <?php echo $themes["fwDefault"]?>; color: #<?php echo $themes["fcDefault"]?>; outline: none; }

.ui-state-default a { color: #<?php echo $themes["fcDefault"]?>; text-decoration: none; outline: none; }

.ui-state-hover, .ui-widget-content .ui-state-hover ,.ui-layout .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus ,.ui-layout .ui-state-focus { border: 1px solid #<?php echo $themes["borderColorHover"]?>; <?php echo texture_bg("bgColorHover","bgTextureHover","bgImgOpacityHover")?> font-weight: <?php echo $themes["fwDefault"]?>; color: #<?php echo $themes["fcHover"]?>; outline: none; }

.ui-state-hover a { color: #<?php echo $themes["fcHover"]?>; text-decoration: none; outline: none; }

.ui-state-active, .ui-widget-content .ui-state-active ,.ui-layout .ui-state-active { border: 1px solid #<?php echo $themes["borderColorActive"]?>; <?php echo texture_bg("bgColorActive","bgTextureActive","bgImgOpacityActive")?> font-weight: <?php echo $themes["fwDefault"]?>; color: #<?php echo $themes["fcActive"]?>; outline: none; }

.ui-state-active a { color: #<?php echo $themes["fcActive"]?>; outline: none; text-decoration: none; }
/*input*/
.ui-input,.ui-widget-content .ui-input{
    border: 1px solid #<?php echo $themes["borderColorInput"]?>; <?php echo texture_bg("bgColorInput","bgTextureInput","bgImgOpacityInput")?> color: #<?php echo $themes["fcInput"]?>;
}
.ui-input .ui-icon {<?php echo texture_bg("iconColorInput")?> }

/* Interaction Cues
----------------------------------*/
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-layout .ui-state-highlight {border: 1px solid #<?php echo $themes["borderColorHighlight"]?>; <?php echo texture_bg("bgColorHighlight","bgTextureHighlight","bgImgOpacityHighlight")?> color: #<?php echo $themes["fcHighlight"]?>; }
.ui-state-highlight a{color: #<?php echo $themes["lcHighlight"]?>; }
.ui-state-error, .ui-widget-content .ui-state-error , .ui-layout .ui-state-error {border: 1px solid #<?php echo $themes["borderColorError"]?>; <?php echo texture_bg("bgColorError","bgTextureError","bgImgOpacityError")?> color: #<?php echo $themes["fcError"]?>; }
.ui-state-error a{color: #<?php echo $themes["lcError"]?>; }
.ui-state-error-text, .ui-widget-content .ui-state-error-text { color: #<?php echo $themes["fcError"]?>; }
.ui-state-disabled, .ui-widget-content .ui-state-disabled { opacity: .35; filter:Alpha(Opacity=35); background-image: none; }
.ui-priority-primary, .ui-widget-content .ui-priority-primary { font-weight: bold; }
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary { opacity: .7; filter:Alpha(Opacity=70); font-weight: <?php echo $themes["fwDefault"]?>; }


/* Icons
----------------------------------*/

/* states and images */
.ui-icon { width: 16px; height: 16px; <?php echo texture_bg("iconColorContent")?> }
.ui-widget-content .ui-icon {<?php echo texture_bg("iconColorContent")?> }
.ui-widget-header .ui-icon {<?php echo texture_bg("iconColorHeader")?> }
.ui-state-default .ui-icon { <?php echo texture_bg("iconColorDefault")?> }
.ui-state-hover .ui-icon, .ui-state-focus .ui-icon {<?php echo texture_bg("iconColorHover")?> }
.ui-state-active .ui-icon {<?php echo texture_bg("iconColorActive")?> }
.ui-state-highlight .ui-icon {<?php echo texture_bg("iconColorHighlight")?> }
.ui-state-error .ui-icon, .ui-state-error-text .ui-icon {<?php echo texture_bg("iconColorError")?> }

/* positioning */
.ui-icon-carat-1-n { background-position: 0 0; }
.ui-icon-carat-1-ne { background-position: -16px 0; }
.ui-icon-carat-1-e { background-position: -32px 0; }
.ui-icon-carat-1-se { background-position: -48px 0; }
.ui-icon-carat-1-s { background-position: -64px 0; }
.ui-icon-carat-1-sw { background-position: -80px 0; }
.ui-icon-carat-1-w { background-position: -96px 0; }
.ui-icon-carat-1-nw { background-position: -112px 0; }
.ui-icon-carat-2-n-s { background-position: -128px 0; }
.ui-icon-carat-2-e-w { background-position: -144px 0; }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-icon-triangle-1-sw { background-position: -80px -16px; }
.ui-icon-triangle-1-w { background-position: -96px -16px; }
.ui-icon-triangle-1-nw { background-position: -112px -16px; }
.ui-icon-triangle-2-n-s { background-position: -128px -16px; }
.ui-icon-triangle-2-e-w { background-position: -144px -16px; }
.ui-icon-arrow-1-n { background-position: 0 -32px; }
.ui-icon-arrow-1-ne { background-position: -16px -32px; }
.ui-icon-arrow-1-e { background-position: -32px -32px; }
.ui-icon-arrow-1-se { background-position: -48px -32px; }
.ui-icon-arrow-1-s { background-position: -64px -32px; }
.ui-icon-arrow-1-sw { background-position: -80px -32px; }
.ui-icon-arrow-1-w { background-position: -96px -32px; }
.ui-icon-arrow-1-nw { background-position: -112px -32px; }
.ui-icon-arrow-2-n-s { background-position: -128px -32px; }
.ui-icon-arrow-2-ne-sw { background-position: -144px -32px; }
.ui-icon-arrow-2-e-w { background-position: -160px -32px; }
.ui-icon-arrow-2-se-nw { background-position: -176px -32px; }
.ui-icon-arrowstop-1-n { background-position: -192px -32px; }
.ui-icon-arrowstop-1-e { background-position: -208px -32px; }
.ui-icon-arrowstop-1-s { background-position: -224px -32px; }
.ui-icon-arrowstop-1-w { background-position: -240px -32px; }
.ui-icon-arrowthick-1-n { background-position: 0 -48px; }
.ui-icon-arrowthick-1-ne { background-position: -16px -48px; }
.ui-icon-arrowthick-1-e { background-position: -32px -48px; }
.ui-icon-arrowthick-1-se { background-position: -48px -48px; }
.ui-icon-arrowthick-1-s { background-position: -64px -48px; }
.ui-icon-arrowthick-1-sw { background-position: -80px -48px; }
.ui-icon-arrowthick-1-w { background-position: -96px -48px; }
.ui-icon-arrowthick-1-nw { background-position: -112px -48px; }
.ui-icon-arrowthick-2-n-s { background-position: -128px -48px; }
.ui-icon-arrowthick-2-ne-sw { background-position: -144px -48px; }
.ui-icon-arrowthick-2-e-w { background-position: -160px -48px; }
.ui-icon-arrowthick-2-se-nw { background-position: -176px -48px; }
.ui-icon-arrowthickstop-1-n { background-position: -192px -48px; }
.ui-icon-arrowthickstop-1-e { background-position: -208px -48px; }
.ui-icon-arrowthickstop-1-s { background-position: -224px -48px; }
.ui-icon-arrowthickstop-1-w { background-position: -240px -48px; }
.ui-icon-arrowreturnthick-1-w { background-position: 0 -64px; }
.ui-icon-arrowreturnthick-1-n { background-position: -16px -64px; }
.ui-icon-arrowreturnthick-1-e { background-position: -32px -64px; }
.ui-icon-arrowreturnthick-1-s { background-position: -48px -64px; }
.ui-icon-arrowreturn-1-w { background-position: -64px -64px; }
.ui-icon-arrowreturn-1-n { background-position: -80px -64px; }
.ui-icon-arrowreturn-1-e { background-position: -96px -64px; }
.ui-icon-arrowreturn-1-s { background-position: -112px -64px; }
.ui-icon-arrowrefresh-1-w { background-position: -128px -64px; }
.ui-icon-arrowrefresh-1-n { background-position: -144px -64px; }
.ui-icon-arrowrefresh-1-e { background-position: -160px -64px; }
.ui-icon-arrowrefresh-1-s { background-position: -176px -64px; }
.ui-icon-arrow-4 { background-position: 0 -80px; }
.ui-icon-arrow-4-diag { background-position: -16px -80px; }
.ui-icon-extlink { background-position: -32px -80px; }
.ui-icon-newwin { background-position: -48px -80px; }
.ui-icon-refresh { background-position: -64px -80px; }
.ui-icon-shuffle { background-position: -80px -80px; }
.ui-icon-transfer-e-w { background-position: -96px -80px; }
.ui-icon-transferthick-e-w { background-position: -112px -80px; }
.ui-icon-folder-collapsed { background-position: 0 -96px; }
.ui-icon-folder-open { background-position: -16px -96px; }
.ui-icon-document { background-position: -32px -96px; }
.ui-icon-document-b { background-position: -48px -96px; }
.ui-icon-note { background-position: -64px -96px; }
.ui-icon-mail-closed { background-position: -80px -96px; }
.ui-icon-mail-open { background-position: -96px -96px; }
.ui-icon-suitcase { background-position: -112px -96px; }
.ui-icon-comment { background-position: -128px -96px; }
.ui-icon-person { background-position: -144px -96px; }
.ui-icon-print { background-position: -160px -96px; }
.ui-icon-trash { background-position: -176px -96px; }
.ui-icon-locked { background-position: -192px -96px; }
.ui-icon-unlocked { background-position: -208px -96px; }
.ui-icon-bookmark { background-position: -224px -96px; }
.ui-icon-tag { background-position: -240px -96px; }
.ui-icon-home { background-position: 0 -112px; }
.ui-icon-flag { background-position: -16px -112px; }
.ui-icon-calendar { background-position: -32px -112px; }
.ui-icon-cart { background-position: -48px -112px; }
.ui-icon-pencil { background-position: -64px -112px; }
.ui-icon-clock { background-position: -80px -112px; }
.ui-icon-disk { background-position: -96px -112px; }
.ui-icon-calculator { background-position: -112px -112px; }
.ui-icon-zoomin { background-position: -128px -112px; }
.ui-icon-zoomout { background-position: -144px -112px; }
.ui-icon-search { background-position: -160px -112px; }
.ui-icon-wrench { background-position: -176px -112px; }
.ui-icon-gear { background-position: -192px -112px; }
.ui-icon-heart { background-position: -208px -112px; }
.ui-icon-star { background-position: -224px -112px; }
.ui-icon-link { background-position: -240px -112px; }
.ui-icon-cancel { background-position: 0 -128px; }
.ui-icon-plus { background-position: -16px -128px; }
.ui-icon-plusthick { background-position: -32px -128px; }
.ui-icon-minus { background-position: -48px -128px; }
.ui-icon-minusthick { background-position: -64px -128px; }
.ui-icon-close { background-position: -80px -128px; }
.ui-icon-closethick { background-position: -96px -128px; }
.ui-icon-key { background-position: -112px -128px; }
.ui-icon-lightbulb { background-position: -128px -128px; }
.ui-icon-scissors { background-position: -144px -128px; }
.ui-icon-clipboard { background-position: -160px -128px; }
.ui-icon-copy { background-position: -176px -128px; }
.ui-icon-contact { background-position: -192px -128px; }
.ui-icon-image { background-position: -208px -128px; }
.ui-icon-video { background-position: -224px -128px; }
.ui-icon-script { background-position: -240px -128px; }
.ui-icon-alert { background-position: 0 -144px; }
.ui-icon-info { background-position: -16px -144px; }
.ui-icon-notice { background-position: -32px -144px; }
.ui-icon-help { background-position: -48px -144px; }
.ui-icon-check { background-position: -64px -144px; }
.ui-icon-bullet { background-position: -80px -144px; }
.ui-icon-radio-off { background-position: -96px -144px; }
.ui-icon-radio-on { background-position: -112px -144px; }
.ui-icon-pin-w { background-position: -128px -144px; }
.ui-icon-pin-s { background-position: -144px -144px; }
.ui-icon-play { background-position: 0 -160px; }
.ui-icon-pause { background-position: -16px -160px; }
.ui-icon-seek-next { background-position: -32px -160px; }
.ui-icon-seek-prev { background-position: -48px -160px; }
.ui-icon-seek-end { background-position: -64px -160px; }
.ui-icon-seek-first { background-position: -80px -160px; }
.ui-icon-stop { background-position: -96px -160px; }
.ui-icon-eject { background-position: -112px -160px; }
.ui-icon-volume-off { background-position: -128px -160px; }
.ui-icon-volume-on { background-position: -144px -160px; }
.ui-icon-power { background-position: 0 -176px; }
.ui-icon-signal-diag { background-position: -16px -176px; }
.ui-icon-signal { background-position: -32px -176px; }
.ui-icon-battery-0 { background-position: -48px -176px; }
.ui-icon-battery-1 { background-position: -64px -176px; }
.ui-icon-battery-2 { background-position: -80px -176px; }
.ui-icon-battery-3 { background-position: -96px -176px; }
.ui-icon-circle-plus { background-position: 0 -192px; }
.ui-icon-circle-minus { background-position: -16px -192px; }
.ui-icon-circle-close { background-position: -32px -192px; }
.ui-icon-circle-triangle-e { background-position: -48px -192px; }
.ui-icon-circle-triangle-s { background-position: -64px -192px; }
.ui-icon-circle-triangle-w { background-position: -80px -192px; }
.ui-icon-circle-triangle-n { background-position: -96px -192px; }
.ui-icon-circle-arrow-e { background-position: -112px -192px; }
.ui-icon-circle-arrow-s { background-position: -128px -192px; }
.ui-icon-circle-arrow-w { background-position: -144px -192px; }
.ui-icon-circle-arrow-n { background-position: -160px -192px; }
.ui-icon-circle-zoomin { background-position: -176px -192px; }
.ui-icon-circle-zoomout { background-position: -192px -192px; }
.ui-icon-circle-check { background-position: -208px -192px; }
.ui-icon-circlesmall-plus { background-position: 0 -208px; }
.ui-icon-circlesmall-minus { background-position: -16px -208px; }
.ui-icon-circlesmall-close { background-position: -32px -208px; }
.ui-icon-squaresmall-plus { background-position: -48px -208px; }
.ui-icon-squaresmall-minus { background-position: -64px -208px; }
.ui-icon-squaresmall-close { background-position: -80px -208px; }
.ui-icon-grip-dotted-vertical { background-position: 0 -224px; }
.ui-icon-grip-dotted-horizontal { background-position: -16px -224px; }
.ui-icon-grip-solid-vertical { background-position: -32px -224px; }
.ui-icon-grip-solid-horizontal { background-position: -48px -224px; }
.ui-icon-gripsmall-diagonal-se { background-position: -64px -224px; }
.ui-icon-grip-diagonal-se { background-position: -80px -224px; }


/* Misc visuals
----------------------------------*/

/* Corner radius */
.ui-corner-tl { -moz-border-radius-topleft: <?php echo $themes["cornerRadius"]?>; -webkit-border-top-left-radius: <?php echo $themes["cornerRadius"]?>;

	-khtml-border-top-left-radius: <?php echo $themes["cornerRadius"]?>;
	border-top-left-radius: <?php echo $themes["cornerRadius"]?>;
}
.ui-corner-tr { -moz-border-radius-topright: <?php echo $themes["cornerRadius"]?>; -webkit-border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
	-khtml-border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
	border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
     }
     .ui-corner-bl { -moz-border-radius-bottomleft: <?php echo $themes["cornerRadius"]?>; -webkit-border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
	-khtml-border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
	border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
  }
  .ui-corner-br { -moz-border-radius-bottomright: <?php echo $themes["cornerRadius"]?>; -webkit-border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>; 
	-khtml-border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>;
	border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>;
  }
  .ui-corner-top { -moz-border-radius-topleft: <?php echo $themes["cornerRadius"]?>; -webkit-border-top-left-radius: <?php echo $themes["cornerRadius"]?>; -moz-border-radius-topright: <?php echo $themes["cornerRadius"]?>; -webkit-border-top-right-radius: <?php echo $themes["cornerRadius"]?>; 
	-khtml-border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
	border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
	-khtml-border-top-left-radius: <?php echo $themes["cornerRadius"]?>;
	border-top-left-radius: <?php echo $themes["cornerRadius"]?>;
  }
  .ui-corner-bottom { -moz-border-radius-bottomleft: <?php echo $themes["cornerRadius"]?>; -webkit-border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>; -moz-border-radius-bottomright: <?php echo $themes["cornerRadius"]?>; -webkit-border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>; 
	-khtml-border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
	border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
	-khtml-border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>;
	border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>;
  }
  .ui-corner-right {  -moz-border-radius-topright: <?php echo $themes["cornerRadius"]?>; -webkit-border-top-right-radius: <?php echo $themes["cornerRadius"]?>; -moz-border-radius-bottomright: <?php echo $themes["cornerRadius"]?>; -webkit-border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>; 
	-khtml-border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
	border-top-right-radius: <?php echo $themes["cornerRadius"]?>;
	-khtml-border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>;
	border-bottom-right-radius: <?php echo $themes["cornerRadius"]?>;
  }
  .ui-corner-left { -moz-border-radius-topleft: <?php echo $themes["cornerRadius"]?>; -webkit-border-top-left-radius: <?php echo $themes["cornerRadius"]?>; -moz-border-radius-bottomleft: <?php echo $themes["cornerRadius"]?>; -webkit-border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>; 
	-khtml-border-top-left-radius: <?php echo $themes["cornerRadius"]?>;
	border-top-left-radius: <?php echo $themes["cornerRadius"]?>;
	-khtml-border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
	border-bottom-left-radius: <?php echo $themes["cornerRadius"]?>;
  }
  .ui-corner-all { -moz-border-radius: <?php echo $themes["cornerRadius"]?>; -webkit-border-radius: <?php echo $themes["cornerRadius"]?>; 
	-khtml-border-radius: <?php echo $themes["cornerRadius"]?>;
	border-radius: <?php echo $themes["cornerRadius"]?>;
  }

/* Overlays */
.ui-widget-overlay { <?php echo texture_bg("bgColorOverlay","bgTextureOverlay","bgImgOpacityOverlay")?> opacity: .<?php echo $themes["opacityOverlay"]?>;filter:Alpha(Opacity=<?php echo $themes["opacityOverlay"]?>); }
.ui-widget-shadow { margin: <?php echo $themes["offsetTopShadow"]?> 0 0 <?php echo $themes["offsetLeftShadow"]?>; padding: <?php echo $themes["thicknessShadow"]?>; <?php echo texture_bg("bgColorShadow","bgTextureShadow","bgImgOpacityShadow")?> opacity: .<?php echo $themes["opacityShadow"]?>;filter:Alpha(Opacity=<?php echo $themes["opacityShadow"]?>); -moz-border-radius: <?php echo $themes["cornerRadiusShadow"]?>; -webkit-border-radius: <?php echo $themes["cornerRadiusShadow"]?>; }
