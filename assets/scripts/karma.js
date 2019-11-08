// Check if embedded.
if ( window.frameElement ) {
	const karmaStyle = document.getElementById( 'karma-style-css' );
	const stylesheetUrl = karmaStyle.getAttribute( 'href' ).replace( 'style.css', 'assets/styles/embedded.css' );
	const embeddedStyle = document.createElement( 'link' );
	embeddedStyle.setAttribute( 'rel', 'stylesheet' );
	embeddedStyle.setAttribute( 'href', stylesheetUrl );
	document.head.appendChild( embeddedStyle );
}

const KarmaVideo = class {
	constructor( video ) {
		this.video = video;
		this.isPlaying = false;
		this.playButton = document.getElementById( this.video.dataset.playButton );
		this.pauseButton = document.getElementById( this.video.dataset.pauseButton );

		this.prefersReducedMotion();
		this.addEventListeners();
	}

	get isPastHalf() {
		return ( ( this.video.getBoundingClientRect().height / 2 ) + this.video.getBoundingClientRect().y ) >= 0;
	}

	pauseVideo() {
		this.video.pause();
		this.isPlaying = false;
		this.playButton.setAttribute( 'aria-pressed', 'false' );
		this.pauseButton.setAttribute( 'aria-pressed', 'true' );
	}

	playVideo() {
		this.video.style.objectFit = 'none';
		this.video.play();
		this.isPlaying = true;
		this.playButton.setAttribute( 'aria-pressed', 'true' );
		this.pauseButton.setAttribute( 'aria-pressed', 'false' );
	}

	prefersReducedMotion() {
		if ( Karma.userPreferences.reducedMotion.matches ) {
			this.video.removeAttribute( 'autoplay' );
			this.pauseVideo();
		} else {
			this.video.setAttribute( 'autoplay', 'autoplay' );
			this.playVideo();
		}
	}

	addEventListeners() {
		this.playButton.addEventListener( 'click', () => {
			this.playVideo();
			this.pauseButton.focus();
		} );

		this.pauseButton.addEventListener( 'click', () => {
			this.pauseVideo();
			this.playButton.focus();
		} );

		Karma.userPreferences.reducedMotion.addListener( this.prefersReducedMotion );
	}
};

// const KarmaCarousel = class {
// 	constructor( carousel ) {
// 		this.carousel = carousel;
// 		this.track = document.getElementById( carousel.dataset.track );
// 		this.newerButton = document.getElementById( carousel.dataset.newerButton );
// 		this.olderButton = document.getElementById( carousel.dataset.olderButton );
// 		this.cards = carousel.querySelectorAll( '.card' );

// 		this.currentIndex = this.numVisible() - 1;
// 		this.maxIndex = this.cards.length - 1;

// 		this.setTrackWidth();
// 		this.addEventListeners();
// 	}

// 	numVisible() {
// 		const cardWidth = this.cards[ 0 ].getBoundingClientRect().width;
// 		const trackStyles = window.getComputedStyle( this.track );
// 		const trackPadding = window.parseInt( trackStyles.paddingLeft ) + window.parseInt( trackStyles.paddingRight );
// 		const cardSpacing = window.parseInt( trackStyles.paddingRight );

// 		let numVisible = 0;

// 		let contentWidth = cardWidth + trackPadding;

// 		while ( contentWidth < window.innerWidth ) {
// 			contentWidth += cardSpacing + cardWidth;
// 			numVisible++;
// 		}

// 		return numVisible;
// 	}

// 	setCardWidth() {
// 		if ( window.innerWidth < 7000 ) {

// 		}
// 	}

// 	setTrackWidth() {
// 		console.log('Setting track width');
// 		this.track.style.width = this.trackWidth() + 'px';
// 	}

// 	trackWidth() {
// 		let trackWidth = 0;
// 		const trackStyles = window.getComputedStyle( this.track );

// 		if ( window.innerWidth < 700 ) {
// 			const cardWidth = window.innerWidth - window.parseInt( trackStyles.paddingLeft ) - window.parseInt( trackStyles.paddingLeft );
// 			const cardSpacing = window.parseInt( trackStyles.paddingRight ) * 2;
// 			trackWidth = ( this.maxIndex * cardSpacing ) + ( ( this.maxIndex + 1 ) * cardWidth );
// 			console.log(trackWidth);
// 			return null;
// 		} else {
// 			const cardWidth = this.cards[ 0 ].getBoundingClientRect().width;
// 			const cardSpacing = window.parseInt( trackStyles.paddingRight );
// 			trackWidth = ( this.maxIndex * cardSpacing ) + ( ( this.maxIndex + 1 ) * cardWidth );
// 		}

// 		return trackWidth;
// 	}

// 	showNewer() {
// 		console.log('Showing newer', this.currentIndex);

// 		if ( this.currentIndex + 1 === this.maxIndex ) {
// 			console.log('Showing last one');
// 		}

// 		this.currentIndex++;
// 	}

// 	showOlder() {
// 		console.log('Showing older');
// 		this.currentIndex--;
// 	}

// 	showIndex( index ) {
// 		if ( index !== this.currentIndex && index >= 0 && index <= this.maxIndex ) {
// 			// Only execute if the index is valid and new.
// 			if ( index > this.currentIndex ) {
// 				while ( index !== this.currentIndex ) {
// 					this.showNewer();
// 				}
// 			} else {
// 				while ( index !== this.currentIndex ) {
// 					this.showOlder();
// 				}
// 			}
// 		}
// 	}

// 	addEventListeners() {
// 		window.addEventListener( 'resize', this.setTrackWidth );
// 	}
// };

const KarmaCarousel = class {
	constructor( carousel ) {
		this.carousel = carousel;
		this.track = document.getElementById( carousel.dataset.track );
		this.carousel.scrollTo( {
			top: 0,
			left: this.track.scrollWidth,
			behavior: 'smooth',
		} );
	}
};

const Karma = class {
	constructor() {
		this.toggleLightboxes = this.toggleLightboxes.bind( this );

		this.lightboxElements = document.querySelectorAll( '[data-lity]' );
		this.lightboxesEnabled = true;

		this.mediumBreakpoint = window.parseInt( window.getComputedStyle( document.documentElement ).getPropertyValue( '--s-medium' ) );

		this.toggleLightboxes();

		this.addEventListeners();

		this.setLetterSpacings();
		if ( document.getElementById( 'homepage-video' ) ) {
			this.homepageVideo = {
				element: document.getElementById( 'homepage-video' ),
			};
			this.homepageVideo.video = new KarmaVideo( this.homepageVideo.element );
		}
		if ( document.getElementById( 'chapters-carousel' ) ) {
			this.chaptersCarousel = {
				element: document.getElementById( 'chapters-carousel' ),
			};
			this.chaptersCarousel.carousel = new KarmaCarousel( this.chaptersCarousel.element );
		}
	}

	setLetterSpacings() {
		const textElements = document.querySelectorAll( 'p, h1, .copy' );
		for ( let i = 0; i < textElements.length; i++ ) {
			const elementStyles = window.getComputedStyle( textElements[ i ] );
			if ( elementStyles.fontFamily.split( ', ' )[ 0 ].includes( 'Inter' ) ) {
				const fontSize = window.parseInt( elementStyles.fontSize );
				textElements[ i ].style.setProperty( '--letter-spacing', Karma.letterSpacing( fontSize ) + 'em' );
			}
		}
	}

	static letterSpacing( fontSize ) {
		const a = -0.0223;
		const b = 0.185;
		const c = -0.1745;

		return a + ( b * Math.pow( Math.E, c * fontSize ) );
	}

	static get userPreferences() {
		return {
			reducedMotion: window.matchMedia( '(prefers-reduced-motion: reduce)' ),
		};
	}

	toggleLightboxes() {
		if ( window.innerWidth < this.mediumBreakpoint && this.lightboxesEnabled ) {
			for ( let i = 0; i < this.lightboxElements.length; i++ ) {
				this.lightboxElements[ i ].removeAttribute( 'data-lity' );
			}
			this.lightboxesEnabled = false;
		} else if ( window.innerWidth >= this.mediumBreakpoint && ! this.lightboxesEnabled ) {
			for ( let i = 0; i < this.lightboxElements.length; i++ ) {
				this.lightboxElements[ i ].setAttribute( 'data-lity', 'data-lity' );
			}
			this.lightboxesEnabled = true;
		}
	}

	addEventListeners() {
		window.addEventListener( 'resize', this.toggleLightboxes );
	}
};

const karma = new Karma();
karma.setLetterSpacings();
