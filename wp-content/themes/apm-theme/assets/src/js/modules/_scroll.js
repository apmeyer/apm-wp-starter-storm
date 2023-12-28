let scroll = window.requestAnimationFrame

const elementsToShow = document.querySelectorAll( '.animate' )
const animationActionClass = 'animated'
const compressHeaderAt = 300

const init = function() {
    if ( window.requestAnimationFrame ) {
        loop()
    } else {
        showAllAnimationElements()
    }
}


const loop = function() {
    watchForScrollToTop()
    compressOrDecompressLayout()
    watchForAnimationElements()
    scroll( loop )
};


const watchForAnimationElements = function() {
    elementsToShow.forEach( ( element ) => {
        if ( isElementInViewport( element ) ) {
            if ( element.classList.contains( animationActionClass ) ) return
            element.classList.add( animationActionClass );
        }
    });
}


const isElementInViewport = function( element ) {

    const rect = element.getBoundingClientRect()

    return (
        ( rect.top <= 0 && rect.bottom >= 0 )
        ||
        ( rect.bottom >= ( window.innerHeight || document.documentElement.clientHeight ) && rect.top <= ( window.innerHeight || document.documentElement.clientHeight ) )
        ||
        ( rect.top >= 0 && rect.bottom <= ( window.innerHeight || document.documentElement.clientHeight ) )
    );

};


const watchForScrollToTop = function() {

    if ( window.scrollY <= 0 ) {
        document.body.classList.add('is-at-top')
    } else {
        document.body.classList.remove('is-at-top')
    }

}


const compressOrDecompressLayout = function() {

    if ( window.scrollY >= compressHeaderAt ) {
        document.body.classList.add( 'is-compressed' )
    } else {
        document.body.classList.remove( 'is-compressed' )
    }

}


const showAllAnimationElements = function() {

    elementsToShow.forEach( element => { element.classList.add( animationActionClass ) } )

}


const api = {
    init: init
}

export default api;
