/*
---
description: A plugin that creates a non-obstrusive star rating control based on a set of radio input boxes. Based on Diego Alto's jQuery Star Rating Plugin.

license: MIT-style

authors:
- Lorenzo Stanco

requires:
- core/1.3: '*'

provides: [MooStarRating]

...
*/

var MooStarRatingImages = {
	defaultImageFolder: '',
	defaultImageEmpty:  'star_empty.png',
	defaultImageFull:   'star_full.png',
	defaultImageHover:  null
};

var MooStarRating = new Class({

	Implements: [Options, Events],

	options: {
		form: null,
		radios: 'rating',
		selector: '',
		linksClass: 'star',
		imageFolder: MooStarRatingImages.defaultImageFolder,
		imageEmpty:  MooStarRatingImages.defaultImageEmpty,
		imageFull:   MooStarRatingImages.defaultImageFull,
		imageHover:  MooStarRatingImages.defaultImageHover,
		width: 16,
		height: 16,
		half: false,
		tip: null,
		tipTarget: null,
		tipTargetType: 'text',
		disabled: false
	},
	
	radios: [],
	stars: [],
	currentIndex: -1,

	initialize: function(options) {
		
		// Setup options
		this.setOptions({
			imageFolder: MooStarRatingImages.defaultImageFolder,
			imageEmpty:  MooStarRatingImages.defaultImageEmpty,
			imageFull:   MooStarRatingImages.defaultImageFull,
			imageHover:  MooStarRatingImages.defaultImageHover });
		this.setOptions(options);
		
		// Fix image folder
		if ((this.options.imageFolder.length != 0) && (this.options.imageFolder.substr(-1) != "/")) 
			this.options.imageFolder += "/";
		
		// Hover image as full if none specified
		if (this.options.imageHover == null) this.options.imageHover = this.options.imageFull;
		
		// Preload images
		try { Asset.images([
			this.options.imageFolder + this.options.imageEmpty,
			this.options.imageFolder + this.options.imageFull,
			this.options.imageFolder + this.options.imageHover
		]); } catch (e) { };
		
		// Build radio selector
		var formQuery = this.options.form;
		this.options.form = $(formQuery);
		if (!this.options.form) this.options.form = $$('form[name=' + formQuery + "]")[0];
		if (this.options.form) {
			var uniqueId = 'star_' + String.uniqueID();
			this.options.form.addClass(uniqueId);
			this.options.selector += 'form.' + uniqueId + ' '; }
		this.options.selector += 'input[type=radio][name=' + this.options.radios + "]";
		
		// Loop elements
		var i = 0;
		var me = this;
		var lastElement = null;
		var count = $$(this.options.selector).length;
		var width = this.options.width.toInt();
		var widthOdd = width;
		var height = this.options.height.toInt();
		if (this.options.half) {
			width = (width / 2).toInt();
			widthOdd = widthOdd - width; }
		$$(this.options.selector).each(function (item) {
			
			// Add item to radio list
			this.radios[i] = item;
			if (item.get('checked')) this.currentIndex = i;
			
			// If disabled, whole star rating control is disabled
			if (item.get('disabled')) this.options.disabled = true;
			
			// Hide and replace
			item.setStyle('display', 'none');
			this.stars[i] = new Element('a', {title : item.get('title')}).addClass(this.options.linksClass);
			this.stars[i].store('ratingIndex', i);
			this.stars[i].setStyles({
				'background-image': 'url("' + this.options.imageFolder + this.options.imageEmpty + '")',
				'background-repeat': 'no-repeat',
				'display': 'inline-block',
				'width': ((this.options.half && (i % 2)) ? widthOdd : width), 
				'height': height });
			if (this.options.half)
				this.stars[i].setStyle('background-position', ((i % 2) ? '-' + width + 'px 0' : '0 0'));
			this.stars[i].addEvents({
				'mouseenter': function () { me.starEnter(this.retrieve('ratingIndex')); },
				'mouseleave': function () { me.starLeave(); } });
			
			// Tip
			if (this.options.tip) {
				var title = this.options.tip;
				title = title.replace('[VALUE]', item.get('value'));
				title = title.replace('[COUNT]', count);
				if (this.options.tipTarget) this.stars[i].store('ratingTip', title);
				else this.stars[i].setProperty('title', title);
			}
			
			// Click event
			this.stars[i].addEvent('click', function () {
				if (!me.options.disabled) {
					me.setCurrentIndex(this.retrieve('ratingIndex'));
					me.fireEvent('click', me.getValue());
				}
			});
			
			// Go on
			lastElement = item;
			i++;
			
		}, this);
		
		// Inject items
		$$(this.stars).each(function (star, index) {
			star.inject(lastElement, 'after');
			lastElement = star;
		}, this);
		
		// Enable / disable
		if (this.options.disabled) this.disable(); else this.enable();
		
		// Fill stars
		this.fillStars();
		
		return this;
	},
	
	setValue: function(value) {
		this.radios.each(function (radio, index) {
			if (radio.get('value') == value) this.currentIndex = index;
		}, this);
		this.refreshRadios();
		this.fillStars();
		return this;
	},
	
	getValue: function() {
		if (!this.radios[this.currentIndex]) return null;
		return this.radios[this.currentIndex].get('value');
	},
	
	setCurrentIndex: function(index) {
		this.currentIndex = index;
		this.refreshRadios();
		this.fillStars();
		return this;
	},

	enable: function() {
		this.options.disabled = false;
		this.stars.each(function (star) { star.setStyle('cursor', 'pointer'); });
		this.refreshRadios();
		return this;
	},
	
	disable: function() {
		this.options.disabled = true;
		this.stars.each(function (star) { star.setStyle('cursor', 'default'); });
		this.refreshRadios();
		return this;
	},
	
	refresh: function() {
		this.fillStars();
		this.refreshRadios();
		return this;
	},
	
	fillStars: function (hoverIndex) {
		$$(this.stars).each(function (star, index) {
			var image = this.options.imageEmpty;
			if (hoverIndex == null) if (index <= this.currentIndex) image = this.options.imageFull;
			if (hoverIndex != null) if (index <= hoverIndex) image = this.options.imageHover;
			star.setStyle('background-image', 'url("' + this.options.imageFolder + image + '")');
		}, this);
		return this;
	},

	starEnter: function (index) {
		if (this.options.disabled) return;
		this.fillStars(index);
		if (this.options.tip && this.options.tipTarget) 
			$(this.options.tipTarget).set(this.options.tipTargetType, this.stars[index].retrieve('ratingTip'));
		this.fireEvent('mouseenter', this.radios[index].get('value'));
		return this;
	},

	starLeave: function () {
		if (this.options.disabled) return;
		this.fillStars();
		if (this.options.tip && this.options.tipTarget) 
			$(this.options.tipTarget).set(this.options.tipTargetType, '');
		this.fireEvent('mouseleave');
		return this;
	},

	setCurrentIndex: function(index) {
		this.currentIndex = index;
		this.refreshRadios();
		this.fillStars();
		return this;
	},

	refreshRadios: function () {
		this.radios.each(function (radio, index) {
			radio.set('disabled', this.options.disabled);
			radio.set('checked', index == this.currentIndex);
		}, this);
		return this;
	},
	
	debug: function() {
		radioStatus = {};
		this.radios.each(function (radio) {
			eval('radioStatus.' + radio.get('value') + ' = ' + (radio.get('checked') ? 'true' : 'false') + ';'); });
		return ({
			'Current value': this.currentIndex,
			'Hidden radios status': radioStatus
		});
	}
	
});
