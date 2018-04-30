/*!
* progressively 1.0.0
* https://github.com/thinker3197/progressively
* @license MIT licensed
*
* Copyright (C) 2016 Ashish
*/

;
(function(root, factory) {
	if (typeof define === 'function' && define.amd) {
		define(function() {
			return factory(root);
		});
	} else if (typeof exports === 'object') {
		module.exports = factory;
	} else {
		root.progressively = factory(root);
	}
})(this, function(root) {

	'use strict';

	var progressively = {};

	var defaults, poll, onLoad;

	onLoad = function() {};

	function extend(primaryObject, secondaryObject) {
		var o = {};
		for (var prop in primaryObject) {
			o[prop] = secondaryObject.hasOwnProperty(prop) ? secondaryObject[prop] : primaryObject[prop];
		}
		return o;
	};

	function isHidden(el) {
		return (el.offsetParent === null);
	};

	function is_high_resolution_screen() {
		return window.devicePixelRatio > 1;
	}

	function loadImage(el) {
		setTimeout(function() {
			var img = new Image();

			img.onload = function() {
				el.classList.remove('progressive--not-loaded');
				el.classList.add('progressive--is-loaded');
				el.src = this.src;

				onLoad(el);
			};

			if ( ! is_high_resolution_screen() ) {

				img.src = el.getAttribute("data-progressive");

			} else {

				if ( el.hasAttribute("data-rjs") ) {

					img.src = el.getAttribute("data-rjs");

				} else {

					img.src = el.getAttribute("data-progressive");

				}

			}


		}, defaults.delay);
	};

	function listen() {
		if (!!poll)
		return;
		clearTimeout(poll);
		poll = setTimeout(function() {
			progressively.render();
			poll = null;
		}, defaults.throttle);
	}
	/*
	* default settings
	*/

	defaults = {
		throttle: 300, //appropriate value, don't change unless intended
		delay: 100,
		offset: 300,
		onLoad: function() {}
	};

	progressively.init = function(options) {
		options = options || {};

		defaults = extend(defaults, options);

		onLoad = defaults.onLoad || onLoad;

		progressively.render();

		if (document.addEventListener) {
			root.addEventListener('load', listen, false);
		} else {
			root.attachEvent('onload', listen);
		}
	};

	progressively.render = function() {

		var elements = document.querySelectorAll('.progressive__img');
		var elementsArray = [];

		for(var index=0;index<elements.length;index++) {
			elementsArray.push(elements[index]);
		}

		var observer = new IntersectionObserver(function(enteries) {

			enteries.forEach(function(entery) {

				var enteryIntersected = false;

				if ( entery.isIntersecting && ! enteryIntersected ) {

					enteryIntersected = true;

					if ( entery.target.classList.contains('progressive--not-loaded') ) {

						loadImage(entery.target);

					}

				}

			});

		}, { threshould: 0.1, rootMargin: defaults.offset + 'px' });

		elementsArray.forEach(function(element, i) {
			observer.observe(element);
		});

	};

	progressively.drop = function() {
		clearTimeout(poll);
	};

	return progressively;
});
