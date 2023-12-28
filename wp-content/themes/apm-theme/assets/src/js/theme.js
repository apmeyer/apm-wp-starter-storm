import { default as scroll } from "./modules/_scroll"
import { default as siteHeader } from "./modules/_site-header"

(() => {

    siteHeader.init()
    scroll.init()

})();