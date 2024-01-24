/**
 * Inspired by the work of Heydon Pickering
 * https://inclusive-components.design/collapsible-sections/
 */
const APM_Block_Accordions = {

    speed: .25 * 1000,
    isTransitioning: false,
    allowedFirstTags: [ 'H2', 'H3', 'H4', 'H5' ],
    accordions: document.querySelectorAll('.apm-accordion-item'),

    init: function() {
        this.setupAccordions()
        this.watchForResizing()
    },

    setupAccordions: function() {

        this.accordions.forEach( accordion => {

            const heading = accordion.querySelector('.apm-accordion-item__inner-container').firstElementChild
            const contentContainer = heading.nextElementSibling

            if ( !contentContainer ) return;

            // First tag (the clickable heading) must be in the allowed tag array
            if ( !this.allowedFirstTags.includes( heading.tagName ) ) return

            // Add button within the heading
            heading.innerHTML = `<button aria-expanded="false">${heading.textContent}</button>`

            // contentContainer.hidden = true
            contentContainer.classList.add('hide-overflow')
            contentContainer.classList.add('is-hidden')

            // Get the button created above
            const button = heading.querySelector('button')

            // Add toggle behavior to button
            this.setupButtonEvents( button, contentContainer )

        } )

    },

    collapseContent: function( button, contentContainer ) {

        contentContainer.classList.add('hide-overflow')
        contentContainer.removeAttribute( 'style' )
        contentContainer.classList.add('is-leaving')
        button.setAttribute( 'aria-expanded', 'false' )

        setTimeout( () => {
            contentContainer.classList.remove('is-visible')
            contentContainer.classList.remove('is-leaving')
            button.setAttribute( 'aria-expanded', 'false' )
        }, this.speed )

    },

    expandContent: function( button, contentContainer ) {

        button.setAttribute( 'aria-expanded', 'true' )
        contentContainer.classList.add('is-visible')

        setTimeout( () => {
            contentContainer.style.height = contentContainer.scrollHeight + "px"
        }, 1 )

        setTimeout( () => {
            contentContainer.classList.remove('hide-overflow')
        }, this.speed )

    },

    setupButtonEvents: function( button, contentContainer ) {

        button.addEventListener( 'click', () => {

            if ( this.isTransitioning ) return

            this.isTransitioning = true

            if ( contentContainer.style.height ) {
                this.collapseContent( button, contentContainer )
            } else {
                this.expandContent( button, contentContainer )
            }

            setTimeout( () => {
                this.isTransitioning = false
            }, this.speed )

        } )

    },

    watchForResizing: function() {
        if ( !this.accordions ) return
        const resizeObserver = new ResizeObserver( this.onResize )
        resizeObserver.observe( document.body )
    },

    // Since animated accordion item heights require setting an inline height style,
    // we end up needing to watch the page for resizing, updating those height values
    onResize: function() {

        const accordionContentBlocks = document.querySelectorAll('.apm-accordion-item__inner-container > .wp-block-group:not(.hide-overflow)')

        if ( this.isTransitioning || !accordionContentBlocks ) return

        accordionContentBlocks.forEach( block => {
            block.style.height = block.scrollHeight + "px"
        } )

    }

}

APM_Block_Accordions.init()