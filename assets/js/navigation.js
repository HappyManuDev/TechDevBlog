/**
 * Menu mobile, panneau de recherche et bouton "haut de page" des articles.
 */
( function () {
	'use strict';

	function toggle( btn, panel, onToggle ) {
		if ( ! btn || ! panel ) {
			return;
		}
		btn.addEventListener( 'click', function () {
			var open = panel.classList.toggle( 'hidden' ) === false;
			btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			if ( onToggle ) {
				onToggle( open );
			}
		} );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		var iconMenu = document.getElementById( 'icon-menu' );
		var iconClose = document.getElementById( 'icon-close' );

		toggle(
			document.getElementById( 'mobile-menu-btn' ),
			document.getElementById( 'mobile-menu' ),
			function ( open ) {
				if ( iconMenu ) {
					iconMenu.classList.toggle( 'hidden', open );
				}
				if ( iconClose ) {
					iconClose.classList.toggle( 'hidden', ! open );
				}
			}
		);

		toggle(
			document.getElementById( 'search-toggle' ),
			document.getElementById( 'search-panel' ),
			function ( open ) {
				if ( open ) {
					var field = document.querySelector( '#search-panel .search-field' );
					if ( field ) {
						field.focus();
					}
				}
			}
		);

		var backToTop = document.getElementById( 'back-to-top' );
		if ( backToTop ) {
			var updateVisibility = function () {
				backToTop.classList.toggle( 'is-visible', window.scrollY > 600 );
			};
			updateVisibility();
			window.addEventListener( 'scroll', updateVisibility, { passive: true } );

			backToTop.addEventListener( 'click', function () {
				var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
				window.scrollTo( { top: 0, behavior: reduceMotion ? 'auto' : 'smooth' } );
			} );
		}
	} );
} )();
