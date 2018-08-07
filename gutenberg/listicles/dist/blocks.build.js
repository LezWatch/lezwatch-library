!function(e){function t(n){if(r[n])return r[n].exports;var i=r[n]={i:n,l:!1,exports:{}};return e[n].call(i.exports,i,i.exports,t),i.l=!0,i.exports}var r={};t.m=e,t.c=r,t.d=function(e,r,n){t.o(e,r)||Object.defineProperty(e,r,{configurable:!1,enumerable:!0,get:n})},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=1)}([function(e,t,r){var n=r(16),i=n.Symbol;e.exports=i},function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=(r(2),r(24)),i=(r.n(n),r(25)),l=(r.n(i),r(26));r.n(l)},function(e,t,r){"use strict";var n=r(3),i=(r.n(n),r(4)),l=r.n(i),o=r(6),a=r.n(o),c=r(22),u=(r.n(c),r(23)),s=(r.n(u),wp.i18n.__),f=wp.element.Fragment,p=wp.blocks,m=(p.createBlock,p.registerBlockType),v=wp.editor,d=v.InnerBlocks,y=v.InspectorControls,b=wp.components,w=b.PanelBody,h=b.ToggleControl,g=b.RangeControl,x=l()(function(e){return a()(e,function(){return["lez-library/listitem"]})});m("lez-library/listicles",{title:s("Listicle","lezwatch-library"),icon:"excerpt-view",category:"layout",attributes:{items:{type:"number",default:2},reversed:{type:"boolean",default:!1}},description:s("A block for listicles. Adjust the number with the slider, and flip it reversible if you so desire. Lists only can go up to 18 for managability.","lezwatch-library"),edit:function(e){var t=(e.attributes.placeholder,e.className),r=e.setAttributes,n=e.attributes,i=n.items,l=n.reversed,o="",a="0";return l&&(o="reversed",a=parseInt(""+i)+1),wp.element.createElement(f,null,wp.element.createElement(y,null,wp.element.createElement(w,{title:s("Listicle Settings","lezwatch-library")},wp.element.createElement(g,{label:s("Items","lezwatch-library"),value:i,onChange:function(e){return r({items:e})},min:1,max:18}),wp.element.createElement(h,{label:s("Reversed","lezwatch-library"),help:function(e){return e?s("Reversed order (10 - 1 )","lezwatch-library"):s("Numerical order (1-10)","lezwatch-library")},checked:e.attributes.reversed,onChange:function(){return e.setAttributes({reversed:!e.attributes.reversed})}}))),wp.element.createElement("dl",{className:t+" "+o+" listicle items-"+i,style:{counterReset:"listicle-counter "+a}},wp.element.createElement(d,{template:x(i),allowedBlocks:[["lez-library/listitem"]]})))},save:function(e){var t=e.attributes.className,r=e.attributes,n=r.items,i=r.reversed,l="",o=0;return i&&(l="reversed",o=parseInt(""+n)+1),wp.element.createElement("dl",{className:t+" "+l+" listicle items-"+n,style:{counterReset:"listicle-counter "+o}},wp.element.createElement(d.Content,null))}})},function(e,t,r){var n,i;!function(){"use strict";function r(){for(var e=[],t=0;t<arguments.length;t++){var n=arguments[t];if(n){var i=typeof n;if("string"===i||"number"===i)e.push(n);else if(Array.isArray(n))e.push(r.apply(null,n));else if("object"===i)for(var o in n)l.call(n,o)&&n[o]&&e.push(o)}}return e.join(" ")}var l={}.hasOwnProperty;"undefined"!==typeof e&&e.exports?e.exports=r:(n=[],void 0!==(i=function(){return r}.apply(t,n))&&(e.exports=i))}()},function(e,t,r){(function(t){e.exports=function(e,r){function n(){var t,r,n=l,c=arguments.length;e:for(;n;){if(n.args.length===arguments.length){for(r=0;r<c;r++)if(n.args[r]!==arguments[r]){n=n.next;continue e}return n!==l&&(n===o&&(o=n.prev),n.prev.next=n.next,n.next&&(n.next.prev=n.prev),n.next=l,n.prev=null,l.prev=n,l=n),n.val}n=n.next}for(t=new Array(c),r=0;r<c;r++)t[r]=arguments[r];return n={args:t,val:e.apply(null,t)},l?(l.prev=n,n.next=l):o=n,a===i?(o=o.prev,o.next=null):a++,l=n,n.val}var i,l,o,a=0;return r&&r.maxSize&&(i=r.maxSize),n.clear=function(){l=null,o=null,a=0},"test"===t.env.NODE_ENV&&(n.getCache=function(){return[l,o,a]}),n}}).call(t,r(5))},function(e,t){function r(){throw new Error("setTimeout has not been defined")}function n(){throw new Error("clearTimeout has not been defined")}function i(e){if(s===setTimeout)return setTimeout(e,0);if((s===r||!s)&&setTimeout)return s=setTimeout,setTimeout(e,0);try{return s(e,0)}catch(t){try{return s.call(null,e,0)}catch(t){return s.call(this,e,0)}}}function l(e){if(f===clearTimeout)return clearTimeout(e);if((f===n||!f)&&clearTimeout)return f=clearTimeout,clearTimeout(e);try{return f(e)}catch(t){try{return f.call(null,e)}catch(t){return f.call(this,e)}}}function o(){d&&m&&(d=!1,m.length?v=m.concat(v):y=-1,v.length&&a())}function a(){if(!d){var e=i(o);d=!0;for(var t=v.length;t;){for(m=v,v=[];++y<t;)m&&m[y].run();y=-1,t=v.length}m=null,d=!1,l(e)}}function c(e,t){this.fun=e,this.array=t}function u(){}var s,f,p=e.exports={};!function(){try{s="function"===typeof setTimeout?setTimeout:r}catch(e){s=r}try{f="function"===typeof clearTimeout?clearTimeout:n}catch(e){f=n}}();var m,v=[],d=!1,y=-1;p.nextTick=function(e){var t=new Array(arguments.length-1);if(arguments.length>1)for(var r=1;r<arguments.length;r++)t[r-1]=arguments[r];v.push(new c(e,t)),1!==v.length||d||i(a)},c.prototype.run=function(){this.fun.apply(null,this.array)},p.title="browser",p.browser=!0,p.env={},p.argv=[],p.version="",p.versions={},p.on=u,p.addListener=u,p.once=u,p.off=u,p.removeListener=u,p.removeAllListeners=u,p.emit=u,p.prependListener=u,p.prependOnceListener=u,p.listeners=function(e){return[]},p.binding=function(e){throw new Error("process.binding is not supported")},p.cwd=function(){return"/"},p.chdir=function(e){throw new Error("process.chdir is not supported")},p.umask=function(){return 0}},function(e,t,r){function n(e,t){if((e=o(e))<1||e>a)return[];var r=c,n=u(e,c);t=l(t),e-=c;for(var s=i(n,t);++r<e;)t(r);return s}var i=r(7),l=r(8),o=r(10),a=9007199254740991,c=4294967295,u=Math.min;e.exports=n},function(e,t){function r(e,t){for(var r=-1,n=Array(e);++r<e;)n[r]=t(r);return n}e.exports=r},function(e,t,r){function n(e){return"function"==typeof e?e:i}var i=r(9);e.exports=n},function(e,t){function r(e){return e}e.exports=r},function(e,t,r){function n(e){var t=i(e),r=t%1;return t===t?r?t-r:t:0}var i=r(11);e.exports=n},function(e,t,r){function n(e){if(!e)return 0===e?e:0;if((e=i(e))===l||e===-l){return(e<0?-1:1)*o}return e===e?e:0}var i=r(12),l=1/0,o=1.7976931348623157e308;e.exports=n},function(e,t,r){function n(e){if("number"==typeof e)return e;if(l(e))return o;if(i(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=i(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(a,"");var r=u.test(e);return r||s.test(e)?f(e.slice(2),r?2:8):c.test(e)?o:+e}var i=r(13),l=r(14),o=NaN,a=/^\s+|\s+$/g,c=/^[-+]0x[0-9a-f]+$/i,u=/^0b[01]+$/i,s=/^0o[0-7]+$/i,f=parseInt;e.exports=n},function(e,t){function r(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}e.exports=r},function(e,t,r){function n(e){return"symbol"==typeof e||l(e)&&i(e)==o}var i=r(15),l=r(21),o="[object Symbol]";e.exports=n},function(e,t,r){function n(e){return null==e?void 0===e?c:a:u&&u in Object(e)?l(e):o(e)}var i=r(0),l=r(19),o=r(20),a="[object Null]",c="[object Undefined]",u=i?i.toStringTag:void 0;e.exports=n},function(e,t,r){var n=r(17),i="object"==typeof self&&self&&self.Object===Object&&self,l=n||i||Function("return this")();e.exports=l},function(e,t,r){(function(t){var r="object"==typeof t&&t&&t.Object===Object&&t;e.exports=r}).call(t,r(18))},function(e,t){var r;r=function(){return this}();try{r=r||Function("return this")()||(0,eval)("this")}catch(e){"object"===typeof window&&(r=window)}e.exports=r},function(e,t,r){function n(e){var t=o.call(e,c),r=e[c];try{e[c]=void 0;var n=!0}catch(e){}var i=a.call(e);return n&&(t?e[c]=r:delete e[c]),i}var i=r(0),l=Object.prototype,o=l.hasOwnProperty,a=l.toString,c=i?i.toStringTag:void 0;e.exports=n},function(e,t){function r(e){return i.call(e)}var n=Object.prototype,i=n.toString;e.exports=r},function(e,t){function r(e){return null!=e&&"object"==typeof e}e.exports=r},function(e,t){},function(e,t){},function(e,t){var r=wp.i18n.__,n=wp.editor.InnerBlocks,i=wp.blocks.registerBlockType;wp.element.Fragment;i("lez-library/listitem",{title:r("List Item","lezwatch-library"),parent:["lez-library/listicles"],icon:"editor-rtl",category:"formatting",description:r("An individual list item.","lezwatch-library"),edit:function(e){e.className;return wp.element.createElement(n,{template:[["lez-library/listdt"],["lez-library/listdd"]],allowedBlocks:[["lez-library/listdt"],["lez-library/listdd"]]})},save:function(e){e.attributes.className;return wp.element.createElement(n.Content,null)}})},function(e,t){var r=wp.i18n.__,n=wp.editor,i=(n.InnerBlocks,n.RichText),l=wp.blocks.registerBlockType,o=wp.element.Fragment;l("lez-library/listdt",{title:r("List Title","lezwatch-library"),parent:["lez-library/listitem"],icon:"migrate",category:"formatting",attributes:{content:{type:"array",source:"children",selector:"dt"},placeholder:{type:"string",default:r("Title","lezwatch-library")}},description:r("An individual list title.","lezwatch-library"),edit:function(e){var t=e.attributes,r=e.setAttributes,n=(e.isSelected,e.className),l=t.content;return wp.element.createElement(o,null,wp.element.createElement(i,{tagName:"dt",className:n,value:l,onChange:function(e){return r({content:e})}}))},save:function(e){var t=e.attributes,r=e.className,n=t.content;return wp.element.createElement(i.Content,{tagName:"dt",className:r,value:n})}})},function(e,t){var r=wp.i18n.__,n=wp.editor.InnerBlocks,i=wp.blocks.registerBlockType;wp.element.Fragment;i("lez-library/listdd",{title:r("List Content","lezwatch-library"),parent:["lez-library/listitem"],icon:"migrate",category:"formatting",description:r("A list description (aka content).","lezwatch-library"),edit:function(e){var t=e.className;return wp.element.createElement("dd",{className:t},wp.element.createElement(n,{templateLock:!1}))},save:function(e){var t=e.attributes.className;return wp.element.createElement("dd",{className:t},wp.element.createElement(n.Content,null))}})}]);