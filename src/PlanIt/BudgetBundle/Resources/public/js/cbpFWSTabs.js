/**
 * cbpFWTabs.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
;( function( window ) {
	
	'use strict';

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWSTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	CBPFWSTabs.prototype.options = {
		start : 0
	};

	CBPFWSTabs.prototype._init = function() {
		// tabs elems
		this.tabs = [].slice.call( this.el.querySelectorAll( 'div > ul > li' ) );
		// content expenses
		this.expenses = [].slice.call( this.el.querySelectorAll( '.sous-content-wrap > section' ) );
		// current index
		this.current = -1;
		console.log(this.expenses);
		// show current content item
		this._show();
		// init events
		this._initEvents();

	};

	CBPFWSTabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._show( idx );
			} );
		} );
	};

	CBPFWSTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			for( var tab in this.tabs ) { 
				this.tabs[ tab ].className = this.expenses[ tab ].className = '';

			}
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.expenses.length ? this.options.start : 0;
		this.tabs[ this.current ].className = 'tab-current';
		this.expenses[ this.current ].className = 'content-current';
	};

	// add to global namespace
	window.CBPFWSTabs = CBPFWSTabs;

})( window );