/*************************************************************************************************
* Floatbox v2.46
*
* Image and IFrame viewer by Byron McGregor
*   August 06, 2008
*   Website: http://randomous.com/tools/floatbox/
* License: Creative Commons Attribution 3.0 License (http://creativecommons.org/licenses/by/3.0/)
* This comment block must be retained in all deployments and distributions.
* Credit: Derived from Lytebox v3.22, the original work of Markus F. Hay.
*   Website: http://www.dolem.com/lytebox/
*   Lytebox was originally derived from the Lightbox class (v2.02), written by Lokesh Dhakar.
*   Website: http://huddletogether.com/projects/lightbox2/
*************************************************************************************************/

function Floatbox() {
	this.defaultOptions = {

/***** BEGIN OPTIONS CONFIGURATION *****/
// see docs/options.html for detailed descriptions

/*** <General Options> ***/
theme:          'auto'   ,// 'auto'|'black'|'white'|'blue'|'yellow'|'red'|'custom'
padding:         12      ,// pixels
panelPadding:    8       ,// pixels
outerBorder:     4       ,// pixels
innerBorder:     1       ,// pixels
autoResize:      true    ,// true|false
overlayOpacity:  80      ,// 0-100
upperOpacity:    65      ,// 0-100
showResize:      true    ,// true|false
showCaption:     true    ,// true|false
showItemNumber:  true    ,// true|false
showClose:       true    ,// true|false
hideFlash:       true    ,// true|false
hideJava:        true    ,// true|false
preloadAll:      true    ,// true|false
disableScroll:   false   ,// true|false
enableCookies:   false   ,// true|false
cookieScope:    'site'   ,// 'site'|'folder'
url404Image:    '/floatbox/images/404.jpg'  ,// change this if you install in another folder
/*** </General Options> ***/

/*** <Navigation Options> ***/
navType:            'both'  ,// 'upper'|'lower'|'both'|'none'
upperNavWidth:       42     ,// 0-50
upperNavPos:         20     ,// 0-100
showUpperNav:       'once'  ,// 'always'|'once'|'never'
showHints:          'once'  ,// 'always'|'once'|'never'
enableWrap:          true   ,// true|false
enableKeyboardNav:   true   ,// true|false
outsideClickCloses:  true   ,// true|false
/*** </Navigation Options> ***/

/*** <Animation Options> ***/
resizeOrder:         'both'  ,// 'both'|'width'|'height'|'random'
resizeDuration:       5.5    ,// 0-10
imageFadeDuration:    4.5    ,// 0-10
overlayFadeDuration:  0      ,// 0-10
/*** </Animation Options> ***/

/*** <Slideshow Options> ***/
slideInterval:  4.1    ,// seconds
endTask:       'exit'  ,// 'stop'|'exit'|'loop'
showPlayPause:  true   ,// true|false
startPaused:    false  ,// true|false
pauseOnPrev:    true   ,// true|false
pauseOnNext:    false  ,// true|false
/*** </Slideshow Options> ***/

/*** <String Localization> ***/
strHintClose:    'exit (kbd: esc)'       ,
strHintPrev:     'prev (kbd: lt.arrow)'  ,
strHintNext:     'next (kbd: rt.arrow)'  ,
strHintPlay:     'play (kbd: spacebar)'  ,
strHintPause:    'pause (kbd: spacebar)' ,
strHintResize:   'resize (kbd: tab)'     ,
strImageCount:   'image %1 of %2'        ,
strIframeCount:  'page %1 of %2'         };
/*** </String Localization> ***/

/***** END OPTIONS CONFIGURATION *****/

// setup some global vars
	this.win = top;
	this.doc = this.win.document;
	this.bod = this.doc.body;
	this.arrAnchors = [];
	this.arrImageHrefs = [];
	this.arrItems = [];
	this.arrResize1 = [];
	this.arrResize2 = [];
	this.objTimeouts = {};
	this.objHiddenElements = {};
	this.objImagePreloads = {};
	this.preloadCount = 0;
// things that could be configurable options but are here as constants instead
	this.lowerPanelSpace = 24;  // gap between infoPanel and controlPanel
	this.controlSpacing = 8; // gap between control panel gadgets
	this.resizeSpace = 6;  // extra pixels outside of resized floatbox
	this.initialSize = 300;  // width and height of floatbox on first load
	this.showHintsTime = 1600; // minimum milliseconds tooltip hints must be shown before they can be cleared
// browser detects
	if (window.opera) {
		this.operaOld = !document.getElementsByClassName;
		this.operaQuirks = this.doc.compatMode == 'BackCompat';
	} else if (document.all) {
		this.ie = true;
		this.ieOld = false /*@cc_on || @_jscript_version < 5.7 @*/;
		this.ieQuirks = this.doc.compatMode == 'BackCompat';
	} else if (navigator.userAgent.indexOf('Firefox') != -1) {
		this.ffOld = !document.getElementsByClassName;
		this.ffNew = !this.ffOld;
	}
};

Floatbox.prototype = {

//******************************************************************************************/
// tagAnchors()
// Set anchor actions, build anchor array, get array of images to preload, and set autoStart
//******************************************************************************************/
tagAnchors: function(doc) {
	// navigation or reloads in child frames may have de-referenced previously captured anchors.  Remove them
	if (!window.opera) {  // the code inside the try will crash opera if the anchor is gone from the doc
		var i = this.arrAnchors.length;
		while (i--) {
			try {
				var x = this.arrAnchors[i].href;  // can we talk to it?
			} catch(e) {
				this.arrAnchors.splice(i, 1);  // no, discard it
			}
		}
	}
	// regexps we will need
	var reIsFbxd = /^(?:gallery|iframe|slideshow|lytebox|lyteshow|lyteframe|lightbox)/i;
	var reIsImg = /\.(?:jpg|jpeg|png|gif|bmp)\s*$/i;
	var reAuto = /autoStart\s*[:=]\s*true/i;
	// activated anchors do this
	var click = function () { fb.start(this); return false; };
	// process one anchor
	function tagAnchor(anchor) {
		var href = anchor.getAttribute('href');
		var rel = anchor.getAttribute('rel');
		var rev = anchor.getAttribute('rev');
		var title = anchor.getAttribute('title');
		if (reIsFbxd.test(rel)) {  // if one of the "pick me" strings is on the rel attribute...
			anchor.onclick = click;  // set onclick action
			// don't duplicate anchors on a child (i)frame refresh
			var i = (doc == fb.doc)? 0 : fb.arrAnchors.length;
			while (i--) {
				var prevAnchor = fb.arrAnchors[i];
				if (prevAnchor.getAttribute('href') == href &&
					prevAnchor.getAttribute('rel') == rel &&
					prevAnchor.getAttribute('rev') == rev &&
					prevAnchor.getAttribute('title') == title) {
					break;
				}
			}
			if (i == -1) {
				fb.arrAnchors.push(anchor);  // add to the array of anchors that will be used by start()
				if (reIsImg.test(href)) fb.arrImageHrefs.push(href);  // capture image refs for preloading
			}
			if (reAuto.test(rev)) fb.autoStart = anchor;  // look for autoStart rev option
		}
	};
	// <a> elements
	var anchors = doc.getElementsByTagName('a');
	for (var i = 0, len = anchors.length; i < len; i++) {
		tagAnchor(anchors[i]);
	}
	// image map <area> elements
	anchors = doc.getElementsByTagName('area');
	for (var i = 0, len = anchors.length; i < len; i++) {
		tagAnchor(anchors[i]);
	}
},

//*******************************************************/
// preloadNextImage()
// Preload passed image or next image from the array list
// Chains preloading until all images are done
//*******************************************************/
preloadNextImage: function(href) {
	if (!href && !this.blockPreloadChain && (this.defaultOptions.preloadAll || !this.preloadCount)) {
		for (var i = 0, len = this.arrImageHrefs.length; i < len; i++) {
			// find image href that isn't yet loaded
			var h = this.arrImageHrefs[i];
			if (!this.objImagePreloads[h]) {
				var href = h;
				break;
			}
		}
	}
	if (href) {  // from param or from the for loop
		this.preloadCount++;
		this.objImagePreloads[href] = new Image();
		// chain the next image when this one completes or errors out
		this.objImagePreloads[href].onload = this.objImagePreloads[href].onerror =
			function() { setTimeout(function() { fb.preloadNextImage() }, 200) };
		this.objImagePreloads[href].src = href;
	}
},

//******************************/
// setNode()
// Appends an element to the DOM
//******************************/
setNode: function(nodeType, id, parentNode, title) {
	var node = this.doc.getElementById(id);  // reuse existing elements on restarts
	if (!node) {  // build a new one
		node = this.doc.createElement(nodeType);
		if (id) node.id = id;
		if (nodeType == 'a') node.setAttribute('href', '#');
		if (title && this.showHints != 'never') node.setAttribute('title', title);
		if (nodeType == 'iframe') {
			node.setAttribute('scrolling', this.itemScrolling);
			node.setAttribute('frameBorder', '0');  // note: IE needs the capital B and will ignore changes to frameborder after the element is added to the DOM
			node.setAttribute('align', 'middle');
			node.src = 'javascript:("");';  // IE6 SSL fix
		}
		parentNode.appendChild(node);
	}
	// set changeable properties and hide everything on each start
	node.className = id + '_' + this.theme;
	node.style.display = 'none';
	return node;
},

//********************************************/
// buildDOM()
// Insert Floatbox elements into document body
//********************************************/
buildDOM: function() {

// Insert elements into the document body that look like the following:
//	<div id="fbOverlay"></div>
//	<div id="fbFloatbox">
//		<div id="fbLoader"></div>
//		<div id="fbContentPanel">
//			<img id="fbItem" />  ...or...  <iframe id="fbItem"></iframe>
//			<a id="fbLeftNav"></a>
//			<a id="fbRightNav"></a>
//			<a id="fbUpperPrev" title="this.strHintPrev"></a>
//			<a id="fbUpperNext" title="this.strHintNext"></a>
//			<a id="fbResize" title="this.strHintResize"></a>
//			<div id="fbInfoPanel">
//				<span id="fbCaption"></span>
//				<span id="fbItemNumber"></span>
//			</div>
//			<div id="fbControlPanel">
//				<div id="fbLowerNav">
//					<div id="fbLowerPrev">
//						<a id="fbLowerPrevA" title="this.strHintPrev"></a>
//					</div>
//					<div id="fbLowerNext">
//						<a id="fbLowerNextA" title="this.strHintNext"></a>
//					</div>
//				</div>
//				<div id="fbControls">
//					<a id="fbClose" title="this.strHintClose"></a>
//					<div id="fbPlayPause">
//						<a id="fbPlay" title="this.strHintPlay"></a>
//						<a id="fbPause" title="this.strHintPause"></a>
//					</div>
//				</div>
//			</div>
//		</div>
//	</div>

	this.fbOverlay		= this.setNode('div', 'fbOverlay', this.bod);
	this.fbFloatbox		= this.setNode('div', 'fbFloatbox', this.bod);
	this.fbLoader		= this.setNode('div', 'fbLoader', this.fbFloatbox);
	this.fbContentPanel	= this.setNode('div', 'fbContentPanel', this.fbFloatbox);
	// fbItem is inserted later
	if (this.upperNav) {
		this.fbLeftNav		= this.setNode('a', 'fbLeftNav', this.fbContentPanel);
		this.fbRightNav		= this.setNode('a', 'fbRightNav', this.fbContentPanel);
		this.fbUpperPrev	= this.setNode('a', 'fbUpperPrev', this.fbContentPanel, this.strHintPrev);
		this.fbUpperNext	= this.setNode('a', 'fbUpperNext', this.fbContentPanel, this.strHintNext);
	}
	this.fbResize		= this.setNode('a', 'fbResize', this.fbContentPanel, this.strHintResize);
	this.fbInfoPanel	= this.setNode('div', 'fbInfoPanel', this.fbContentPanel);
	this.fbCaption		= this.setNode('span', 'fbCaption', this.fbInfoPanel);
	this.fbItemNumber	= this.setNode('span', 'fbItemNumber', this.fbInfoPanel);
	this.fbControlPanel	= this.setNode('div', 'fbControlPanel', this.fbContentPanel);
	this.fbLowerNav		= this.setNode('div', 'fbLowerNav', this.fbControlPanel);
	this.fbLowerPrev	= this.setNode('div', 'fbLowerPrev', this.fbLowerNav);
	this.fbLowerPrevA	= this.setNode('a', 'fbLowerPrevA', this.fbLowerPrev, this.strHintPrev);
	this.fbLowerNext	= this.setNode('div', 'fbLowerNext', this.fbLowerNav);
	this.fbLowerNextA	= this.setNode('a', 'fbLowerNextA', this.fbLowerNext, this.strHintNext);
	this.fbControls		= this.setNode('div', 'fbControls', this.fbControlPanel);
	this.fbClose		= this.setNode('a', 'fbClose', this.fbControls, this.strHintClose);
	this.fbPlayPause	= this.setNode('div', 'fbPlayPause', this.fbControls);
	this.fbPlay			= this.setNode('a', 'fbPlay', this.fbPlayPause, this.strHintPlay);
	this.fbPause		= this.setNode('a', 'fbPause', this.fbPlayPause, this.strHintPause);
},

//*******************************************************************/
// parseOptionString()
// Return object of name:value pairs from a query string or a rev tag
// e.g., "doSlideshow=true&navType=none"   (queryString syntax)
//   or, "doSlideshow:true navType:none"   (valid rev attribute)
//   or, "doSlideshow:true; navType:none"  (style/css syntax)
//*******************************************************************/
parseOptionString: function(str) {
	if (!str) return {};
	// capture all backquoted segments
	var quotes = [], match;
	var rexp = /`(.*?)`/g;
	while (match = rexp.exec(str)) quotes.push(match[1]);
	if (quotes.length) str = str.replace(rexp, '``');  // remove backquoted segments from the string but leave the backquotes to mark the spot
	str = str.replace(/\s*[:=]\s*/g, ':');  // = to :, trim internal spaces
	str = str.replace(/\s*[;&]\s*/g, ' ');  // & and ; to space, trim extra spaces
	str = str.replace(/^\s+|\s+$/g, '');  // trim leading and trailing spaces
	// now we've got "key:value key:value" pairs
	var aVars = str.split(' ');
	var pairs = {};
	var i = aVars.length, j = quotes.length;
	while (i--) {
		var aThisVar = aVars[i].split(':');  // split this name:value pair
		if (aThisVar[1] == '``') aThisVar[1] = quotes[--j] || '';  // put any backquoted string back in place
		pairs[aThisVar[0]] = aThisVar[1];  // add this one to our pairs object
	}
	return pairs;
},

//*****************************************************/
// setOptions()
// Sets floatbox options from a name:value pairs object
//*****************************************************/
setOptions: function(pairs) {
	if (typeof(pairs) != 'object') return;
	for (var name in pairs) {  // iterate each option name in the passed object
		var value = pairs[name];
		if (typeof(value) == 'string') {  // parse booleans and numbers out of strings
			if (name.indexOf('str') != 0) value = value.toLowerCase();  // allow uppercase in customized localization strings
			if (isNaN(value)) {
				if (value == 'true') {
					this[name] = true;
				} else if (value == 'false') {
					this[name] = false;
				} else if (value) {
					this[name] = value;  // take the string as is
				}
			} else {
				this[name] = +value;  // convert to a number
			}
		} else {
			this[name] = value;  // not a string: take the raw value
		}
	}
},

//*******************************************************/
// start()
// Fired when user clicks on one of the activated anchors
//*******************************************************/
start: function(anchor) {
	anchor.blur();  // remove focus
// initialize vars for this run
	this.itemCount = this.arrItems.length = this.itemsShown = this.resizeCounter = 0;
	this.currentItem = -1;
// get starting link info
	var href = anchor.getAttribute('href');
	var rel = anchor.getAttribute('rel');
	var rev = anchor.getAttribute('rev');
	var title = anchor.getAttribute('title');
	this.isIframe = /^(iframe|lyteframe)/i.test(rel);
// start loading this image (but block preload chaining)
	if (!this.isIframe) {
		this.blockPreloadChain = true;
		this.preloadNextImage(href);
	}
// load the item array {href, title, rev, boolSeen}
	var reDontShow = /showThis\s*[:=]\s*false/i;
	if (/^(gallery|iframe|lytebox|lyteframe|lightbox)$/i.test(rel)) {  // standalone item
		if (href && !reDontShow.test(rev)) {
			this.arrItems.push( {href: href, title: title, rev: rev, seen: false} );
		}
	} else {  // multiple items
		for (var i = 0, len = this.arrAnchors.length; i < len; i++) {
			var href_i = this.arrAnchors[i].getAttribute('href');
			var rev_i = this.arrAnchors[i].getAttribute('rev');
			if (this.arrAnchors[i].getAttribute('rel') == rel) {  // if rel matches the one from the clicked anchor...
				if (href_i && !reDontShow.test(rev_i)) {
					this.arrItems.push( {  // ...add it to the array for this run
						href: this.arrAnchors[i].getAttribute('href'),
						title: this.arrAnchors[i].getAttribute('title'),
						rev: rev_i, seen: false
					} );
				}
			}
		}
	}
	this.itemCount = this.arrItems.length;
// set options. precedence is:
// 1) querystring from the host page url (good for testing)
// 2) options from the clicked link's rev attribute
// 3) from cookies set by external form or code
// 4) setFloatboxOptions() function defined on host page
// 5) those defined above in defaultOptions
	this.modal = this.doSlideshow = this.loadPageOnClose = false;  // will be picked up from rev tag or setFloatboxOptions()
	this.setOptions(this.defaultOptions);
	if (typeof(this.win.setFloatboxOptions) == 'function') this.win.setFloatboxOptions();
	if (this.enableCookies) {
		// get and parse our options cookie
		var match = /fbOptions=(.+?)(;|$)/.exec(this.doc.cookie);
		if (match) this.setOptions(this.parseOptionString(match[1]));
		// make sure the options cookie is set for the benefit of external options forms or other code
		var strOptions = '';
		for (var name in this.defaultOptions) {
			if (name.indexOf('str') != 0) strOptions += ' ' + name + ':' + this[name];
		}
		var strPath = '/';
		if (this.cookieScope == 'folder') {
			strPath = this.win.location.pathname;
			strPath = strPath.substring(0, strPath.lastIndexOf('/') + 1);
		}
		this.doc.cookie = 'fbOptions=' + strOptions + '; path=' + strPath;
	}
	this.setOptions(this.parseOptionString(rev));  // options from the clicked item's rev attribute
	this.setOptions(this.parseOptionString(this.win.location.search.substring(1)));  //options from the page url's querystring
// adjust options to circumstances
	if (this.theme == 'grey') this.theme = 'white';  // backward compatability
	if (!/^(auto|black|white|blue|yellow|red|custom)$/.test(this.theme)) this.theme='auto';  // default
	if (this.theme == 'auto') this.theme = this.isIframe? 'white' : 'black';
	if (this.endTask == 'cont') this.endTask = 'loop';  // backward compatability
	this.isSlideshow = this.itemCount > 1 && (/^(slideshow|lyteshow)/i.test(rel) || this.doSlideshow);
	this.isPaused = this.startPaused;
	if (this.isIframe) {
		this.autoResize = this.showResize = false;
		// fixed positioning for firefox2 iframes to defeat the ff2 bug where the cursor won't display in iframed forms unless a containing div uses fixed positioning
		if (this.ffOld) this.disableScroll = true;
	}
// turn off stuff if modal mode was requested
	if (this.modal && (this.isSlideshow || this.isIframe)) {
		this.navType = 'none';
		this.showClose = false;
		this.showPlayPause = false;
		this.enableKeyboardNav = false;
		this.outsideClickCloses = false;
		this.showHints = 'never';
	}
// adjust nav type to circumstances
	if (!/^(upper|lower|both|none)$/i.test(this.navType)) this.navType = 'both';  // default
	if (this.itemCount <= 1) {
		this.navType = 'none';
		this.showItemNumber = false;
	} else if (this.isIframe && /upper|both/i.test(this.navType)) {
		this.navType = 'lower';
	}
// set navType booleans
	this.upperNav = /upper|both/i.test(this.navType);
	this.lowerNav = /lower|both/i.test(this.navType);
	if (this.upperNav) {
		if (this.upperNavWidth < 0) this.upperNavWidth = 0;
		if (this.upperNavWidth > 50) this.upperNavWidth = 50;
	}
// utility function used by mouse events to clear show-once hints
	if (this.showHints == 'once') {
		this.hideHint = function(id) {
			if (this[id].title) this.objTimeouts[id] = setTimeout(function() { fb[id].title = ''; }, this.showHintsTime);
		};
	} else {
		this.hideHint = function() { return; };
	}
// build the floatbox elements
	this.buildDOM();
// attach event behaviours to the controls
	this.fbResize.onclick = function() { fb.scaleItem = this.scaleItem; fb.loadItem(fb.currentItem); return false; };
	this.fbPlay.onclick = function() { fb.setPause(false); return false; };
	this.fbPause.onclick = function() { fb.setPause(true); return false; };
	this.fbClose.onclick = function() { fb.end(); return false; };
	if (this.outsideClickCloses) this.fbOverlay.onclick = function() { fb.end(); return false; };
	this.fbLowerPrevA.onclick = function() {
		if (fb.enableWrap || fb.currentItem != 0) {
			// show previous item and adjust pause state
			fb.loadItem((fb.currentItem == 0)? fb.itemCount - 1 : fb.currentItem - 1);
			if (fb.isSlideshow  && fb.pauseOnPrev && !fb.isPaused && fb.showPlayPause) {
				fb.setPause(true);
			}
		}
		return false;
	};
	this.fbLowerNextA.onclick = function() {
		if (fb.enableWrap || fb.currentItem != fb.itemCount - 1) {
			// show next item and adjust pause state
			fb.loadItem((fb.currentItem == fb.itemCount - 1)? 0 : fb.currentItem + 1);
			if (fb.isSlideshow && fb.pauseOnNext && !fb.isPaused && fb.showPlayPause) {
				fb.setPause(true);
			}
		}
		return false;
	};
	if (this.upperNav) {
// set nav panel mouse actions
		// onclick  same as lower nav onclick action
		this.fbLeftNav.onclick = this.fbUpperPrev.onclick = this.fbLowerPrevA.onclick;
		this.fbRightNav.onclick = this.fbUpperNext.onclick = this.fbLowerNextA.onclick;
		// mouseover, mousemove
		this.fbLeftNav.onmouseover = this.fbLeftNav.onmousemove =
		this.fbUpperPrev.onmousemove = function() {
			// if the content panel is not currently fading in, show the upper prev widget
			if (!fb.objTimeouts.fbContentPanel) fb.fbUpperPrev.style.visibility = 'visible';
			// if the upper prev widget is set to not show, light up the lower prev instead
			if (fb.lowerNav && !fb.showUpperNav) fb.fbLowerPrevA.style.backgroundPosition = 'bottom';
			return true;  // block status bar showing of bogus href
		};
		this.fbRightNav.onmouseover = this.fbRightNav.onmousemove =
		this.fbUpperNext.onmousemove = function() {
			if (!fb.objTimeouts.fbContentPanel) fb.fbUpperNext.style.visibility = 'visible';
			if (fb.lowerNav && !fb.showUpperNav) fb.fbLowerNextA.style.backgroundPosition = 'bottom';
			return true;
		};
		this.fbUpperPrev.onmouseover = this.fbUpperNext.onmouseover = function() {
			this.onmousemove();
			fb.hideHint(this.id);
			return true;
		};
		// mouseout
		this.fbLeftNav.onmouseout = function() {
			// hide the upper prev widget and turn off highlighting of lower prev
			fb.fbUpperPrev.style.visibility = 'hidden';
			if (fb.lowerNav) fb.fbLowerPrevA.style.backgroundPosition = 'top';
		};
		this.fbRightNav.onmouseout = function() {
			fb.fbUpperNext.style.visibility = 'hidden';
			if (fb.lowerNav) fb.fbLowerNextA.style.backgroundPosition = 'top';
		};
		this.fbUpperPrev.onmouseout = this.fbUpperNext.onmouseout = function() {
			this.style.visibility = 'hidden';
			// cancel the remove title timer. Tooltip did not have enough time to display
			fb.clearTimeout(this.id);
		};
		// mouseup handler to let the image handle the right-click context menu, instead of the nav overlay handling it
		// doesn't work for opera and firefox3 rc1
		this.fbLeftNav.onmouseup = this.fbRightNav.onmouseup = function(evt) {
			var e = evt || fb.win.event;
			if (e.button == 2) {  // if it's a right-click
				// briefly hide the nav panels so the image will be the topmost event handler
				fb.fbLeftNav.style.display = fb.fbRightNav.style.display = 'none';
				setTimeout(function() { if (fb.fbLeftNav) fb.fbLeftNav.style.display = fb.fbRightNav.style.display = ''; }, 20);
			}
		};
	}
// mouse actions to clear show-once hints and activate lower controls background sprite animation
	this.fbPlay.onmouseover = this.fbPause.onmouseover = this.fbClose.onmouseover =
	this.fbLowerPrevA.onmouseover =	this.fbLowerNextA.onmouseover = function() {
		this.style.backgroundPosition = 'bottom';
		fb.hideHint(this.id);
		return true;
	};
	this.fbResize.onmouseover = function() {
		fb.hideHint(this.id);
		return true;
	};
	this.fbPlay.onmouseout = this.fbPause.onmouseout = this.fbClose.onmouseout =
	this.fbLowerPrevA.onmouseout = this.fbLowerNextA.onmouseout = function() {
		this.style.backgroundPosition = 'top';
		fb.clearTimeout(this.id);
	};
	this.fbResize.onmouseout = function() {
		fb.clearTimeout(this.id);
	};
// enable keyboard handler
	if (this.enableKeyboardNav) {
		this.priorOnkeydown = this.doc.onkeydown;
		this.doc.onkeydown = this.keyboardAction;
	}
// block stupid opera spacebar keypress action
	if (window.opera) {
		this.priorOnkeypress = this.doc.onkeypress;
		this.doc.onkeypress = function() { return false; };
	}
// ie6 always shows selects on top, doesn't handle position:fixed and doesn't respect height:width:100% against the body
	if (this.ieOld || this.ieQuirks) {
		this.hideElements('select');
		this.fbOverlay.style.position = 'absolute';
		this.win.attachEvent('onresize', fb.stretchOverlay);
		this.win.attachEvent('onscroll', fb.stretchOverlay);
		this.stretchOverlay();
	}
	if (this.ieOld && this.isIframe) this.innerBorder = 0;  // ie6 screws up iframe layout if there's a border
	if (this.hideFlash) {
		this.hideElements('object');
		this.hideElements('embed');
	}
	if (this.hideJava) this.hideElements('applet');
// show the overlay with a callback of turning on the floatbox pieces
// we're using a timer because the pause lets ff3 rc1 not screw up the rendering when overlayFadeDuration == 0
	var callback = function() {
		setTimeout(function() { fb.turnOn(href, rev, title); }, 10);
	};
	this.fade(this.fbOverlay, 0, this.overlayOpacity, callback);
},

//*********************************************/
// turnOn()
// Chained from start() via the overlay fade in
//*********************************************/
turnOn: function(href, rev, title) {
// turn on the main divs
	this.fbFloatbox.style.position = 'absolute';
	this.fbFloatbox.style.width = this.fbFloatbox.style.height = this.fbFloatbox.style.borderWidth = '0';
	this.fbFloatbox.style.left = (this.getDisplayWidth() / 2 + this.getXScroll()) + 'px';
	this.fbFloatbox.style.top = (this.getDisplayHeight() / 3 + this.getYScroll()) + 'px';
	this.fbFloatbox.style.display = this.fbContentPanel.style.display = this.fbLoader.style.display = '';
// turn on nav gadgets
	if (this.upperNav) {
		this.fbLeftNav.style.display = this.fbRightNav.style.display = '';
		this.fbLeftNav.style.top = this.fbRightNav.style.top =
		this.fbLeftNav.style.left = this.fbRightNav.style.right =
		this.fbUpperPrev.style.left = this.fbUpperNext.style.right =
			(this.padding + this.innerBorder) + 'px';
		if (this.showUpperNav == 'never' || (this.showUpperNav == 'once' && this.upperNavShown)) {
			this.showUpperNav = false;
		} else {
			this.fade(this.fbUpperPrev, this.upperOpacity);
			this.fade(this.fbUpperNext, this.upperOpacity);
			this.fbUpperPrev.style.visibility = this.fbUpperNext.style.visibility = 'hidden';  // mouse movement will wake them up
		}
	}
	if (this.lowerNav) {
		this.fbLowerNav.style.paddingRight = this.controlSpacing + 'px';
		this.fbLowerNav.style.display = this.fbLowerPrev.style.display = this.fbLowerPrevA.style.display =
		this.fbLowerNext.style.display = this.fbLowerNextA.style.display = '';
	}
// resizer
	this.fbResize.style.left = this.fbResize.style.top = (this.padding + this.innerBorder) + 'px';
// turn on control panel items
	if (!this.isSlideshow) this.showPlayPause = false;
	if (this.showClose || this.showPlayPause || this.lowerNav) {
		this.fbControlPanel.style.visibility = 'hidden';
		this.fbControlPanel.style.display = '';
		this.fbControlPanel.style.right = Math.max(this.padding, 8) + 'px';
	}
	var controlsWidth = 0;
	if (this.showClose) {
		this.fbControls.style.display = this.fbClose.style.display = '';
		controlsWidth = this.fbClose.offsetWidth;
	}
	if (this.showPlayPause) {
		this.fbControls.style.display = this.fbPlayPause.style.display =
		this.fbPlay.style.display = this.fbPause.style.display = '';
		this.fbPlayPause.style.paddingRight = this.controlSpacing + 'px';
		this.fbPlay.style.left = this.isPaused? '' : '-9999px';
		this.fbPause.style.left = this.isPaused? '-9999px' : '';
		controlsWidth += this.fbPlayPause.offsetWidth;
	}
	this.fbControls.style.width = controlsWidth + 'px';
	this.fbControlPanel.style.width = (this.fbLowerNav.offsetWidth + controlsWidth) + 'px';
// capture framework dimensions to simplify width and height calcs later on
	this.xFramework = 2*(this.outerBorder + this.innerBorder + this.padding);
	this.yFramework = this.xFramework - this.padding;  // does not include panelPadding
// start with the clicked anchor (or 0 if this one is set to no show and it doesn't match another one that's set to show)
	for (i = this.itemCount - 1; i > 0; i--) {
		if (this.arrItems[i].href == href &&
			this.arrItems[i].rev == rev &&
			this.arrItems[i].title == title) {
			break;
		}
	}
	// using a timeout prevents some ugly redraw behaviour from firefox3
	setTimeout(function() { fb.loadItem(i); }, 10);
},

//**********************************************************/
// loadItem()
// Preps for new item and invokes setSize()
// Invoked by start(), nav control event, or slideshow timer
// Calls resize when the load is complete
//**********************************************************/
loadItem: function(newItem) {
	this.clearTimeout('slideshow');
	this.clearTimeout('resizeGroup');
	this.blockPreloadChain = true;
	this.win.focus();  // make sure the keyboard handler is going to see the keypresses
// capture currentItem
	this.isFirstItem = (this.currentItem == -1);
	if (this.currentItem != newItem) {
		this.resizeActive = false;
		// clear showing of 1st-image-only upper nav gadgets
		if (this.showUpperNav == 'once' && this.upperNavShown) this.showUpperNav = false;
		this.currentItem = newItem;
	}
	this.revOptions = this.parseOptionString(this.arrItems[this.currentItem].rev);
	this.currentHref = this.arrItems[this.currentItem].href;
// get current display dimensions
	if (this.displayWidth != (this.displayWidth = this.getDisplayWidth())) this.resizeActive = false;
	if (this.displayHeight != (this.displayHeight = this.getDisplayHeight())) this.resizeActive = false;
// hide content
	this.fbContentPanel.style.visibility = 'hidden';  // still measurable
	this.fbResize.style.display = 'none';  // doesn't seem to disappear with the content panel
	if (this.fbItem) {
		this.fbContentPanel.removeChild(this.fbItem);
		delete this.fbItem;
	};
// hide upper nav, collapse it to avoid weird problems, optionally turn off display of upper nav gadgets
	if (this.upperNav) {
		this.fbUpperPrev.style.visibility = this.fbUpperNext.style.visibility = 'hidden';
		this.fbLeftNav.style.height = this.fbRightNav.style.height = '0';
		if (!this.showUpperNav) this.fbUpperPrev.style.display = this.fbUpperNext.style.display = 'none';
	}
// switch from fixed to absolute positioning (else animated resizing will be very jerky)
	if (this.fbFloatbox.style.position == 'fixed') {
		this.fbFloatbox.style.left = (this.fbFloatbox.offsetLeft + this.getXScroll()) + 'px';
		this.fbFloatbox.style.top = (this.fbFloatbox.offsetTop + this.getYScroll()) + 'px';
		this.fbFloatbox.style.position = 'absolute';
	}
// update info panel items
	this.fbCaption.style.display = this.fbItemNumber.style.display = 'none';
	if (this.showCaption) {
		var sCaption = this.revOptions.caption? this.revOptions.caption : this.arrItems[this.currentItem].title || '';
		if (sCaption == 'href') sCaption = this.currentHref;
		// decode html entities
		sCaption = sCaption.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"').replace(/&apos;/g, "'").replace(/&amp;/g, '&');  // &amp; last
		// caption update is on a try in case it contains messed up html in it which can cause the innerHTML assignment to gak
		try { this.fbCaption.innerHTML = sCaption; } catch(e) { sCaption = ''; }
		if (sCaption) this.fbCaption.style.display = '';
	}
	if (this.showItemNumber) {
		var sCount = this.isIframe? this.strIframeCount : this.strImageCount;
		sCount = sCount.replace('%1', this.currentItem + 1);
		sCount = sCount.replace('%2', this.itemCount);
		try { this.fbItemNumber.innerHTML = sCount; } catch(e) { sCount = ''; }
		if (sCount) this.fbItemNumber.style.display = '';
	}
	if (this.isFirstItem) {
// display the 'loading' floatbox at initial size if the first item is slow to load
		this.objTimeouts.firstLoad = setTimeout(function() {
			fb.fbFloatbox.style.left = (fb.fbFloatbox.offsetLeft - fb.initialSize/2) + 'px';
			fb.fbFloatbox.style.top = (fb.fbFloatbox.offsetTop - fb.initialSize/3) + 'px';
			fb.fbFloatbox.style.width = fb.fbFloatbox.style.height = fb.initialSize + 'px';
			fb.fbFloatbox.style.borderWidth = fb.outerBorder + 'px';
		}, 500);
	} else if (!this.resizeCounter) {
// use timer for loader so we don't flash the loading gif on quick content changes
		this.objTimeouts.loader = setTimeout(function() { fb.fbLoader.style.display = ''; }, 120);
	}
// load image or iframe
	if (this.isIframe) {
		setTimeout(function() { fb.setSize(); }, 10);  // on a timer so the display can update
	} else {
		var loader = new Image();
		loader.onload = function() { fb.setSize(this.width, this.height); };
		loader.onerror = function() {  // if the image can't be found
			// show the file name...
			fb.fbCaption.innerHTML = fb.currentHref.substring(fb.currentHref.lastIndexOf('/') + 1);
			fb.fbCaption.style.display = '';
			// ...and the 404 image
			if (fb.currentHref != fb.url404Image) {
				this.src = fb.currentHref = fb.url404Image;
			} else {  // the 404 image can't be found either!
				fb.setSize();
			}
		};
		loader.src = this.currentHref;
	}
},

//********************************************************************************/
// setSize()
// Re-dimension and position floatbox elements based on image or iframe dimensions
//********************************************************************************/
setSize: function(imageWidth, imageHeight) {
// item is loaded, cancel the pending loader display
	this.clearTimeout('firstLoad');
// get max dimensions that will fit the current window
	if (typeof(this.panelHeight) == 'undefined') {
		// take a guess on the 1st pass.  panelHeight is a measured value on the 2nd pass
		if (!this.fbCaption.style.display || !this.fbItemNumber.style.display || !this.fbControlPanel.style.display || this.lowerNav) {
			this.panelHeight = 15 + 2*this.panelPadding;
			if (!this.fbCaption.style.display && this.showItemNumber) this.panelHeight += 15;
		} else {
			this.panelHeight = this.padding;
		}
	}
	var maxWidth = this.displayWidth - this.xFramework - 2*this.resizeSpace;
	var maxHeight = this.displayHeight - this.yFramework - this.panelHeight - 2*this.resizeSpace;
// look in this item's rev attribute for dimensions (and iframe scroller preference)
	var width = 0, height = 0;
	this.itemScrolling = 'auto';
	if (this.revOptions.width) width = (this.revOptions.width == 'max')? maxWidth : parseInt(this.revOptions.width);
	if (this.revOptions.height) height = (this.revOptions.height == 'max')? maxHeight : parseInt(this.revOptions.height);
	if (this.revOptions.scrolling) {
		if (this.isIframe && /yes|no/i.test(this.revOptions.scrolling)) this.itemScrolling = this.revOptions.scrolling;
	}
// width/height precedence is: from rev tag, from this image, defaults
	width = width || imageWidth || 500;
	height = height || imageHeight || 300;
// capture unresized dimensions for use by the resize button
	this.nativeWidth = width;
	this.nativeHeight = height;
// optionally resize item down to fit screen (scaleItem may have been set by fbResize.onclick)
	if (typeof(this.scaleItem) == 'undefined') this.scaleItem = this.autoResize;
	if (this.scaleItem) {
		var scale = Math.min(maxWidth / width, maxHeight / height);
		if (scale < 1) {
			width = Math.round(width * scale);
			height = Math.round(height * scale);
		}
	}
// make sure the outer border gets added
	if (this.isFirstItem) this.fbFloatbox.style.borderWidth = this.outerBorder + 'px';
// position uppernav graphics
	if (this.upperNav && this.showUpperNav) {
		this.fbUpperPrev.style.top = this.fbUpperNext.style.top =
			(height * this.upperNavPos/100 + this.padding + this.innerBorder) + 'px';
	}
// establish infoPanel width here so that the height measurement stands a chance of being right
	this.newWidth = width + this.xFramework;
	this.infoPanelHeight = 0;
	this.fbInfoPanel.style.display = this.fbControlPanel.style.display = '';  // so we can measure 'em
	if (!this.fbCaption.style.display || !this.fbItemNumber.style.display) {
		var ipWidth = this.newWidth - 2*(this.outerBorder + Math.max(this.padding, 8)) - this.lowerPanelSpace - this.fbControlPanel.offsetWidth;
		if (ipWidth > 80) {  // don't display infopanel if it's too squished up
			this.fbInfoPanel.style.width = ipWidth + 'px';
			this.fbInfoPanel.style.left = '-9999px';  // otherwise flashes hscrollbar which can mess up screen height measurment
			this.infoPanelHeight = this.fbInfoPanel.offsetHeight;
		}
	}
// calc total height
	this.panelHeight = Math.max(this.infoPanelHeight, this.fbControlPanel.offsetHeight);
	this.fbInfoPanel.style.display = this.fbControlPanel.style.display = 'none';  // otherwise we can get vscrollbar flashes if going from wide to narrow
	if (this.panelHeight) this.panelHeight += 2*this.panelPadding;
	this.panelHeight = Math.max(this.panelHeight, this.padding);
	this.newHeight = this.yFramework + height + this.panelHeight;

// check if we need further auto-sizing done because the panelHeight estimate was low
	if ((this.scaleItem || height == maxHeight) && this.newHeight > this.displayHeight) {
		if (this.resizeCounter++ < 3) {  // max of 3 additional passes
			return this.loadItem(this.currentItem);
		}
	}
// calc left
	var freeSpace = this.displayWidth - this.newWidth;
	var newLeft = (freeSpace <= 0)? 0 : Math.floor(freeSpace/2);
// calc top
	var freeSpace = this.displayHeight - this.newHeight;
	var ratio = freeSpace / this.displayHeight;
	if (ratio <= .15) {
		var factor = 2;
	} else if (ratio >= .3) {
		var factor = 3;
	} else {
		var factor = 2 + (ratio - .15)/.15;
	}
	var newTop = (freeSpace <= 0)? 0 : Math.floor(freeSpace/factor);
// add screen scroll values to left and top
	if (this.getXScroll() || this.getYScroll()) {
		this.fbFloatbox.style.display = 'none';  // fb might be stretching the body
		if (this.ieOld || this.ieQuirks) this.stretchOverlay();  // the overlay might be stretching the body
		newLeft += this.getXScroll();
		newTop += this.getYScroll();
		this.fbFloatbox.style.display = '';
	}
// capture calc'd dimensions for use by showContent()
	this.itemWidth = width;
	this.itemHeight = height;
// get current dimensions
	var oldLeft = this.fbFloatbox.offsetLeft, oldTop = this.fbFloatbox.offsetTop;
	var oldWidth = this.fbFloatbox.offsetWidth, oldHeight = this.fbFloatbox.offsetHeight;
// setup resizing arrays
	this.arrResize1.length = this.arrResize2.length = 0;
	if (oldLeft != newLeft)
		var resizeL = [this.fbFloatbox, 'left', oldLeft, newLeft];
	if (oldTop != newTop)
		var resizeT = [this.fbFloatbox, 'top', oldTop, newTop];
	var borderAdjust = this.ieQuirks? 0 : 2*this.outerBorder;
	if (oldWidth != this.newWidth)
		var resizeW = [this.fbFloatbox, 'width', oldWidth - borderAdjust, this.newWidth - borderAdjust];
	if (oldHeight != this.newHeight)
		var resizeH = [this.fbFloatbox, 'height', oldHeight - borderAdjust, this.newHeight - borderAdjust];
	switch ((this.resizeOrder == 'random')? Math.floor(Math.random()*3) : this.resizeOrder) {
		case 'width': case 1:
			if (resizeL) this.arrResize1.push(resizeL);
			if (resizeW) this.arrResize1.push(resizeW);
			if (resizeT) this.arrResize2.push(resizeT);
			if (resizeH) this.arrResize2.push(resizeH);
			break;
		case 'height': case 2:
			if (resizeL) this.arrResize2.push(resizeL);
			if (resizeW) this.arrResize2.push(resizeW);
			if (resizeT) this.arrResize1.push(resizeT);
			if (resizeH) this.arrResize1.push(resizeH);
			break;
		default:
			if (resizeL) this.arrResize1.push(resizeL);
			if (resizeW) this.arrResize1.push(resizeW);
			if (resizeT) this.arrResize1.push(resizeT);
			if (resizeH) this.arrResize1.push(resizeH);
	}
	this.fbInfoPanel.style.left = Math.max(this.padding, 8) + 'px';  // put the info panel back
	// resize group1 with a callback task of resizing group2 with a callback task of showContent
	this.resizeGroup(this.arrResize1, function() {
		fb.resizeGroup(fb.arrResize2, function() { fb.showContent(); })
	});
},

//**********************************************************************/
// showContent()
// Displays current content
// Invoked by resize() or resizeGroup() after container has been resized
//**********************************************************************/
showContent: function() {
// item is resized, cancel the pending loader display
	this.clearTimeout('loader');
// if a scrollbar has come or gone, we might need some further resizing or positioning done
	var vscrollChanged = (this.displayWidth != (this.displayWidth = this.getDisplayWidth()));
	var hscrollChanged = (this.displayHeight != (this.displayHeight = this.getDisplayHeight()));
	if (this.resizeCounter++ < 4) {  // allow one additional pass for scrollbar adjustment
		var tolerance = 25 + 2*this.resizeSpace;
		if ((vscrollChanged && Math.abs(this.newWidth - this.displayWidth) < tolerance)
		||  (hscrollChanged && Math.abs(this.newHeight - this.displayHeight) < tolerance))
			return this.loadItem(this.currentItem);
	}
	this.resizeCounter = 0;
	if (this.ieOld || this.ieQuirks) this.stretchOverlay();
// use fixed positioning if requested, if the browser can handle fixed, and if the content fits the window
	if (this.disableScroll && !(this.ieOld || this.ieQuirks || this.operaQuirks)) {
		if (this.newWidth <= this.displayWidth && this.newHeight <= this.displayHeight) {
			this.fbFloatbox.style.position = 'fixed';
			this.fbFloatbox.style.left = (this.fbFloatbox.offsetLeft - this.getXScroll()) + 'px';
			this.fbFloatbox.style.top = (this.fbFloatbox.offsetTop - this.getYScroll()) + 'px';
		}
	}
// re-create and position the fbItem element
	this.fbItem = this.setNode((this.isIframe? 'iframe' : 'img'), 'fbItem', this.fbContentPanel);
	this.fbItem.width = this.itemWidth;
	this.fbItem.height = this.itemHeight;
	this.fbItem.src = this.currentHref;
	this.fbItem.style.left = this.fbItem.style.top = this.padding + 'px';
	this.fbItem.style.borderWidth = this.innerBorder + 'px';
// position upperNav
	if (this.upperNav) {
		this.fbLeftNav.style.width = this.fbRightNav.style.width = Math.max(this.upperNavWidth/100 * this.itemWidth, this.fbUpperPrev.offsetWidth) + 'px';
		this.fbLeftNav.style.height = this.fbRightNav.style.height = this.itemHeight + 'px';
	}
//position info and control panels
	var panelTop = this.itemHeight + 2*this.innerBorder + this.padding;
	if (this.infoPanelHeight) {
		this.fbInfoPanel.style.display = '';
		this.fbInfoPanel.style.top = (panelTop + (this.panelHeight - this.fbInfoPanel.offsetHeight) / 2) + 'px';
	}
	if (this.showClose || this.showPlayPause || this.lowerNav) {
		this.fbControlPanel.style.display = '';
		this.fbControlPanel.style.top = (panelTop + (this.panelHeight - this.fbControlPanel.offsetHeight) / 2) + 'px';
	}
// release panel height measurement so the next autoresize won't inherit too large of a panel
	delete this.panelHeight;
// determine neighbour items
	this.prevItem = this.currentItem? this.currentItem - 1 : this.itemCount - 1;
	this.nextItem = (this.currentItem < this.itemCount - 1)? this.currentItem + 1 : 0;
	var prevHref = (this.enableWrap || this.currentItem != 0)? this.arrItems[this.prevItem].href : '';
	var nextHref = (this.enableWrap || this.currentItem != this.itemCount - 1)?  this.arrItems[this.nextItem].href : '';
// toggle nav gadgets based on wrap status & update nav hrefs (for the browser status bar display)
	if (this.lowerNav) {
		this.fbLowerPrevA.href = prevHref;
		this.fbLowerPrevA.style.left = prevHref? '' : '-9999px';
		this.fbLowerNextA.href = nextHref;
		this.fbLowerNextA.style.left = nextHref? '' : '-9999px';
		this.fbLowerNav.style.visibility = '';
	}
	if (this.upperNav) {
		if (window.opera || this.ffNew) {
			// point the upper hrefs to the current image for browsers that don't respond to the right-click save-as handler (see onmouseup above)
			this.fbLeftNav.href = this.fbUpperPrev.href =
			this.fbRightNav.href = this.fbUpperNext.href = this.currentHref;
		} else {
			this.fbLeftNav.href = this.fbUpperPrev.href = prevHref;
			this.fbRightNav.href = this.fbUpperNext.href = nextHref;
		}
		this.fbLeftNav.style.visibility = prevHref? 'visible' : 'hidden';
		this.fbRightNav.style.visibility = nextHref? 'visible' : 'hidden';
		this.upperNavShown = true;  // showUpperNav=once handler
	}
// setup the resize button
	delete this.scaleItem;  // remove autoResize over-ride
	if (this.showResize) {
		if (this.resizeActive) {  // resize is active, flip the direction
			this.fbResize.scaleItem = !this.fbResize.scaleItem;
		} else {  // calc if we need to activate resizer
			var xtra = this.outerBorder;
			if (this.newWidth - xtra - this.padding > this.displayWidth
			|| this.newHeight - xtra - this.panelPadding > this.displayHeight) {
				this.fbResize.scaleItem = true;  // not to be confused with this.scaleItem - onclick sets that
				this.resizeActive = true;
			} else {
				xtra += this.resizeSpace;
				if (this.itemWidth < this.nativeWidth - xtra - this.padding
				|| this.itemHeight < this.nativeHeight - xtra - this.panelPadding) {
					this.fbResize.scaleItem = false;
					this.resizeActive = true;
				}
			}
		}
		if (this.resizeActive) {
			this.fbResize.style.backgroundPosition = this.fbResize.scaleItem? 'bottom' : 'top';
			this.fade(this.fbResize, this.upperOpacity);
		}
	}
// display current content
	this.fade(this.fbContentPanel, 0, 100);
	this.fbLoader.style.display = 'none';
	this.fbItem.style.display = this.fbControlPanel.style.visibility = '';
	if (window.opera && this.isIframe) {  // Opera won't show iframe content without a src toggle here (or an alert)
		var src = this.fbItem.src;
		this.fbItem.src = '';
		setTimeout(function() { fb.fbItem.src = src; }, 10);
	}
// flag that we've seen this one and increment shown count if this is the first viewing of this item.
	if (!this.arrItems[this.currentItem].seen) {
		this.arrItems[this.currentItem].seen = true;
		this.itemsShown++;
	}
// restart preloading with the next image
	this.blockPreloadChain = false;
	this.preloadNextImage(this.isIframe? '' : this.arrItems[this.nextItem].href);
// set next slideshow event timer
	if (this.isSlideshow && !this.isPaused) {
		if (this.endTask == 'loop' || this.itemsShown < this.itemCount) {
			this.objTimeouts.slideshow = setTimeout(function() { fb.loadItem(fb.nextItem); }, this.slideInterval*1000);
		} else if (this.endTask == 'exit') {
			this.objTimeouts.slideshow = setTimeout(function() { fb.end(); }, this.slideInterval*1000);
		} else {  // this.endTask = 'stop' or unknown value
			this.objTimeouts.slideshow = setTimeout(function() { fb.setPause(true); }, this.slideInterval*1000);
			var i = this.itemCount;
			while (i--) this.arrItems[i].seen = false;
			this.itemsShown = 0;
		}
	}
},

//*******************************************************/
// end()
// Close down floatbox
// Called by event handlers or slideshow exit
// A modal iFrame will want to call fb.end() to terminate
//*******************************************************/
end: function() {
// clear any pending timeouts
	for (var key in this.objTimeouts) this.clearTimeout(key);
// remove keyboard handler(s)
	if (this.enableKeyboardNav) this.doc.onkeydown = this.priorOnkeydown;
	if (window.opera) this.doc.onkeypress = this.priorOnkeypress;
// deactivate floatbox
	this.fbOverlay.onclick = null;
	this.fbFloatbox.style.display = 'none';
	if (this.ieOld || this.ieQuirks) {
		this.win.detachEvent('onresize', fb.stretchOverlay);
		this.win.detachEvent('onscroll', fb.stretchOverlay);
	}
// setup callback function to fire when the overlay finishes fading out
// the timeout prevents ff2 from crashing when exiting from an iframe with an object in it
	var callBack = function() { setTimeout(function() {
		fb.fbOverlay.style.display = 'none';
		if (fb.hideFlash) {
			fb.unhideElements('object');
			fb.unhideElements('embed');
		}
		if (fb.hideJava) fb.unhideElements('applet');
		if (fb.ieOld || fb.ieQuirks) fb.unhideElements('select');
	}, 10); };
	this.fade(this.fbOverlay, this.overlayOpacity, 0, callBack);
// remove objects that might not be a part of the next run
	function remove(el) { el.parentNode.removeChild(el); };
	if (this.upperNav) {
		remove(this.fbUpperPrev); delete this.fbUpperPrev;
		remove(this.fbUpperNext); delete this.fbUpperPrev;
		remove(this.fbLeftNav); delete this.fbLeftNav;
		remove(this.fbRightNav); delete this.fbRightNav;
	}
	if (this.fbItem) { remove(this.fbItem); delete this.fbItem; }
	remove(this.fbCaption); delete this.fbCaption;
	remove(this.fbItemNumber); delete this.fbItemNumber;
	remove(this.fbInfoPanel); delete this.fbInfoPanel;
// nav on close requested?
	if (this.loadPageOnClose) {
		if (this.loadPageOnClose == 'this') {
			this.win.location.reload(true);
		} else if (this.loadPageOnClose == 'back') {
			history.back();
		} else {
			this.win.location.replace(this.loadPageOnClose);
		}
	}
},

//************************/
// keyboardAction()
// onkeydown event handler
//************************/
keyboardAction: function(evt) {
	var e = evt || fb.win.event;
	var keyCode = e.which || e.keyCode;
	switch (keyCode) {
// left/right arrow: prev/next item
		case 37: case 39:
			if (fb.itemCount > 1) {
				(keyCode == 37)? fb.fbLowerPrevA.onclick() : fb.fbLowerNextA.onclick();
				if (fb.showHints == 'once') {
					// turn off hints, because user already knows
					fb.fbLowerPrevA.title = fb.fbLowerNextA.title = '';
					if (fb.upperNav) fb.fbUpperPrev.title = fb.fbUpperNext.title = '';
				}
			}
			return false;  // block horizontal scroll
// spacebar: toggle play/pause
		case 32:
			if (fb.isSlideshow) {
				fb.setPause(!fb.isPaused);
				if (fb.showHints == 'once') fb.fbPlay.title = fb.fbPause.title = '';
			}
			return false;  // block vertical scroll
// tab: resize
		case 9:
			if (fb.resizeActive) {
				fb.fbResize.onclick();
				if (fb.showHints == 'once') fb.fbResize.title = '';
			}
			return false;
// esc: exit
		case 27:
			if (fb.showHints == 'once') fb.fbClose.title = '';  // for next run
			fb.end();
			return false;  // don't let esc cancel end() function's loadPageOnClose action
// block enter key reload of active anchor on the launching page
		case 13:
			return false;
	}
},

//********************************************/
// setPause()
// Sets slideshow state to paused or playing
// and displays the appropriate control button
//********************************************/
setPause: function(bPause) {
	this.isPaused = bPause;
	if (bPause) {
		this.clearTimeout('slideshow');  // clear pending slideshow event
	} else {
		this.loadItem(this.nextItem);  // launch the next image
	}
	if (this.showPlayPause) {  // show the appropriate control
		this.fbPlay.style.left = bPause? '' : '-9999px';
		this.fbPause.style.left = bPause? '-9999px' : '';
	}
},

//**************************************************************/
// fade()
// Changes opacity in graduated steps through timers
// This is a setup function for setOpacity() which does the work
// Can fade in or out
//**************************************************************/
fade: function(obj, startOp, finishOp, funcOnComplete) {
	if (!funcOnComplete) var funcOnComplete = function() { return; };
// clear any pending fade timer task for this object
	this.clearTimeout(obj.id);
// init vars
	if (typeof(finishOp) == 'undefined') finishOp = startOp;
	var fadeIn = (startOp <= finishOp && finishOp > 0);
// calc the % increment for each iteration
	var duration = (obj.id == 'fbOverlay')? this.overlayFadeDuration : this.imageFadeDuration;
	if (duration > 10) duration = 10;
	if (duration < 0) duration = 0;
	if (duration == 0) {
		startOp = finishOp;
		var incr = 100;  // doesn't matter, won't get used
	} else {
// magic log math that yields nice increments.  duration=1 -> incr=50%, 5 -> 9%, 10 -> 1%
		var root = Math.pow(100, .1);
		var power = duration + ((10 - duration)/9) * (Math.log(2)/Math.log(root) - 1);
		var incr = Math.round(100/Math.pow(root, power));
	}
	if (!fadeIn) incr = -incr;
// invoke function to set opacity values and next timer event
	this.setOpacity(obj, startOp, finishOp, incr, fadeIn, funcOnComplete);
	if (fadeIn) {
// show the object (after the first opacity set, but before the next timer event)
		obj.style.display = '';
		obj.style.visibility = 'visible';
	}
},

//********************************************************************/
// setOpacity()
// Worker bee function for fade()
// Applies opacity styles and maybe sets timer for next fade increment
//********************************************************************/
setOpacity: function(obj, thisOp, finishOp, incr, fadeIn, funcOnComplete) {
	if (funcOnComplete) arguments.callee.oncomplete = funcOnComplete;
// don't go beyond the finish state
	if ((fadeIn && thisOp >= finishOp) || (!fadeIn && thisOp <= finishOp)) thisOp = finishOp;
// set various opacity styles for different browsers
	if (fb.ie) {
		obj.style.filter = 'alpha(opacity=' + thisOp + ')';
	} else {
		obj.style.opacity = obj.style.MozOpacity = obj.style.KhtmlOpacity = thisOp/100;
	}
	if (thisOp == finishOp) {
// we're done, flag done by removing timer and maybe clearing ie filter and running on-complete code
		this.objTimeouts[obj.id] = null;
		if (fb.ie && finishOp >= 100) {
			try { obj.style.removeAttribute('filter'); } catch(e) {}  // fix for IE Alpha Opacity Filter bug
		}
		// run requested on-complete code
		if (arguments.callee.oncomplete) arguments.callee.oncomplete();
	} else {
// set timer for next step of opacity fade
		this.objTimeouts[obj.id] = setTimeout(function() { fb.setOpacity(fb[obj.id], thisOp + incr, finishOp, incr, fadeIn); }, 20);
	}
},

//*********************************************************************************************/
// resizeGroup()
// Does a graduated change a group of pixel attributes together as a unit
// The set of objects, attributes and values to be set are in the passed arr parameter
// This is a setup function for setSize() which does the actual property changes and timer sets
//*********************************************************************************************/
resizeGroup: function(arr, funcOnComplete) {
	if (!funcOnComplete) var funcOnComplete = function() { return; };
// resize everything in the array together (for smooth effect)
// arr is an array of arrays of structure [obj, property, start pixel, finish pixel]
	var i = arr.length;
	if (!i) return funcOnComplete();
// clear any pending resizes
	this.clearTimeout('resizeGroup');
// calc maximum size differential
	var diff = 0;
	while (i--) diff = Math.max(diff, Math.abs(arr[i][3] - arr[i][2]));
// resize rate is a log function of the diff size. makes a nice balance of speed and time.
// rate is the fractional amount of diff to do on each iteration (e.g., .1 for 10 increments).
	var rate = (diff && this.resizeDuration)? Math.pow(Math.max(1, 2.2 - this.resizeDuration/10), (Math.log(diff))) / diff : 1;
// instead of final pixel value, the last entry will be the pixel differential for this object
	i = arr.length;
	while (i--) arr[i][3] -= arr[i][2];
	this.resize(rate, 1, arr, funcOnComplete);
},

//****************************************************************/
// resize()
// Worker bee function for resizeGroup()
// Applies dimension styles and sets timer for next size increment
//****************************************************************/
resize: function(rate, count, arr, funcOnComplete) {
	if (arr) arguments.callee.arr = arr;
	if (funcOnComplete) arguments.callee.oncomplete = funcOnComplete;
	var arr = arguments.callee.arr;
// apply size changes to the objects listed in the setsize array
	var increment = rate * count;  // on each iteration, the increment offset from the starting position goes up by one rate fraction
	if (increment > 1) increment = 1;  // don't go beyond final value
// for each object in this array, extract the parameters and apply this iteration's size changes
	var i = arr.length;
	while (i--) {
		var obj = arr[i][0], prop = arr[i][1], startPx = arr[i][2], diff = arr[i][3];
		obj.style[prop] = (startPx + diff * increment) + 'px';
	}
// are we done?
	if (increment >= 1) {
		this.objTimeouts.resizeGroup = null;  // flag done with a null timer
		// run requested on-complete code
		if (arguments.callee.oncomplete) arguments.callee.oncomplete();
	} else {
// set a timer for the next iteration
		this.objTimeouts.resizeGroup = setTimeout(function() { fb.resize(rate, count + 1); }, 20);
	}
},

//********************************************************/
// getXScroll(), getYScroll()
// Return pixels by which the window is currently scrolled
//********************************************************/
getXScroll: function() {
	return this.win.pageXOffset || this.bod.scrollLeft || this.doc.documentElement.scrollLeft || 0;
},
getYScroll: function() {
	return this.win.pageYOffset || this.bod.scrollTop || this.doc.documentElement.scrollTop || 0;
},

//***************************************************/
// getDisplayWidth()
// Returns width of the browser's current view portal
//***************************************************/
getDisplayWidth: function() {
	// width is easy.  If the element width is given and not 0, it is correct.  Otherwise the body width is correct.
	return (this.doc.documentElement && this.doc.documentElement.clientWidth) || this.bod.clientWidth;
},

//****************************************************/
// getDisplayHeight()
// Returns height of the browser's current view portal
//****************************************************/
getDisplayHeight: function() {
	// Safari 2 (browser test borrowed from mootools (does anyone still use this browser?))
	if (this.doc.childNodes && !this.doc.all && !navigator.taintEnabled && !this.doc.evaluate) {
		return this.win.innerHeight;
	}
	// Opera is really messed up.
	// Before 9.5 body.clientHeight is the closest measurement but there's
	// a bug that excludes the body border from the reported height.
	// 9.5 body.clientHeight jumps all over depending if there's padding or not,
	// but the other measurements work more like ie and ff
	if (this.operaOld) {
		return this.bod.clientHeight;
	}
	var elementHeight = (this.doc.documentElement && this.doc.documentElement.clientHeight) || 0;
	// IEMac, others w. no doctype
	if (!elementHeight || (this.doc.compatMode === 'BackCompat')) {
		return this.bod.clientHeight;
	}
	// all others with doctypes
	return elementHeight;
},

//*******************************************************************/
// hideElements()
// Hides elements so they don't appear above the overlay and floatbox
// (For flash and the ie6 select z-index bug)
//*******************************************************************/
hideElements: function(tagName, thisWindow) {
	// thisWindow is used to recurse through all frames under the base window (usually top)
	if (!thisWindow) {
		// first call?  start with the floatbox host window
		this.hideElements(tagName, this.win);
	} else {
		// we've called in with a window object
		try {  // this has gakked on some ie machines
			var els = thisWindow.document.getElementsByTagName(tagName);
			var i = els.length;
			while (i--) {
				if (els[i].style.visibility !== 'hidden') {
					if (!this.objHiddenElements[tagName]) this.objHiddenElements[tagName] = [];
					this.objHiddenElements[tagName].push(els[i]);
					els[i].style.visibility = 'hidden';
				}
			}
		} catch(e) {}
		// recurse all the child frames
		var frames = thisWindow.frames;
		i = frames.length;
		while (i--) {
			if (typeof frames[i].window === 'object') this.hideElements(tagName, frames[i].window);
		}
	}
},

//******************************************************************/
// unhideElements()
// Unhides elements that have been hidden with a hideElements() call
//******************************************************************/
unhideElements: function(tagName) {
	var els, el;
	if ((els = this.objHiddenElements[tagName])) {
		while(els.length) {
			el = els.pop();
			el.style.visibility = '';
			if (ffOld) {  // ff2/mac helper
				el.focus();
				el.blur();
			}
		}
	}
},

//**************************************/
// clearTimeout()
// Cancels pending timeout of type 'key'
//**************************************/
clearTimeout: function(key) {
	if (this.objTimeouts[key]) {
		clearTimeout(this.objTimeouts[key]);
		this.objTimeouts[key] = null;
	}
},

//*********************************************/
// stretchOverlay()
// IE6 and IEQuirks window resize event handler
//*********************************************/
stretchOverlay: function() {
// avoid repeated screen flashes by waiting until browser resizing is complete before redrawing the overlay
	if (arguments.length == 1) {  // it's from a resize event
		fb.clearTimeout('onresize');  // cancel pending timeout
		fb.objTimeouts.onresize = setTimeout(function() { fb.stretchOverlay(); }, 25);  // set a new one for a bit later
	} else {  // called directly or from a surviving timer
		fb.objTimeouts.onresize = null;
		var width = fb.fbFloatbox.offsetLeft + fb.fbFloatbox.offsetWidth;
		var height = fb.fbFloatbox.offsetTop + fb.fbFloatbox.offsetHeight;
		var style = fb.fbOverlay.style;
		style.width = style.height = '0';  //shrink the overlay before measuring the doc body
		style.width = Math.max(width, fb.bod.scrollWidth, fb.bod.clientWidth, fb.doc.documentElement.clientWidth, fb.getDisplayWidth() + fb.getXScroll()) + 'px';
		style.height = Math.max(height, fb.bod.scrollHeight, fb.bod.clientHeight, fb.doc.documentElement.clientHeight, fb.getDisplayHeight() + fb.getYScroll()) + 'px';
	}
}

};  // end Floatbox prototype

//***************************/
// initfb()
// Create the floatbox object
//***************************/
function initfb() {
	if (arguments.callee.done) return;  // init once only
	// IE inits nested pages child first, which reverses the order and causes garbage collection to delete top.floatbox when a child frame is refreshed
	// Force parent-first initialization, but every page in the nested chain must have floatbox included
	if (self != top && !parent.fb) {
		setTimeout(initfb, 50);
		return;
	}
	arguments.callee.done = true;
	if (!top.floatbox) top.floatbox = new Floatbox();  // can only be run by the top page
	fb = top.floatbox;  // each nested doc gets fb defined
	fb.tagAnchors(self.document);  // attach behaviours to the anchors on this doc
	if (fb.autoStart) {  // run autoStart if requested
		fb.start(fb.autoStart);
		fb.autoStart = null;
	} else {  // if not auto-starting, start the image preload chain
		fb.preloadNextImage();
	}
};

//*********************************************************************************/
// Add listener to initialize floatbox when the dom is loaded (but before graphics)
// Modified from http://dean.edwards.name/weblog/2006/06/again/
// and from http://www.hedgerwow.com/360/dhtml/ie-dom-ondocumentready.html
//*********************************************************************************/
/*@cc_on
// Internet Explorer
/*@if (@_win32 || @_win64)
	fb_tempNode = document.createElement('div');
	(function() {
		if (document.readyState != 'complete') return setTimeout(arguments.callee, 50);
		try {
			fb_tempNode.doScroll('left');  //doScroll doesn't until the dom is fully loaded
		} catch(e) {
			return setTimeout(arguments.callee, 50);
		}
		initfb();
		delete fb_tempNode;
	})();
@else @*/
// Safari, Konquerer
	if (/Apple|KDE/i.test(navigator.vendor)) {
		(function() {
			if (/loaded|complete/.test(document.readyState)) {
				initfb();
			} else {
				setTimeout(arguments.callee, 50);
			}
		})();
// Mozilla, Opera9
	} else if (document.addEventListener) {
		document.addEventListener('DOMContentLoaded', initfb, false);
	}
/*@end
@*/

// Old or obscure browsers init here.
// Also fire window.onload for everyone in case the above dom-load routines fail or are delayed,
fb_prevOnload = window.onload;
window.onload = function() {
	if (typeof(fb_prevOnload) == 'function') fb_prevOnload();
	initfb();  // make sure floatbox is there - it should already be
};
