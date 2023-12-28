const mobileMenuButton  = document.getElementById( 'mobileMenuButton' )
const mobileMenuWrap    = document.getElementById( 'mobileMenuWrap' )
const siteNav           = document.getElementById( 'siteNav' )
const menuItems         = document.querySelectorAll( '.main-menu li.menu-item-has-children' )
const breakpoint        = 950
const devMode           = true
let isTransitioning     = false


const init = function() {

    if ( mobileMenuButton && mobileMenuWrap ) {
        addMobileSubmenuButtons()
        addEventListeners()
    }

    const headerResizeObserver = new ResizeObserver( onHeaderResize )
    headerResizeObserver.observe( document.querySelector( '.site-header-wrap' ) );

}


const onHeaderResize = function() {

    const subMenus = document.querySelectorAll('.sub-menu')

    if ( window.innerWidth >= breakpoint ) {
        subMenus.forEach( submenu => {
            submenu.removeAttribute('style')
        } )
    } else {
        subMenus.forEach( submenu => {
            submenu.style.maxHeight = submenu.scrollHeight + "px"
        } )
    }

}


const displayMobileMenu = function() {
    mobileMenuWrap.classList.add('is-block')
    mobileMenuButton.setAttribute( 'aria-expanded', 'true' )
    setTimeout( () => {
        mobileMenuWrap.classList.add('transition-in')
    }, 5 )
}


const hideMobileMenu = function() {
    mobileMenuWrap.classList.remove('transition-in')
    mobileMenuButton.setAttribute( 'aria-expanded', 'false' )
    setTimeout( () => {
        mobileMenuWrap.classList.remove('is-block')
    }, 250 )
}


const addMobileSubmenuButtons = function() {

    menuItems.forEach( item => {

        const menuItemId = item.getAttribute( 'id' )
        const a = item.querySelector( 'a' )
        const subMenu = item.querySelector( '.sub-menu' )
        const subMenuId = menuItemId + '_submenu';

        a.setAttribute( 'aria-expanded', 'false' )
        subMenu.setAttribute( 'id', subMenuId )

        const button = document.createElement('button')
        button.setAttribute( 'aria-controls', subMenuId );
        button.setAttribute( 'aria-expanded', 'false' )
        button.setAttribute( 'class', 'mobile-submenu-button' )

        a.after( button )

    } )

}


const hideAllSubmenusOnDesktop = function() {
    if ( window.innerWidth >= breakpoint ) {
        menuItems.forEach( item => {
            item.classList.remove( 'is-ready-to-transition' )
            item.querySelector( 'a' ).setAttribute( 'aria-expanded', 'false' )
        } )
    }
}


const showDesktopSubmenu = function( item, timer ) {
    if ( window.innerWidth >= breakpoint ) {

        clearTimeout( timer )
        hideAllSubmenusOnDesktop()

        // item.classList.add( 'is-ready-to-transition' )
        item.querySelector( 'a' ).setAttribute( 'aria-expanded', 'true' )

    }
}


const hideDesktopSubmenu = function( item ) {

    // item.classList.remove( 'is-ready-to-transition' )
    item.querySelector( 'a' ).setAttribute( 'aria-expanded', 'false' )

}


const addEventListeners = function() {

    if ( !mobileMenuButton || !menuItems ) return

    const exitActions = [ 'mouseout', 'focusout' ]

    // Toggle the menu on button click
    mobileMenuButton.addEventListener( 'click', ( event ) => {

        event.preventDefault()

        if ( isTransitioning ) return

        if ( mobileMenuButton.getAttribute('aria-expanded') === 'true' ) {
            hideMobileMenu()
        } else {
            displayMobileMenu()
        }

        isTransitioning = false

    })

    // If user hits the escape key, close the menu
    document.addEventListener( 'keydown', ( event ) => {
        if ( event.key === 'Escape' ) {
            hideMobileMenu()
        }
    } )

    // If focus leaves the menu, close the menu
    if ( !devMode && siteNav ) {
        siteNav.addEventListener( 'focusout', ( event ) => {
            if ( !siteNav.contains( event.relatedTarget ) ) {
                hideMobileMenu()
            }
        } )
    }

    // Setup desktop submenu behavior for hover and focus
    menuItems.forEach( item => {

        let timer = null
        const a = item.querySelector( 'a' )

        // On wide screens, show submenu on hover
        item.addEventListener( 'mouseover', event => {
            if ( item.contains( event.relatedTarget ) ) return
            showDesktopSubmenu( item, timer )
        } )

        // On wide screens, show submenu on focus
        a.addEventListener( 'focus', () => {
            showDesktopSubmenu( item, timer )
        } )

        // On wide screens, hide menu on mouse out and focus out
        exitActions.forEach( action => {
            item.addEventListener( action, event => {

                if ( item.contains( event.relatedTarget ) ) return

                if ( window.innerWidth >= breakpoint ) {
                    timer = setTimeout( () => {
                        hideDesktopSubmenu( item )
                    }, 500 )
                }

            } )
        } )

    } )

    const mobileSubmenuButtons = document.querySelectorAll( '.mobile-submenu-button' )

    // Setup mobile submenu expanding
    if ( mobileSubmenuButtons ) {
        mobileSubmenuButtons.forEach( button => {

            const menuId = button.getAttribute( 'aria-controls' )
            const menu = document.getElementById( menuId )

            button.addEventListener( 'click', event => {

                event.preventDefault()

                if ( isTransitioning ) return

                isTransitioning = true

                if ( button.getAttribute('aria-expanded') === 'false' ) {
                    button.setAttribute( 'aria-expanded', 'true' )
                    button.previousSibling.setAttribute( 'aria-expanded', 'true' )
                    menu.style.display = 'block'
                    setTimeout( () => {
                        menu.style.maxHeight = menu.scrollHeight + "px"
                    }, 5 )
                } else {
                    button.setAttribute( 'aria-expanded', 'false' )
                    button.previousSibling.setAttribute( 'aria-expanded', 'false' )
                    menu.style.maxHeight = 0 + "px"
                    setTimeout( () => {
                        menu.removeAttribute( 'style' )
                    }, 250 )
                }

                setTimeout( () => {
                    isTransitioning = false
                }, 250)

            } )
        } )
    }

}


const api = {
    init: init
}

export default api;