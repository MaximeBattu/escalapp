!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=40)}({40:function(e,t,n){e.exports=n(41)},41:function(e,t){setTimeout((function(){$("#adminAccessError").fadeOut(),$("#addSuccessRoom").fadeOut(),$("#administratorRight").fadeOut(),$("#profileModification").fadeOut()}),4e3),document.addEventListener("DOMContentLoaded",(function(){var e=document.querySelector("body"),t=document.querySelectorAll(".imgVoie");console.log(t);var n=function(e,t,n){var o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,r=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null,l=document.createElement(e);null!=t&&l.appendChild(document.createTextNode(t));null!=o&&l.classList.add(o);null!=r&&(l.id=r);return n.appendChild(l),l}("div",null,e),o=!0,r=!1,l=void 0;try{for(var i,u=function(){var e=i.value;e.addEventListener("click",(function(){n.classList.toggle("imgOnPage"),e.classList.toggle("imgOnMiddleScreen")})),n.addEventListener("click",(function(){n.classList.remove("imgOnPage"),e.classList.remove("imgOnMiddleScreen")}))},c=t[Symbol.iterator]();!(o=(i=c.next()).done);o=!0)u()}catch(e){r=!0,l=e}finally{try{o||null==c.return||c.return()}finally{if(r)throw l}}var d=document.querySelector("#contest"),a=document.querySelector("#close"),s=document.querySelector("#open");a.addEventListener("click",(function(){d.style.display="none",s.style.display="block"})),s.addEventListener("click",(function(){d.style.display="block",s.style.display="none"}))}))}});