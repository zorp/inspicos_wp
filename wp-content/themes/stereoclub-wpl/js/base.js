jQuery(document).ready(function(){
	"use strict";

	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'light_square',
	});

	/* Mobile Menu */
	jQuery(document).ready(function () {
		jQuery('nav.site-navigation').meanmenu();
	});

	/* Toggle for Search form */
	jQuery(".share-item-icon-search a").click(function () {
		jQuery(".header-search-form").toggle();
	});

	/* Toggle for Social Buttons */
	jQuery(".share-bt .share-click").click(function () {
		jQuery(".share-buttons").toggle();
	});

	jQuery(".share-bt .share-click").click(function () {
		jQuery(".share-bt").toggleClass( "square" );
	});

	/* FitVids */
	jQuery(".fitvid, iframe").fitVids();


	// Can also be used with jQuery(document).ready()
	jQuery(window).load(function() {
		jQuery('#slider-status').flexslider({
			animation: "fade",
			controlNav: false,
		});
	});

	/* Setting the equal height width  */
	jQuery('.entry-content-list .list-block-item').equalHeights(100,400);
	jQuery('.WPlookevents .list-block-item').equalHeights(100,400);
	jQuery('.WPlooklatestposts .list-block-item').equalHeights(100,400);

	/* Gallery Flex SLider */

	jQuery(window).load(function() {
		// The slider being synced must be initialized first
		jQuery('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 80,
			itemMargin: 5,
			asNavFor: '#slider',
			start: function(slider) {
				jQuery( '.flexslider' ).removeClass('loading');
			}
		});

		jQuery('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			sync: "#carousel"
		});
	});

		/* Tabs */
	jQuery('.panes div').hide();
	jQuery(".tabs a:first").addClass("selected");
	jQuery(".tabs_table").each(function(){
			jQuery(this).find('.panes div:first').show();
			jQuery(this).find('a:first').addClass("selected");
	});
	jQuery('.tabs a').click(function(){
			var which = jQuery(this).attr("rel");
			jQuery(this).parents(".tabs_table").find(".selected").removeClass("selected");
			jQuery(this).addClass("selected");
			jQuery(this).parents(".tabs_table").find(".panes").find("div").hide();
			jQuery(this).parents(".tabs_table").find(".panes").find("#"+which).fadeIn(800);
	});

	/* Toggle */
	jQuery(".toggle-content .expand-button").click(function() {
		jQuery(this).toggleClass('close').parent('div').find('.expand').slideToggle(250);
	});

	/* Toggle */
	jQuery(".toggle-event .expand-button").click(function() {
		jQuery(this).toggleClass('close').parent('div').find('.expand').slideToggle(250);
	});


});

jQuery(function() {
	// Setup the player to autoplay the next track
	var a = audiojs.createAll({
		trackEnded: function() {
			var next = jQuery('ol li.playing').next();
			if (!next.length) next = jQuery('ol.album li').first();
			jQuery('ol li').removeClass('playing');
			next.addClass('playing');//.siblings().removeClass('playing');
			audio.load(jQuery('a', next).attr('data-src'));
			audio.play();
		}
	});

	// Load in the first track
	var audio = a[0];
	first = jQuery('ol a').attr('data-src');
	jQuery('ol').first().addClass('album');
	jQuery('ol li').first().addClass('playing');

	elem = jQuery(".audiojs");
	if (elem.hasClass ("playing")) {
		audio.load(first);
	}	

	// Load in a track on click
	jQuery('ol li').click(function(e) {
		e.preventDefault();
		jQuery('ol').removeClass('album');
		jQuery(this).parent().addClass('album');
		jQuery('ol li').removeClass('playing');
		jQuery(this).addClass('playing');//.siblings().removeClass('playing');
		audio.load(jQuery('a', this).attr('data-src'));
		audio.play();
	});

	// Keyboard shortcuts
	jQuery(document).keydown(function(e) {
		var unicode = e.charCode ? e.charCode : e.keyCode;
		// right arrow
		if (unicode == 39) {
			var next = jQuery('li.playing').next();
			if (!next.length) next = jQuery('ol.album li').first();
			next.click();
		// back arrow
		} else if (unicode == 37) {
			var prev = jQuery('li.playing').prev();
			if (!prev.length) prev = jQuery('ol.album li').last();
			prev.click();
		// spacebar
		} else if (unicode == 32) {
			audio.playPause();
		}
	});

	jQuery(a).each(function (key, value) {

		var as = a[key],
			audio_player = jQuery('.audiojs').get(key);
			play_btn = jQuery(audio_player).find('.play-pause'),
			list = jQuery(audio_player).next(),
			list_li = jQuery(list).find('li'),
			first = jQuery(list).find('li a').attr('data-src');

		jQuery(list_li).first().addClass('playing');

		as.load(first);

		// Make sure everything paues     
		jQuery(list_li).click(function (e) {
			e.preventDefault();
			jQuery(this).addClass('playing').siblings().removeClass('playing');
			var thisIndex = jQuery(audio_player).index('.audiojs');

			jQuery.each(a, function (index, val) {
				if (index !== thisIndex && a[index].playing) a[index].pause();
			});

			as.load(jQuery('a', this).attr('data-src'));
			as.play();
		});

		// Make sure everything paues again
		jQuery(play_btn).click(function () {
			var thisIndex = jQuery(this).parents('.audiojs').index('.audiojs');

			jQuery.each(a, function (index, val) {
				if (index != thisIndex && a[index].playing) a[index].pause();
			});

		});

		// trackEnded needs new var so it doesnt loop multiple players
		as.trackEnded = function () {
			var thisIndex = jQuery(audio_player).index('.audiojs');
			current = jQuery('.audiojs').get(thisIndex), audio_list = jQuery(current).next(), playing = jQuery(audio_list).find('li.playing');
			next = jQuery(playing).next();

			if (!next.length) next = jQuery(audio_list).children().first();
			next.addClass('playing').siblings().removeClass('playing');
			as.load(jQuery('a', next).attr('data-src'));
			as.play();
		}
	});

});


// Share buttons
function twwindows(object) {
	window.open( object, "twshare", "height=400,width=550,resizable=1,toolbar=0,menubar=0,status=0,location=0" ) 
}

function fbwindows(object) {
	window.open( object, "fbshare", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
}

function pinwindows(object) {
	window.open( object, "pinshare", "height=270,width=630,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
}