const APM_Slider = {

    init: function() {

        const sliderBlocks = document.querySelectorAll( '.apm-slider' )

        if ( sliderBlocks ) {
            sliderBlocks.forEach( block => {
                this.setupBlock( block )
            } )
        }

    },

    setupBlock: function( block ) {

        const slider = block.querySelector( '.swiper' )
        const paginationControls   = block.querySelector('.apm-slider .swiper-pagination')
        const mainSliderNextButton = block.querySelector('.apm-slider .swiper-button-next')
        const mainSliderPrevButton = block.querySelector('.apm-slider .swiper-button-prev')

        const theSlider = new Swiper( slider, {
            autoHeight: false,
            loop: true,
            pagination: {
                el: paginationControls,
                dynamicBullets: false // this is kind of cool when there are many dots (true)
            },
            navigation: {
                nextEl: mainSliderNextButton,
                prevEl: mainSliderPrevButton
            }
        });

    }

}

function apmBlocksSetupSliders() {
    APM_Slider.init()
}

// Frontend
if ( document.body && document.body.classList.contains( 'page' ) ) {
    APM_Slider.init()
}

// Backend
if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=slider', apmBlocksSetupSliders )
}