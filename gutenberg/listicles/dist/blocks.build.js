!function(e){function t(r){if(n[r])return n[r].exports;var i=n[r]={i:r,l:!1,exports:{}};return e[r].call(i.exports,i,i.exports,t),i.l=!0,i.exports}var n={};t.m=e,t.c=n,t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{configurable:!1,enumerable:!0,get:r})},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=1)}([function(e,t,n){var r=n(16),i=r.Symbol;e.exports=i},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=(n(2),n(24)),i=(n.n(r),n(25)),o=(n.n(i),n(26));n.n(o)},function(e,t,n){"use strict";var r=n(3),i=(n.n(r),n(4)),o=n.n(i),l=n(6),c=n.n(l),a=n(22),s=(n.n(a),n(23)),u=(n.n(s),wp.i18n.__,wp.element.Fragment),f=wp.blocks,p=(f.createBlock,f.registerBlockType),m=wp.editor,d=m.InnerBlocks,v=m.InspectorControls,y=wp.components,b=y.PanelBody,w=y.ToggleControl,g=y.RangeControl,h=y.IconButton,x=o()(function(e){return c()(e,function(){return["lez-library/listitem"]})});p("lez-library/listicles",{title:"Listicle",icon:"excerpt-view",category:"lezwatch",attributes:{items:{type:"number",default:2},reversed:{type:"boolean",default:!1}},description:"A block for listicles. Adjust the number with the slider, and flip it reversible if you so desire. Lists only can go up to 18 for managability.",edit:function(e){var t=(e.attributes.placeholder,e.className),n=e.setAttributes,r=e.attributes,i=r.items,o=r.reversed,l="",c="0";return o&&(l="reversed",c=parseInt(""+i)+1),wp.element.createElement(u,null,wp.element.createElement(v,null,wp.element.createElement(b,{title:"Listicle Settings"},wp.element.createElement(g,{label:"Items",value:i,onChange:function(e){return n({items:e})},min:1,max:18}),wp.element.createElement(w,{label:"Reversed",help:function(e){return e?"Reversed order (10 - 1)":"Numerical order (1 - 10)"},checked:e.attributes.reversed,onChange:function(){return e.setAttributes({reversed:!e.attributes.reversed})}}))),wp.element.createElement("dl",{className:t+" "+l+" listicle items-"+i,style:{counterReset:"listicle-counter "+c}},wp.element.createElement(d,{template:x(i),allowedBlocks:[["lez-library/listitem"]]}),wp.element.createElement("div",{className:"listicles-buttons"},wp.element.createElement(h,{icon:"insert",onClick:function(){return n({items:parseInt(""+i)+1})},className:"editor-inserter__toggle"},"Add Item"),wp.element.createElement(h,{icon:"dismiss",onClick:function(){return n({items:parseInt(""+i)-1})},className:"editor-inserter__toggle"},"Remove Item"),wp.element.createElement(h,{icon:"controls-repeat",onClick:function(){return n({reversed:!o})},className:"editor-inserter__toggle"},"Toggle Order"))))},save:function(e){var t=e.attributes.className,n=e.attributes,r=n.items,i=n.reversed,o="",l=0;return i&&(o="reversed",l=parseInt(""+r)+1),wp.element.createElement("dl",{className:t+" "+o+" listicle items-"+r,style:{counterReset:"listicle-counter "+l}},wp.element.createElement(d.Content,null))}})},function(e,t,n){var r,i;!function(){"use strict";function n(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var i=typeof r;if("string"===i||"number"===i)e.push(r);else if(Array.isArray(r))e.push(n.apply(null,r));else if("object"===i)for(var l in r)o.call(r,l)&&r[l]&&e.push(l)}}return e.join(" ")}var o={}.hasOwnProperty;"undefined"!==typeof e&&e.exports?e.exports=n:(r=[],void 0!==(i=function(){return n}.apply(t,r))&&(e.exports=i))}()},function(e,t,n){(function(t){e.exports=function(e,n){function r(){var t,n,r=o,a=arguments.length;e:for(;r;){if(r.args.length===arguments.length){for(n=0;n<a;n++)if(r.args[n]!==arguments[n]){r=r.next;continue e}return r!==o&&(r===l&&(l=r.prev),r.prev.next=r.next,r.next&&(r.next.prev=r.prev),r.next=o,r.prev=null,o.prev=r,o=r),r.val}r=r.next}for(t=new Array(a),n=0;n<a;n++)t[n]=arguments[n];return r={args:t,val:e.apply(null,t)},o?(o.prev=r,r.next=o):l=r,c===i?(l=l.prev,l.next=null):c++,o=r,r.val}var i,o,l,c=0;return n&&n.maxSize&&(i=n.maxSize),r.clear=function(){o=null,l=null,c=0},"test"===t.env.NODE_ENV&&(r.getCache=function(){return[o,l,c]}),r}}).call(t,n(5))},function(e,t){function n(){throw new Error("setTimeout has not been defined")}function r(){throw new Error("clearTimeout has not been defined")}function i(e){if(u===setTimeout)return setTimeout(e,0);if((u===n||!u)&&setTimeout)return u=setTimeout,setTimeout(e,0);try{return u(e,0)}catch(t){try{return u.call(null,e,0)}catch(t){return u.call(this,e,0)}}}function o(e){if(f===clearTimeout)return clearTimeout(e);if((f===r||!f)&&clearTimeout)return f=clearTimeout,clearTimeout(e);try{return f(e)}catch(t){try{return f.call(null,e)}catch(t){return f.call(this,e)}}}function l(){v&&m&&(v=!1,m.length?d=m.concat(d):y=-1,d.length&&c())}function c(){if(!v){var e=i(l);v=!0;for(var t=d.length;t;){for(m=d,d=[];++y<t;)m&&m[y].run();y=-1,t=d.length}m=null,v=!1,o(e)}}function a(e,t){this.fun=e,this.array=t}function s(){}var u,f,p=e.exports={};!function(){try{u="function"===typeof setTimeout?setTimeout:n}catch(e){u=n}try{f="function"===typeof clearTimeout?clearTimeout:r}catch(e){f=r}}();var m,d=[],v=!1,y=-1;p.nextTick=function(e){var t=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)t[n-1]=arguments[n];d.push(new a(e,t)),1!==d.length||v||i(c)},a.prototype.run=function(){this.fun.apply(null,this.array)},p.title="browser",p.browser=!0,p.env={},p.argv=[],p.version="",p.versions={},p.on=s,p.addListener=s,p.once=s,p.off=s,p.removeListener=s,p.removeAllListeners=s,p.emit=s,p.prependListener=s,p.prependOnceListener=s,p.listeners=function(e){return[]},p.binding=function(e){throw new Error("process.binding is not supported")},p.cwd=function(){return"/"},p.chdir=function(e){throw new Error("process.chdir is not supported")},p.umask=function(){return 0}},function(e,t,n){function r(e,t){if((e=l(e))<1||e>c)return[];var n=a,r=s(e,a);t=o(t),e-=a;for(var u=i(r,t);++n<e;)t(n);return u}var i=n(7),o=n(8),l=n(10),c=9007199254740991,a=4294967295,s=Math.min;e.exports=r},function(e,t){function n(e,t){for(var n=-1,r=Array(e);++n<e;)r[n]=t(n);return r}e.exports=n},function(e,t,n){function r(e){return"function"==typeof e?e:i}var i=n(9);e.exports=r},function(e,t){function n(e){return e}e.exports=n},function(e,t,n){function r(e){var t=i(e),n=t%1;return t===t?n?t-n:t:0}var i=n(11);e.exports=r},function(e,t,n){function r(e){if(!e)return 0===e?e:0;if((e=i(e))===o||e===-o){return(e<0?-1:1)*l}return e===e?e:0}var i=n(12),o=1/0,l=1.7976931348623157e308;e.exports=r},function(e,t,n){function r(e){if("number"==typeof e)return e;if(o(e))return l;if(i(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=i(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(c,"");var n=s.test(e);return n||u.test(e)?f(e.slice(2),n?2:8):a.test(e)?l:+e}var i=n(13),o=n(14),l=NaN,c=/^\s+|\s+$/g,a=/^[-+]0x[0-9a-f]+$/i,s=/^0b[01]+$/i,u=/^0o[0-7]+$/i,f=parseInt;e.exports=r},function(e,t){function n(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}e.exports=n},function(e,t,n){function r(e){return"symbol"==typeof e||o(e)&&i(e)==l}var i=n(15),o=n(21),l="[object Symbol]";e.exports=r},function(e,t,n){function r(e){return null==e?void 0===e?a:c:s&&s in Object(e)?o(e):l(e)}var i=n(0),o=n(19),l=n(20),c="[object Null]",a="[object Undefined]",s=i?i.toStringTag:void 0;e.exports=r},function(e,t,n){var r=n(17),i="object"==typeof self&&self&&self.Object===Object&&self,o=r||i||Function("return this")();e.exports=o},function(e,t,n){(function(t){var n="object"==typeof t&&t&&t.Object===Object&&t;e.exports=n}).call(t,n(18))},function(e,t){var n;n=function(){return this}();try{n=n||Function("return this")()||(0,eval)("this")}catch(e){"object"===typeof window&&(n=window)}e.exports=n},function(e,t,n){function r(e){var t=l.call(e,a),n=e[a];try{e[a]=void 0;var r=!0}catch(e){}var i=c.call(e);return r&&(t?e[a]=n:delete e[a]),i}var i=n(0),o=Object.prototype,l=o.hasOwnProperty,c=o.toString,a=i?i.toStringTag:void 0;e.exports=r},function(e,t){function n(e){return i.call(e)}var r=Object.prototype,i=r.toString;e.exports=n},function(e,t){function n(e){return null!=e&&"object"==typeof e}e.exports=n},function(e,t){},function(e,t){},function(e,t){var n=(wp.i18n.__,wp.editor.InnerBlocks),r=wp.blocks.registerBlockType;wp.element.Fragment;r("lez-library/listitem",{title:"List Item",parent:["lez-library/listicles"],icon:"editor-rtl",category:"lezwatch",description:"An individual list item.",edit:function(e){e.className;return wp.element.createElement(n,{template:[["lez-library/listdt"],["lez-library/listdd"]],allowedBlocks:[["lez-library/listdt"],["lez-library/listdd"]]})},save:function(e){e.attributes.className;return wp.element.createElement(n.Content,null)}})},function(e,t){var n=(wp.i18n.__,wp.editor),r=(n.InnerBlocks,n.RichText),i=wp.blocks.registerBlockType,o=wp.element.Fragment;i("lez-library/listdt",{title:"List Title",parent:["lez-library/listitem"],icon:"migrate",category:"lezwatch",attributes:{content:{type:"array",source:"children",selector:"dt"},placeholder:{type:"string",default:"Title"}},description:"An individual list title.",edit:function(e){var t=e.attributes,n=e.setAttributes,i=(e.isSelected,e.className),l=t.content;return wp.element.createElement(o,null,wp.element.createElement(r,{tagName:"dt",className:i,value:l,onChange:function(e){return n({content:e})}}))},save:function(e){var t=e.attributes,n=e.className,i=t.content;return wp.element.createElement(r.Content,{tagName:"dt",className:n,value:i})}})},function(e,t){var n=(wp.i18n.__,wp.editor.InnerBlocks),r=wp.blocks.registerBlockType;wp.element.Fragment;r("lez-library/listdd",{title:"List Content",parent:["lez-library/listitem"],icon:"migrate",category:"lezwatch",description:"A list description (aka content).",edit:function(e){var t=e.className;return wp.element.createElement("dd",{className:t},wp.element.createElement(n,{templateLock:!1}))},save:function(e){var t=e.attributes.className;return wp.element.createElement("dd",{className:t},wp.element.createElement(n.Content,null))}})}]);