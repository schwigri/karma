const banner = document.getElementById( 'banner' );
if ( banner ) {
	const headerInner = document.querySelector( '.header-inner' );
	let bannerFixed = false;
	let bannerHeight = banner.offsetHeight;
	let bannerPosition = headerInner.offsetHeight;
	document.documentElement.style.setProperty( '--banner-height', '0' );

	const getCookieValue = ( name ) => {
		let b = document.cookie.match( '(^|[^;]+)\\s*' + name + '\\s*=\\s*([^;]+)' );
		return b ? b.pop() : '';
	};

	if ( getCookieValue( 'closedBanner' ) === 'true' ) {
		banner.style.display = 'none';
	} else {
		const updateBannerHeight = () => {
			bannerHeight = banner.offsetHeight;
			bannerPosition = headerInner.offsetHeight;
		};

		window.addEventListener( 'resize', updateBannerHeight );

		const header = document.getElementById( 'site-header' );
		const homepageMedia = document.querySelector( '.homepage-media' );
		if ( homepageMedia ) {
			homepageMedia.style.setProperty( 'margin-top', 'var(--banner-height)' );
		} else {
			header.style.setProperty( 'padding-bottom', 'var(--banner-height)' );
		}

		const adjustBannerPosition = () => {
			if ( window.scrollY > bannerPosition && ! bannerFixed ) {
				banner.style.position = 'fixed';
				document.documentElement.style.setProperty( '--banner-height', bannerHeight + 'px' );
				bannerFixed = true;
			} else if ( window.scrollY <= bannerPosition && bannerFixed ) {
				banner.style.position = 'relative';
				document.documentElement.style.setProperty( '--banner-height', '0' );
				bannerFixed = false;
			}
		};
		let oldY = 0;
		let checkFunction = window.setInterval( () => {
			if ( window.scrollY !== oldY ) {
				window.requestAnimationFrame( adjustBannerPosition );
				oldY = window.scrollY;
			}
		}, 10 );

		const closeBanner = () => {
			banner.style.opacity = 0;
			window.setTimeout( () => {
				banner.style.display = 'none';
			}, 300 );
			if ( bannerFixed ) {
				if ( homepageMedia ) {
					homepageMedia.classList.add( 'closing-banner' );
				} else {
					header.classList.add( 'closing-banner' );
				}
				document.documentElement.style.setProperty( '--banner-height', '0' );
			} else {
				window.setTimeout( () => {
					document.documentElement.style.setProperty( '--banner-height', bannerHeight + 'px' );
				}, 300 );
				window.setTimeout( () => {
					if ( homepageMedia ) {
						homepageMedia.classList.add( 'closing-banner' );
					} else {
						header.classList.add( 'closing-banner' );
					}
					document.documentElement.style.setProperty( '--banner-height', '0');
				}, 305 );
			}

			if ( getCookieValue( 'closedBanner' ) !== 'true' ) {
				document.cookie = 'closedBanner=true; path=/';
			}

			window.clearInterval( checkFunction );
		};

		const closeButton = document.getElementById( 'close-banner-button' );
		closeButton.addEventListener( 'click', closeBanner );
	}
}
