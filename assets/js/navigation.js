/**
 * Mobile menu, search panel, "back to top" button and share links on posts.
 */
( function () {
	'use strict';

	var MASTODON_STORAGE_KEY = 'techdevblog-mastodon-instance';
	var COPY_FEEDBACK_MS = 2000;
	// Bare host name: labels of letters/digits/hyphens, at least one dot.
	var HOSTNAME_PATTERN = /^[a-z0-9](?:[a-z0-9-]*[a-z0-9])?(?:\.[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)+$/;

	/**
	 * Turn whatever the reader typed into a bare Mastodon host name.
	 *
	 * Accepts "mastodon.social", "https://mastodon.social/home" or a full
	 * handle like "@me@mastodon.social".
	 *
	 * @param {?string} raw Reader input or previously stored value.
	 * @return {string} Lowercase host name, or '' if it is not a valid one.
	 */
	function normalizeMastodonInstance( raw ) {
		if ( ! raw ) {
			return '';
		}
		var instance = String( raw ).trim().toLowerCase()
			.replace( /^https?:\/\//, '' )
			.replace( /[\/?#].*$/, '' );
		// A handle ("@user@host" or "user@host"): the host is after the last "@".
		instance = instance.slice( instance.lastIndexOf( '@' ) + 1 );
		return HOSTNAME_PATTERN.test( instance ) ? instance : '';
	}

	function readStoredMastodonInstance() {
		try {
			return window.localStorage.getItem( MASTODON_STORAGE_KEY );
		} catch ( e ) {
			// Storage blocked (private mode, browser settings): behave as if nothing was saved.
			return null;
		}
	}

	function storeMastodonInstance( instance ) {
		try {
			window.localStorage.setItem( MASTODON_STORAGE_KEY, instance );
		} catch ( e ) {
			// Storage blocked: the reader will simply be asked again next time.
		}
	}

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
		// instance. Always ask, pre-filled with the last instance used, so a
		// single "OK" confirms it and a typo can still be fixed (no hidden
		// shortcut, which touch screens could not use anyway).
		var shareMastodon = document.getElementById( 'share-mastodon' );
		if ( shareMastodon && shareLinks ) {
			shareMastodon.addEventListener( 'click', function () {
				// An invalid saved value (e.g. from an older version) normalizes to '' and is not offered.
				var storedInstance = normalizeMastodonInstance( readStoredMastodonInstance() );
				var answer = window.prompt(
					'Sur quelle instance Mastodon êtes-vous ? (ex. mastodon.social)',
					storedInstance
				);
				if ( answer === null || answer.trim() === '' ) {
					return;
				}
				var instance = normalizeMastodonInstance( answer );
				if ( ! instance ) {
					window.alert( 'Adresse d’instance invalide. Indiquez par exemple « mastodon.social ».' );
					return;
				}
				storeMastodonInstance( instance );

				var text = shareLinks.dataset.title + ' ' + shareLinks.dataset.url;
				window.open( 'https://' + instance + '/share?text=' + encodeURIComponent( text ), '_blank', 'noopener' );
			} );
		}

		var shareCopy = document.getElementById( 'share-copy' );
		var shareCopyLabel = document.getElementById( 'share-copy-label' );
		if ( shareCopy && ! ( navigator.clipboard && navigator.clipboard.writeText ) ) {
			// Clipboard API missing (old browser, or page not served over HTTPS):
			// remove the button rather than leave one that does nothing.
			shareCopy.parentNode.removeChild( shareCopy );
		} else if ( shareCopy && shareCopyLabel && shareLinks ) {
			var shareCopyDefaultText = shareCopyLabel.textContent;
			var shareCopyResetTimer = null;
			var showCopyFeedback = function ( message ) {
				shareCopyLabel.textContent = message;
				window.clearTimeout( shareCopyResetTimer );
				shareCopyResetTimer = window.setTimeout( function () {
					shareCopyLabel.textContent = shareCopyDefaultText;
				}, COPY_FEEDBACK_MS );
			};
			shareCopy.addEventListener( 'click', function () {
				navigator.clipboard.writeText( shareLinks.dataset.url ).then( function () {
					showCopyFeedback( 'Copié !' );
				}, function () {
					// Denied permission or unfocused document.
					showCopyFeedback( 'Copie impossible' );
				} );
			} );
		}
	} );
} )();
