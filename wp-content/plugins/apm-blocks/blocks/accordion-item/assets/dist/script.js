!function(){"use strict";({speed:250,isTransitioning:!1,allowedFirstTags:["H2","H3","H4","H5"],accordions:document.querySelectorAll(".apm-accordion-item"),init:function(){this.setupAccordions(),this.watchForResizing()},setupAccordions:function(){this.accordions.forEach((e=>{const t=e.querySelector(".apm-accordion-item__inner-container").firstElementChild,i=t.nextElementSibling;if(!i)return;if(!this.allowedFirstTags.includes(t.tagName))return;t.innerHTML='<button aria-expanded="false">'.concat(t.textContent,"</button>"),i.classList.add("hide-overflow"),i.classList.add("is-hidden");const s=t.querySelector("button");this.setupButtonEvents(s,i)}))},collapseContent:function(e,t){t.classList.add("hide-overflow"),t.removeAttribute("style"),t.classList.add("is-leaving"),e.setAttribute("aria-expanded","false"),setTimeout((()=>{t.classList.add("is-hidden"),t.classList.remove("is-visible"),t.classList.remove("is-leaving"),e.setAttribute("aria-expanded","false")}),this.speed)},expandContent:function(e,t){t.classList.remove("is-hidden"),e.setAttribute("aria-expanded","true"),t.style.maxHeight=t.scrollHeight+"px",setTimeout((()=>{t.classList.add("is-visible")}),1),setTimeout((()=>{t.classList.remove("hide-overflow")}),this.speed)},setupButtonEvents:function(e,t){e.addEventListener("click",(()=>{this.isTransitioning||(this.isTransitioning=!0,t.style.maxHeight?this.collapseContent(e,t):this.expandContent(e,t),setTimeout((()=>{this.isTransitioning=!1}),this.speed))}))},watchForResizing:function(){if(!this.accordions)return;new ResizeObserver(this.onResize).observe(document.body)},onResize:function(){const e=document.querySelectorAll(".apm-accordion-item__inner-container > .wp-block-group:not(.hide-overflow)");!this.isTransitioning&&e&&e.forEach((e=>{e.style.maxHeight=e.scrollHeight+"px"}))}}).init()}();