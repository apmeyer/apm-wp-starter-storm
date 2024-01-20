const apmBlockInit = function() {

    const sliderBlocks = document.querySelectorAll( '.apm-slider' )

    if ( sliderBlocks ) {
        sliderBlocks.forEach( block => {
            apmSetupBlock( block )
        } )
    }

}

const apmSetupBlock = function( block ) {

    console.log( 'Slider setup...' );

    const slider = block.querySelector( '.swiper' )
    const mainSliderNextButton = block.querySelector('.apm-slider .swiper-button-next')
    const mainSliderPrevButton = block.querySelector('.apm-slider .swiper-button-prev')

    const mainSwiper = new Swiper( slider, {
        autoHeight: false,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: false, // this is kind of cool when there are many dots (true)
        },
        navigation: {
            nextEl: mainSliderNextButton,
            prevEl: mainSliderPrevButton
        }
    });

}

// Frontend
if ( document.body && document.body.classList.contains( 'page' ) ) {
    apmBlockInit()
}

// Backend
if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=slider', apmBlockInit )
}