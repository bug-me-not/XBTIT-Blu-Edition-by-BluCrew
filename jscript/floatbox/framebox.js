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

	this.win = self;
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
	this.lowerPanelSpace = 24;
	this.controlSpacing = 8;
	this.resizeSpace = 6;
	this.initialSize = 300;
	this.showHintsTime = 1600;
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
tagAnchors: function(doc) {
	if (!window.opera) {
		var i = this.arrAnchors.length;
		while (i--) {
			try {
				var x = this.arrAnchors[i].href;
			} catch(e) {
				this.arrAnchors.splice(i, 1);
			}
		}
	}
	var reIsFbxd = /^(?:gallery|iframe|slideshow|lytebox|lyteshow|lyteframe|lightbox)/i;
	var reIsImg = /\.(?:jpg|jpeg|png|gif|bmp)\s*$/i;
	var reAuto = /autoStart\s*[:=]\s*true/i;
	var click = function () { fb.start(this); return false; };
	function tagAnchor(anchor) {
		var href = anchor.getAttribute('href');
		var rel = anchor.getAttribute('rel');
		var rev = anchor.getAttribute('rev');
		var title = anchor.getAttribute('title');
		if (reIsFbxd.test(rel)) {
			anchor.onclick = click;
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
				fb.arrAnchors.push(anchor);
				if (reIsImg.test(href)) fb.arrImageHrefs.push(href);
			}
			if (reAuto.test(rev)) fb.autoStart = anchor;
		}
	};
	var anchors = doc.getElementsByTagName('a');
	for (var i = 0, len = anchors.length; i < len; i++) {
		tagAnchor(anchors[i]);
	}
	anchors = doc.getElementsByTagName('area');
	for (var i = 0, len = anchors.length; i < len; i++) {
		tagAnchor(anchors[i]);
	}
},
preloadNextImage: function(href) {
	if (!href && !this.blockPreloadChain && (this.defaultOptions.preloadAll || !this.preloadCount)) {
		for (var i = 0, len = this.arrImageHrefs.length; i < len; i++) {
			var h = this.arrImageHrefs[i];
			if (!this.objImagePreloads[h]) {
				var href = h;
				break;
			}
		}
	}
	if (href) {
		this.preloadCount++;
		this.objImagePreloads[href] = new Image();
		this.objImagePreloads[href].onload = this.objImagePreloads[href].onerror =
			function() { setTimeout(function() { fb.preloadNextImage() }, 200) };
		this.objImagePreloads[href].src = href;
	}
},
setNode: function(nodeType, id, parentNode, title) {
	var node = this.doc.getElementById(id);
	if (!node) {
		node = this.doc.createElement(nodeType);
		if (id) node.id = id;
		if (nodeType == 'a') node.setAttribute('href', '#');
		if (title && this.showHints != 'never') node.setAttribute('title', title);
		if (nodeType == 'iframe') {
			node.setAttribute('scrolling', this.itemScrolling);
			node.setAttribute('frameBorder', '0');
			node.setAttribute('align', 'middle');
			node.src = 'javascript:("");';
		}
		parentNode.appendChild(node);
	}
	node.className = id + '_' + this.theme;
	node.style.display = 'none';
	return node;
},
buildDOM: function() {
	this.fbOverlay		= this.setNode('div', 'fbOverlay', this.bod);
	this.fbFloatbox		= this.setNode('div', 'fbFloatbox', this.bod);
	this.fbLoader		= this.setNode('div', 'fbLoader', this.fbFloatbox);
	this.fbContentPanel	= this.setNode('div', 'fbContentPanel', this.fbFloatbox);
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
parseOptionString: function(str) {
	if (!str) return {};
	var quotes = [], match;
	var rexp = /`(.*?)`/g;
	while (match = rexp.exec(str)) quotes.push(match[1]);
	if (quotes.length) str = str.replace(rexp, '``');
	str = str.replace(/\s*[:=]\s*/g, ':');
	str = str.replace(/\s*[;&]\s*/g, ' ');
	str = str.replace(/^\s+|\s+$/g, '');
	var aVars = str.split(' ');
	var pairs = {};
	var i = aVars.length, j = quotes.length;
	while (i--) {
		var aThisVar = aVars[i].split(':');
		if (aThisVar[1] == '``') aThisVar[1] = quotes[--j] || '';
		pairs[aThisVar[0]] = aThisVar[1];
	}
	return pairs;
},
setOptions: function(pairs) {
	if (typeof(pairs) != 'object') return;
	for (var name in pairs) {
		var value = pairs[name];
		if (typeof(value) == 'string') {
			if (name.indexOf('str') != 0) value = value.toLowerCase();
			if (isNaN(value)) {
				if (value == 'true') {
					this[name] = true;
				} else if (value == 'false') {
					this[name] = false;
				} else if (value) {
					this[name] = value;
				}
			} else {
				this[name] = +value;
			}
		} else {
			this[name] = value;
		}
	}
},
start: function(anchor) {
	anchor.blur();
	this.itemCount = this.arrItems.length = this.itemsShown = this.resizeCounter = 0;
	this.currentItem = -1;
	var href = anchor.getAttribute('href');
	var rel = anchor.getAttribute('rel');
	var rev = anchor.getAttribute('rev');
	var title = anchor.getAttribute('title');
	this.isIframe = /^(iframe|lyteframe)/i.test(rel);
	if (!this.isIframe) {
		this.blockPreloadChain = true;
		this.preloadNextImage(href);
	}
	var reDontShow = /showThis\s*[:=]\s*false/i;
	if (/^(gallery|iframe|lytebox|lyteframe|lightbox)$/i.test(rel)) {
		if (href && !reDontShow.test(rev)) {
			this.arrItems.push( {href: href, title: title, rev: rev, seen: false} );
		}
	} else {
		for (var i = 0, len = this.arrAnchors.length; i < len; i++) {
			var href_i = this.arrAnchors[i].getAttribute('href');
			var rev_i = this.arrAnchors[i].getAttribute('rev');
			if (this.arrAnchors[i].getAttribute('rel') == rel) {
				if (href_i && !reDontShow.test(rev_i)) {
					this.arrItems.push( {
						href: this.arrAnchors[i].getAttribute('href'),
						title: this.arrAnchors[i].getAttribute('title'),
						rev: rev_i, seen: false
					} );
				}
			}
		}
	}
	this.itemCount = this.arrItems.length;
	this.modal = this.doSlideshow = this.loadPageOnClose = false;
	this.setOptions(this.defaultOptions);
	if (typeof(this.win.setFloatboxOptions) == 'function') this.win.setFloatboxOptions();
	if (this.enableCookies) {
		var match = /fbOptions=(.+?)(;|$)/.exec(this.doc.cookie);
		if (match) this.setOptions(this.parseOptionString(match[1]));
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
	this.setOptions(this.parseOptionString(rev));
	this.setOptions(this.parseOptionString(this.win.location.search.substring(1)));
	if (this.theme == 'grey') this.theme = 'white';
	if (!/^(auto|black|white|blue|yellow|red|custom)$/.test(this.theme)) this.theme='auto';
	if (this.theme == 'auto') this.theme = this.isIframe? 'white' : 'black';
	if (this.endTask == 'cont') this.endTask = 'loop';
	this.isSlideshow = this.itemCount > 1 && (/^(slideshow|lyteshow)/i.test(rel) || this.doSlideshow);
	this.isPaused = this.startPaused;
	if (this.isIframe) {
		this.autoResize = this.showResize = false;
		if (this.ffOld) this.disableScroll = true;
	}
	if (this.modal && (this.isSlideshow || this.isIframe)) {
		this.navType = 'none';
		this.showClose = false;
		this.showPlayPause = false;
		this.enableKeyboardNav = false;
		this.outsideClickCloses = false;
		this.showHints = 'never';
	}
	if (!/^(upper|lower|both|none)$/i.test(this.navType)) this.navType = 'both';
	if (this.itemCount <= 1) {
		this.navType = 'none';
		this.showItemNumber = false;
	} else if (this.isIframe && /upper|both/i.test(this.navType)) {
		this.navType = 'lower';
	}
	this.upperNav = /upper|both/i.test(this.navType);
	this.lowerNav = /lower|both/i.test(this.navType);
	if (this.upperNav) {
		if (this.upperNavWidth < 0) this.upperNavWidth = 0;
		if (this.upperNavWidth > 50) this.upperNavWidth = 50;
	}
	if (this.showHints == 'once') {
		this.hideHint = function(id) {
			if (this[id].title) this.objTimeouts[id] = setTimeout(function() { fb[id].title = ''; }, this.showHintsTime);
		};
	} else {
		this.hideHint = function() { return; };
	}
	this.buildDOM();
	this.fbResize.onclick = function() { fb.scaleItem = this.scaleItem; fb.loadItem(fb.currentItem); return false; };
	this.fbPlay.onclick = function() { fb.setPause(false); return false; };
	this.fbPause.onclick = function() { fb.setPause(true); return false; };
	this.fbClose.onclick = function() { fb.end(); return false; };
	if (this.outsideClickCloses) this.fbOverlay.onclick = function() { fb.end(); return false; };
	this.fbLowerPrevA.onclick = function() {
		if (fb.enableWrap || fb.currentItem != 0) {
			fb.loadItem((fb.currentItem == 0)? fb.itemCount - 1 : fb.currentItem - 1);
			if (fb.isSlideshow  && fb.pauseOnPrev && !fb.isPaused && fb.showPlayPause) {
				fb.setPause(true);
			}
		}
		return false;
	};
	this.fbLowerNextA.onclick = function() {
		if (fb.enableWrap || fb.currentItem != fb.itemCount - 1) {
			fb.loadItem((fb.currentItem == fb.itemCount - 1)? 0 : fb.currentItem + 1);
			if (fb.isSlideshow && fb.pauseOnNext && !fb.isPaused && fb.showPlayPause) {
				fb.setPause(true);
			}
		}
		return false;
	};
	if (this.upperNav) {
		this.fbLeftNav.onclick = this.fbUpperPrev.onclick = this.fbLowerPrevA.onclick;
		this.fbRightNav.onclick = this.fbUpperNext.onclick = this.fbLowerNextA.onclick;
		this.fbLeftNav.onmouseover = this.fbLeftNav.onmousemove =
		this.fbUpperPrev.onmousemove = function() {
			if (!fb.objTimeouts.fbContentPanel) fb.fbUpperPrev.style.visibility = 'visible';
			if (fb.lowerNav && !fb.showUpperNav) fb.fbLowerPrevA.style.backgroundPosition = 'bottom';
			return true;
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
		this.fbLeftNav.onmouseout = function() {
			fb.fbUpperPrev.style.visibility = 'hidden';
			if (fb.lowerNav) fb.fbLowerPrevA.style.backgroundPosition = 'top';
		};
		this.fbRightNav.onmouseout = function() {
			fb.fbUpperNext.style.visibility = 'hidden';
			if (fb.lowerNav) fb.fbLowerNextA.style.backgroundPosition = 'top';
		};
		this.fbUpperPrev.onmouseout = this.fbUpperNext.onmouseout = function() {
			this.style.visibility = 'hidden';
			fb.clearTimeout(this.id);
		};
		this.fbLeftNav.onmouseup = this.fbRightNav.onmouseup = function(evt) {
			var e = evt || fb.win.event;
			if (e.button == 2) {
				fb.fbLeftNav.style.display = fb.fbRightNav.style.display = 'none';
				setTimeout(function() { if (fb.fbLeftNav) fb.fbLeftNav.style.display = fb.fbRightNav.style.display = ''; }, 20);
			}
		};
	}
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
	if (this.enableKeyboardNav) {
		this.priorOnkeydown = this.doc.onkeydown;
		this.doc.onkeydown = this.keyboardAction;
	}
	if (window.opera) {
		this.priorOnkeypress = this.doc.onkeypress;
		this.doc.onkeypress = function() { return false; };
	}
	if (this.ieOld || this.ieQuirks) {
		this.hideElements('select');
		this.fbOverlay.style.position = 'absolute';
		this.win.attachEvent('onresize', fb.stretchOverlay);
		this.win.attachEvent('onscroll', fb.stretchOverlay);
		this.stretchOverlay();
	}
	if (this.ieOld && this.isIframe) this.innerBorder = 0;
	if (this.hideFlash) {
		this.hideElements('object');
		this.hideElements('embed');
	}
	if (this.hideJava) this.hideElements('applet');
	var callback = function() {
		setTimeout(function() { fb.turnOn(href, rev, title); }, 10);
	};
	this.fade(this.fbOverlay, 0, this.overlayOpacity, callback);
},
turnOn: function(href, rev, title) {
	this.fbFloatbox.style.position = 'absolute';
	this.fbFloatbox.style.width = this.fbFloatbox.style.height = this.fbFloatbox.style.borderWidth = '0';
	this.fbFloatbox.style.left = (this.getDisplayWidth() / 2 + this.getXScroll()) + 'px';
	this.fbFloatbox.style.top = (this.getDisplayHeight() / 3 + this.getYScroll()) + 'px';
	this.fbFloatbox.style.display = this.fbContentPanel.style.display = this.fbLoader.style.display = '';
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
			this.fbUpperPrev.style.visibility = this.fbUpperNext.style.visibility = 'hidden';
		}
	}
	if (this.lowerNav) {
		this.fbLowerNav.style.paddingRight = this.controlSpacing + 'px';
		this.fbLowerNav.style.display = this.fbLowerPrev.style.display = this.fbLowerPrevA.style.display =
		this.fbLowerNext.style.display = this.fbLowerNextA.style.display = '';
	}
	this.fbResize.style.left = this.fbResize.style.top = (this.padding + this.innerBorder) + 'px';
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
	this.xFramework = 2*(this.outerBorder + this.innerBorder + this.padding);
	this.yFramework = this.xFramework - this.padding;
	for (i = this.itemCount - 1; i > 0; i--) {
		if (this.arrItems[i].href == href &&
			this.arrItems[i].rev == rev &&
			this.arrItems[i].title == title) {
			break;
		}
	}
	setTimeout(function() { fb.loadItem(i); }, 10);
},
loadItem: function(newItem) {
	this.clearTimeout('slideshow');
	this.clearTimeout('resizeGroup');
	this.blockPreloadChain = true;
	this.win.focus();
	this.isFirstItem = (this.currentItem == -1);
	if (this.currentItem != newItem) {
		this.resizeActive = false;
		if (this.showUpperNav == 'once' && this.upperNavShown) this.showUpperNav = false;
		this.currentItem = newItem;
	}
	this.revOptions = this.parseOptionString(this.arrItems[this.currentItem].rev);
	this.currentHref = this.arrItems[this.currentItem].href;
	if (this.displayWidth != (this.displayWidth = this.getDisplayWidth())) this.resizeActive = false;
	if (this.displayHeight != (this.displayHeight = this.getDisplayHeight())) this.resizeActive = false;
	this.fbContentPanel.style.visibility = 'hidden';
	this.fbResize.style.display = 'none';
	if (this.fbItem) {
		this.fbContentPanel.removeChild(this.fbItem);
		delete this.fbItem;
	};
	if (this.upperNav) {
		this.fbUpperPrev.style.visibility = this.fbUpperNext.style.visibility = 'hidden';
		this.fbLeftNav.style.height = this.fbRightNav.style.height = '0';
		if (!this.showUpperNav) this.fbUpperPrev.style.display = this.fbUpperNext.style.display = 'none';
	}
	if (this.fbFloatbox.style.position == 'fixed') {
		this.fbFloatbox.style.left = (this.fbFloatbox.offsetLeft + this.getXScroll()) + 'px';
		this.fbFloatbox.style.top = (this.fbFloatbox.offsetTop + this.getYScroll()) + 'px';
		this.fbFloatbox.style.position = 'absolute';
	}
	this.fbCaption.style.display = this.fbItemNumber.style.display = 'none';
	if (this.showCaption) {
		var sCaption = this.revOptions.caption? this.revOptions.caption : this.arrItems[this.currentItem].title || '';
		if (sCaption == 'href') sCaption = this.currentHref;
		sCaption = sCaption.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"').replace(/&apos;/g, "'").replace(/&amp;/g, '&');
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
		this.objTimeouts.firstLoad = setTimeout(function() {
			fb.fbFloatbox.style.left = (fb.fbFloatbox.offsetLeft - fb.initialSize/2) + 'px';
			fb.fbFloatbox.style.top = (fb.fbFloatbox.offsetTop - fb.initialSize/3) + 'px';
			fb.fbFloatbox.style.width = fb.fbFloatbox.style.height = fb.initialSize + 'px';
			fb.fbFloatbox.style.borderWidth = fb.outerBorder + 'px';
		}, 500);
	} else if (!this.resizeCounter) {
		this.objTimeouts.loader = setTimeout(function() { fb.fbLoader.style.display = ''; }, 120);
	}
	if (this.isIframe) {
		setTimeout(function() { fb.setSize(); }, 10);
	} else {
		var loader = new Image();
		loader.onload = function() { fb.setSize(this.width, this.height); };
		loader.onerror = function() {
			fb.fbCaption.innerHTML = fb.currentHref.substring(fb.currentHref.lastIndexOf('/') + 1);
			fb.fbCaption.style.display = '';
			if (fb.currentHref != fb.url404Image) {
				this.src = fb.currentHref = fb.url404Image;
			} else {
				fb.setSize();
			}
		};
		loader.src = this.currentHref;
	}
},
setSize: function(imageWidth, imageHeight) {
	this.clearTimeout('firstLoad');
	if (typeof(this.panelHeight) == 'undefined') {
		if (!this.fbCaption.style.display || !this.fbItemNumber.style.display || !this.fbControlPanel.style.display || this.lowerNav) {
			this.panelHeight = 15 + 2*this.panelPadding;
			if (!this.fbCaption.style.display && this.showItemNumber) this.panelHeight += 15;
		} else {
			this.panelHeight = this.padding;
		}
	}
	var maxWidth = this.displayWidth - this.xFramework - 2*this.resizeSpace;
	var maxHeight = this.displayHeight - this.yFramework - this.panelHeight - 2*this.resizeSpace;
	var width = 0, height = 0;
	this.itemScrolling = 'auto';
	if (this.revOptions.width) width = (this.revOptions.width == 'max')? maxWidth : parseInt(this.revOptions.width);
	if (this.revOptions.height) height = (this.revOptions.height == 'max')? maxHeight : parseInt(this.revOptions.height);
	if (this.revOptions.scrolling) {
		if (this.isIframe && /yes|no/i.test(this.revOptions.scrolling)) this.itemScrolling = this.revOptions.scrolling;
	}
	width = width || imageWidth || 500;
	height = height || imageHeight || 300;
	this.nativeWidth = width;
	this.nativeHeight = height;
	if (typeof(this.scaleItem) == 'undefined') this.scaleItem = this.autoResize;
	if (this.scaleItem) {
		var scale = Math.min(maxWidth / width, maxHeight / height);
		if (scale < 1) {
			width = Math.round(width * scale);
			height = Math.round(height * scale);
		}
	}
	if (this.isFirstItem) this.fbFloatbox.style.borderWidth = this.outerBorder + 'px';
	if (this.upperNav && this.showUpperNav) {
		this.fbUpperPrev.style.top = this.fbUpperNext.style.top =
			(height * this.upperNavPos/100 + this.padding + this.innerBorder) + 'px';
	}
	this.newWidth = width + this.xFramework;
	this.infoPanelHeight = 0;
	this.fbInfoPanel.style.display = this.fbControlPanel.style.display = '';
	if (!this.fbCaption.style.display || !this.fbItemNumber.style.display) {
		var ipWidth = this.newWidth - 2*(this.outerBorder + Math.max(this.padding, 8)) - this.lowerPanelSpace - this.fbControlPanel.offsetWidth;
		if (ipWidth > 80) {
			this.fbInfoPanel.style.width = ipWidth + 'px';
			this.fbInfoPanel.style.left = '-9999px';
			this.infoPanelHeight = this.fbInfoPanel.offsetHeight;
		}
	}
	this.panelHeight = Math.max(this.infoPanelHeight, this.fbControlPanel.offsetHeight);
	this.fbInfoPanel.style.display = this.fbControlPanel.style.display = 'none';
	if (this.panelHeight) this.panelHeight += 2*this.panelPadding;
	this.panelHeight = Math.max(this.panelHeight, this.padding);
	this.newHeight = this.yFramework + height + this.panelHeight;
	if ((this.scaleItem || height == maxHeight) && this.newHeight > this.displayHeight) {
		if (this.resizeCounter++ < 3) {
			return this.loadItem(this.currentItem);
		}
	}
	var freeSpace = this.displayWidth - this.newWidth;
	var newLeft = (freeSpace <= 0)? 0 : Math.floor(freeSpace/2);
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
	if (this.getXScroll() || this.getYScroll()) {
		this.fbFloatbox.style.display = 'none';
		if (this.ieOld || this.ieQuirks) this.stretchOverlay();
		newLeft += this.getXScroll();
		newTop += this.getYScroll();
		this.fbFloatbox.style.display = '';
	}
	this.itemWidth = width;
	this.itemHeight = height;
	var oldLeft = this.fbFloatbox.offsetLeft, oldTop = this.fbFloatbox.offsetTop;
	var oldWidth = this.fbFloatbox.offsetWidth, oldHeight = this.fbFloatbox.offsetHeight;
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
	this.fbInfoPanel.style.left = Math.max(this.padding, 8) + 'px';
	this.resizeGroup(this.arrResize1, function() {
		fb.resizeGroup(fb.arrResize2, function() { fb.showContent(); })
	});
},
showContent: function() {
	this.clearTimeout('loader');
	var vscrollChanged = (this.displayWidth != (this.displayWidth = this.getDisplayWidth()));
	var hscrollChanged = (this.displayHeight != (this.displayHeight = this.getDisplayHeight()));
	if (this.resizeCounter++ < 4) {
		var tolerance = 25 + 2*this.resizeSpace;
		if ((vscrollChanged && Math.abs(this.newWidth - this.displayWidth) < tolerance)
		||  (hscrollChanged && Math.abs(this.newHeight - this.displayHeight) < tolerance))
			return this.loadItem(this.currentItem);
	}
	this.resizeCounter = 0;
	if (this.ieOld || this.ieQuirks) this.stretchOverlay();
	if (this.disableScroll && !(this.ieOld || this.ieQuirks || this.operaQuirks)) {
		if (this.newWidth <= this.displayWidth && this.newHeight <= this.displayHeight) {
			this.fbFloatbox.style.position = 'fixed';
			this.fbFloatbox.style.left = (this.fbFloatbox.offsetLeft - this.getXScroll()) + 'px';
			this.fbFloatbox.style.top = (this.fbFloatbox.offsetTop - this.getYScroll()) + 'px';
		}
	}
	this.fbItem = this.setNode((this.isIframe? 'iframe' : 'img'), 'fbItem', this.fbContentPanel);
	this.fbItem.width = this.itemWidth;
	this.fbItem.height = this.itemHeight;
	this.fbItem.src = this.currentHref;
	this.fbItem.style.left = this.fbItem.style.top = this.padding + 'px';
	this.fbItem.style.borderWidth = this.innerBorder + 'px';
	if (this.upperNav) {
		this.fbLeftNav.style.width = this.fbRightNav.style.width = Math.max(this.upperNavWidth/100 * this.itemWidth, this.fbUpperPrev.offsetWidth) + 'px';
		this.fbLeftNav.style.height = this.fbRightNav.style.height = this.itemHeight + 'px';
	}
	var panelTop = this.itemHeight + 2*this.innerBorder + this.padding;
	if (this.infoPanelHeight) {
		this.fbInfoPanel.style.display = '';
		this.fbInfoPanel.style.top = (panelTop + (this.panelHeight - this.fbInfoPanel.offsetHeight) / 2) + 'px';
	}
	if (this.showClose || this.showPlayPause || this.lowerNav) {
		this.fbControlPanel.style.display = '';
		this.fbControlPanel.style.top = (panelTop + (this.panelHeight - this.fbControlPanel.offsetHeight) / 2) + 'px';
	}
	delete this.panelHeight;
	this.prevItem = this.currentItem? this.currentItem - 1 : this.itemCount - 1;
	this.nextItem = (this.currentItem < this.itemCount - 1)? this.currentItem + 1 : 0;
	var prevHref = (this.enableWrap || this.currentItem != 0)? this.arrItems[this.prevItem].href : '';
	var nextHref = (this.enableWrap || this.currentItem != this.itemCount - 1)?  this.arrItems[this.nextItem].href : '';
	if (this.lowerNav) {
		this.fbLowerPrevA.href = prevHref;
		this.fbLowerPrevA.style.left = prevHref? '' : '-9999px';
		this.fbLowerNextA.href = nextHref;
		this.fbLowerNextA.style.left = nextHref? '' : '-9999px';
		this.fbLowerNav.style.visibility = '';
	}
	if (this.upperNav) {
		if (window.opera || this.ffNew) {
			this.fbLeftNav.href = this.fbUpperPrev.href =
			this.fbRightNav.href = this.fbUpperNext.href = this.currentHref;
		} else {
			this.fbLeftNav.href = this.fbUpperPrev.href = prevHref;
			this.fbRightNav.href = this.fbUpperNext.href = nextHref;
		}
		this.fbLeftNav.style.visibility = prevHref? 'visible' : 'hidden';
		this.fbRightNav.style.visibility = nextHref? 'visible' : 'hidden';
		this.upperNavShown = true;
	}
	delete this.scaleItem;
	if (this.showResize) {
		if (this.resizeActive) {
			this.fbResize.scaleItem = !this.fbResize.scaleItem;
		} else {
			var xtra = this.outerBorder;
			if (this.newWidth - xtra - this.padding > this.displayWidth
			|| this.newHeight - xtra - this.panelPadding > this.displayHeight) {
				this.fbResize.scaleItem = true;
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
	this.fade(this.fbContentPanel, 0, 100);
	this.fbLoader.style.display = 'none';
	this.fbItem.style.display = this.fbControlPanel.style.visibility = '';
	if (window.opera && this.isIframe) {
		var src = this.fbItem.src;
		this.fbItem.src = '';
		setTimeout(function() { fb.fbItem.src = src; }, 10);
	}
	if (!this.arrItems[this.currentItem].seen) {
		this.arrItems[this.currentItem].seen = true;
		this.itemsShown++;
	}
	this.blockPreloadChain = false;
	this.preloadNextImage(this.isIframe? '' : this.arrItems[this.nextItem].href);
	if (this.isSlideshow && !this.isPaused) {
		if (this.endTask == 'loop' || this.itemsShown < this.itemCount) {
			this.objTimeouts.slideshow = setTimeout(function() { fb.loadItem(fb.nextItem); }, this.slideInterval*1000);
		} else if (this.endTask == 'exit') {
			this.objTimeouts.slideshow = setTimeout(function() { fb.end(); }, this.slideInterval*1000);
		} else {
			this.objTimeouts.slideshow = setTimeout(function() { fb.setPause(true); }, this.slideInterval*1000);
			var i = this.itemCount;
			while (i--) this.arrItems[i].seen = false;
			this.itemsShown = 0;
		}
	}
},
end: function() {
	for (var key in this.objTimeouts) this.clearTimeout(key);
	if (this.enableKeyboardNav) this.doc.onkeydown = this.priorOnkeydown;
	if (window.opera) this.doc.onkeypress = this.priorOnkeypress;
	this.fbOverlay.onclick = null;
	this.fbFloatbox.style.display = 'none';
	if (this.ieOld || this.ieQuirks) {
		this.win.detachEvent('onresize', fb.stretchOverlay);
		this.win.detachEvent('onscroll', fb.stretchOverlay);
	}
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
keyboardAction: function(evt) {
	var e = evt || fb.win.event;
	var keyCode = e.which || e.keyCode;
	switch (keyCode) {
		case 37: case 39:
			if (fb.itemCount > 1) {
				(keyCode == 37)? fb.fbLowerPrevA.onclick() : fb.fbLowerNextA.onclick();
				if (fb.showHints == 'once') {
					fb.fbLowerPrevA.title = fb.fbLowerNextA.title = '';
					if (fb.upperNav) fb.fbUpperPrev.title = fb.fbUpperNext.title = '';
				}
			}
			return false;
		case 32:
			if (fb.isSlideshow) {
				fb.setPause(!fb.isPaused);
				if (fb.showHints == 'once') fb.fbPlay.title = fb.fbPause.title = '';
			}
			return false;
		case 9:
			if (fb.resizeActive) {
				fb.fbResize.onclick();
				if (fb.showHints == 'once') fb.fbResize.title = '';
			}
			return false;
		case 27:
			if (fb.showHints == 'once') fb.fbClose.title = '';
			fb.end();
			return false;
		case 13:
			return false;
	}
},
setPause: function(bPause) {
	this.isPaused = bPause;
	if (bPause) {
		this.clearTimeout('slideshow');
	} else {
		this.loadItem(this.nextItem);
	}
	if (this.showPlayPause) {
		this.fbPlay.style.left = bPause? '' : '-9999px';
		this.fbPause.style.left = bPause? '-9999px' : '';
	}
},
fade: function(obj, startOp, finishOp, funcOnComplete) {
	if (!funcOnComplete) var funcOnComplete = function() { return; };
	this.clearTimeout(obj.id);
	if (typeof(finishOp) == 'undefined') finishOp = startOp;
	var fadeIn = (startOp <= finishOp && finishOp > 0);
	var duration = (obj.id == 'fbOverlay')? this.overlayFadeDuration : this.imageFadeDuration;
	if (duration > 10) duration = 10;
	if (duration < 0) duration = 0;
	if (duration == 0) {
		startOp = finishOp;
		var incr = 100;
	} else {
		var root = Math.pow(100, .1);
		var power = duration + ((10 - duration)/9) * (Math.log(2)/Math.log(root) - 1);
		var incr = Math.round(100/Math.pow(root, power));
	}
	if (!fadeIn) incr = -incr;
	this.setOpacity(obj, startOp, finishOp, incr, fadeIn, funcOnComplete);
	if (fadeIn) {
		obj.style.display = '';
		obj.style.visibility = 'visible';
	}
},
setOpacity: function(obj, thisOp, finishOp, incr, fadeIn, funcOnComplete) {
	if (funcOnComplete) arguments.callee.oncomplete = funcOnComplete;
	if ((fadeIn && thisOp >= finishOp) || (!fadeIn && thisOp <= finishOp)) thisOp = finishOp;
	if (fb.ie) {
		obj.style.filter = 'alpha(opacity=' + thisOp + ')';
	} else {
		obj.style.opacity = obj.style.MozOpacity = obj.style.KhtmlOpacity = thisOp/100;
	}
	if (thisOp == finishOp) {
		this.objTimeouts[obj.id] = null;
		if (fb.ie && finishOp >= 100) {
			try { obj.style.removeAttribute('filter'); } catch(e) {}
		}
		if (arguments.callee.oncomplete) arguments.callee.oncomplete();
	} else {
		this.objTimeouts[obj.id] = setTimeout(function() { fb.setOpacity(fb[obj.id], thisOp + incr, finishOp, incr, fadeIn); }, 20);
	}
},
resizeGroup: function(arr, funcOnComplete) {
	if (!funcOnComplete) var funcOnComplete = function() { return; };
	var i = arr.length;
	if (!i) return funcOnComplete();
	this.clearTimeout('resizeGroup');
	var diff = 0;
	while (i--) diff = Math.max(diff, Math.abs(arr[i][3] - arr[i][2]));
	var rate = (diff && this.resizeDuration)? Math.pow(Math.max(1, 2.2 - this.resizeDuration/10), (Math.log(diff))) / diff : 1;
	i = arr.length;
	while (i--) arr[i][3] -= arr[i][2];
	this.resize(rate, 1, arr, funcOnComplete);
},
resize: function(rate, count, arr, funcOnComplete) {
	if (arr) arguments.callee.arr = arr;
	if (funcOnComplete) arguments.callee.oncomplete = funcOnComplete;
	var arr = arguments.callee.arr;
	var increment = rate * count;
	if (increment > 1) increment = 1;
	var i = arr.length;
	while (i--) {
		var obj = arr[i][0], prop = arr[i][1], startPx = arr[i][2], diff = arr[i][3];
		obj.style[prop] = (startPx + diff * increment) + 'px';
	}
	if (increment >= 1) {
		this.objTimeouts.resizeGroup = null;
		if (arguments.callee.oncomplete) arguments.callee.oncomplete();
	} else {
		this.objTimeouts.resizeGroup = setTimeout(function() { fb.resize(rate, count + 1); }, 20);
	}
},
getXScroll: function() {
	return this.win.pageXOffset || this.bod.scrollLeft || this.doc.documentElement.scrollLeft || 0;
},
getYScroll: function() {
	return this.win.pageYOffset || this.bod.scrollTop || this.doc.documentElement.scrollTop || 0;
},
getDisplayWidth: function() {
	return (this.doc.documentElement && this.doc.documentElement.clientWidth) || this.bod.clientWidth;
},
getDisplayHeight: function() {
	if (this.doc.childNodes && !this.doc.all && !navigator.taintEnabled && !this.doc.evaluate) {
		return this.win.innerHeight;
	}
	if (this.operaOld) {
		return this.bod.clientHeight;
	}
	var elementHeight = (this.doc.documentElement && this.doc.documentElement.clientHeight) || 0;
	if (!elementHeight || (this.doc.compatMode === 'BackCompat')) {
		return this.bod.clientHeight;
	}
	return elementHeight;
},
hideElements: function(tagName, thisWindow) {
	if (!thisWindow) {
		this.hideElements(tagName, this.win);
	} else {
		try {
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
		var frames = thisWindow.frames;
		i = frames.length;
		while (i--) {
			if (typeof frames[i].window === 'object') this.hideElements(tagName, frames[i].window);
		}
	}
},
unhideElements: function(tagName) {
	var els, el;
	if ((els = this.objHiddenElements[tagName])) {
		while(els.length) {
			el = els.pop();
			el.style.visibility = '';
			if (ffOld) {
				el.focus();
				el.blur();
			}
		}
	}
},
clearTimeout: function(key) {
	if (this.objTimeouts[key]) {
		clearTimeout(this.objTimeouts[key]);
		this.objTimeouts[key] = null;
	}
},
stretchOverlay: function() {
	if (arguments.length == 1) {
		fb.clearTimeout('onresize');
		fb.objTimeouts.onresize = setTimeout(function() { fb.stretchOverlay(); }, 25);
	} else {
		fb.objTimeouts.onresize = null;
		var width = fb.fbFloatbox.offsetLeft + fb.fbFloatbox.offsetWidth;
		var height = fb.fbFloatbox.offsetTop + fb.fbFloatbox.offsetHeight;
		var style = fb.fbOverlay.style;
		style.width = style.height = '0';
		style.width = Math.max(width, fb.bod.scrollWidth, fb.bod.clientWidth, fb.doc.documentElement.clientWidth, fb.getDisplayWidth() + fb.getXScroll()) + 'px';
		style.height = Math.max(height, fb.bod.scrollHeight, fb.bod.clientHeight, fb.doc.documentElement.clientHeight, fb.getDisplayHeight() + fb.getYScroll()) + 'px';
	}
}
};
function initfb() {
	if (arguments.callee.done) return;
	arguments.callee.done = true;
	self.floatbox = new Floatbox();
	fb = self.floatbox;
	fb.tagAnchors(self.document);
	if (fb.autoStart) {
		fb.start(fb.autoStart);
		fb.autoStart = null;
	} else {
		fb.preloadNextImage();
	}
};
/*@cc_on
/*@if (@_win32 || @_win64)
	fb_tempNode = document.createElement('div');
	(function() {
		if (document.readyState != 'complete') return setTimeout(arguments.callee, 50);
		try {
			fb_tempNode.doScroll('left');
		} catch(e) {
			return setTimeout(arguments.callee, 50);
		}
		initfb();
		delete fb_tempNode;
	})();
@else @*/
	if (/Apple|KDE/i.test(navigator.vendor)) {
		(function() {
			if (/loaded|complete/.test(document.readyState)) {
				initfb();
			} else {
				setTimeout(arguments.callee, 50);
			}
		})();
	} else if (document.addEventListener) {
		document.addEventListener('DOMContentLoaded', initfb, false);
	}
/*@end
@*/
fb_prevOnload = window.onload;
window.onload = function() {
	if (typeof(fb_prevOnload) == 'function') fb_prevOnload();
	initfb();
};
