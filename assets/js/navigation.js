/**
 * Mobile menu, search panel, "back to top" button and share links on posts.
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

		var shareLinks = document.getElementById( 'share-links' );

		// Mastodon has no single share URL: every user is on their own
		// instance. Ask once, then remember the instance for next time.
		var shareMastodon = document.getElementById( 'share-mastodon' );
		if ( shareMastodon && shareLinks ) {
			shareMastodon.addEventListener( 'click', function () {
				var stored = null;
				try {
					stored = window.localStorage.getItem( 'techdevblog-mastodon-instance' );
				} catch ( e ) {}

				var instance = stored || window.prompt( 'Sur quelle instance Mastodon es-tu ? (ex. mastodon.social)' );
				if ( ! instance ) {
					return;
				}
				instance = instance.replace( /^https?:\/\//, '' ).replace( /\/.*$/, '' ).trim();
				if ( ! instance ) {
					return;
				}

				try {
					window.localStorage.setItem( 'techdevblog-mastodon-instance', instance );
				} catch ( e ) {}

				var text = shareLinks.dataset.title + ' ' + shareLinks.dataset.url;
				window.open( 'https://' + instance + '/share?text=' + encodeURIComponent( text ), '_blank', 'noopener' );
			} );
		}

		var shareCopy = document.getElementById( 'share-copy' );
		var shareCopyLabel = document.getElementById( 'share-copy-label' );
		if ( shareCopy && shareCopyLabel && shareLinks && navigator.clipboard ) {
			var shareCopyDefaultText = shareCopyLabel.textContent;
			shareCopy.addEventListener( 'click', function () {
				navigator.clipboard.writeText( shareLinks.dataset.url ).then( function () {
					shareCopyLabel.textContent = 'Copié !';
					window.setTimeout( function () {
						shareCopyLabel.textContent = shareCopyDefaultText;
					}, 2000 );
				} );
			} );
		}
	} );
} )();
