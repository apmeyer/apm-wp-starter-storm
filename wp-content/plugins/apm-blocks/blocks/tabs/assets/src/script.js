/**
 * Accessibility features inspired by the work of Heydon Pickering
 * https://inclusive-components.design/tabbed-interfaces/
 */
const APM_Tabs = {

    init: function() {
        const blocks = document.querySelectorAll( '.apm-tabs' )
        if ( blocks ) this.setupTabSets( blocks )
    },

    setupTabSets: function( blocks ) {

        blocks.forEach( ( block ) => {
            this.setupTabSet( block )
        } )

    },

    setupTabSet: function( block ) {

        const tabList = block.querySelector( '.apm-tab-list' )
        const tabs = tabList.querySelectorAll( 'a' )
        const panels = block.querySelectorAll( '.apm-tab-panel' )

        tabs.forEach( thisTab => {
            thisTab.setAttribute( 'role', 'tab' )
            thisTab.setAttribute( 'tabindex', '-1' )
            this.addMouseEvents( thisTab, tabList, tabs, panels )
            this.addKeyboardEvents( thisTab, tabList, tabs, panels )
        })

        panels.forEach( panel => {
            panel.setAttribute( 'role', 'tabpanel' )
            panel.setAttribute( 'tabindex', '-1' )
            panel.hidden = true
        })

        // Setup initial tab and corresponding panel
        tabs[0].removeAttribute( 'tabindex' )
        tabs[0].setAttribute( 'aria-selected', 'true' )
        panels[0].hidden = false

    },

    addMouseEvents: function( thisTab, tabList, tabs, panels ) {

        thisTab.addEventListener( 'click', event => {
            event.preventDefault()
            const currentTab = tabList.querySelector( '[aria-selected]' )
            if ( event.currentTarget !== currentTab ) {
                this.switchTab( currentTab, event.currentTarget, tabs, panels )
            }
        })

    },

    addKeyboardEvents: function( thisTab, tabList, tabs, panels ) {

        thisTab.addEventListener( 'keydown', event => {

            // Get the index of the current tab in the tabs node list
            const index = Array.prototype.indexOf.call( tabs, event.currentTarget )

            // Determine key pressed and calculate the new tab index
            // 37 -> left | 39 -> right | 40 -> down
            const dir = event.which === 37 ? index - 1 : event.which === 39 ? index + 1 : event.which === 40 ? 'down' : null

            // Down moves to the current panel, otherwise left/right moves through the tabs
            if ( dir !== null ) {
                event.preventDefault()
                dir === 'down' ? panels[index].focus() : tabs[dir] ? this.switchTab( event.currentTarget, tabs[dir], tabs, panels ) : void 0;
            }

        });

    },

    switchTab: function( oldTab, newTab, tabListItems, panels ) {

        newTab.focus();
        newTab.removeAttribute( 'tabindex' )
        newTab.setAttribute( 'aria-selected', 'true' )
        oldTab.removeAttribute( 'aria-selected' )
        oldTab.setAttribute( 'tabindex', '-1' )

        const index = Array.prototype.indexOf.call( tabListItems, newTab )
        const oldIndex = Array.prototype.indexOf.call( tabListItems, oldTab )

        panels[oldIndex].hidden = true
        panels[index].hidden = false

    }

}

// Frontend
if ( document.body && !document.body.classList.contains( 'wp-admin' ) ) {
    APM_Tabs.init()
}

// Backend
if ( window.acf ) {
    window.acf.addAction( 'render_block_preview/type=tabs', () => {
        APM_Tabs.init()
    } )
}