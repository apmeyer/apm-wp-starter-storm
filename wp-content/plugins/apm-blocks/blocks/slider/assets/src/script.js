const APM_News_Slider = {

    init: function() {

        const sliderBlocks = document.querySelectorAll( '.apm-slider' )

        if ( sliderBlocks ) {
            sliderBlocks.forEach( block => {
                this.setupBlock( block )
            } )
        }

    },

    setupBlock: function( block ) {

        const sliderElement = block.querySelector( '.swiper' )

        // If swiper has already been set up on this element, destroy it.
        // This is for the block editor (backend) so that each time an ACF
        // field selection is updated the swiper instance is created anew.
        if ( sliderElement.swiper ) {
            sliderElement.swiper.destroy( true, true )
        }

        const paginationControls   = block.querySelector('.apm-slider .swiper-pagination')
        const mainSliderNextButton = block.querySelector('.apm-slider .swiper-button-next')
        const mainSliderPrevButton = block.querySelector('.apm-slider .swiper-button-prev')

        let swiperInstance = new Swiper( sliderElement, {
            autoplay: {
                delay: 5000
            },
            disableOnInteraction: true,
            autoHeight: false,
            loop: true,
            effect: 'fade',
            speed: 1000,
            pagination: {
                el: paginationControls,
                clickable: true
            },
            navigation: {
                nextEl: mainSliderNextButton,
                prevEl: mainSliderPrevButton
            }
        });

    }

}

// Frontend
if ( document.body && !document.body.classList.contains( 'wp-admin' ) ) {
    APM_News_Slider.init()
}

// Backend
if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=slider', () => {
        APM_News_Slider.init()
    } )
}