parcelRequire=function(e,r,t,n){var i,o="function"==typeof parcelRequire&&parcelRequire,u="function"==typeof require&&require;function f(t,n){if(!r[t]){if(!e[t]){var i="function"==typeof parcelRequire&&parcelRequire;if(!n&&i)return i(t,!0);if(o)return o(t,!0);if(u&&"string"==typeof t)return u(t);var c=new Error("Cannot find module '"+t+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[t][1][r]||r},p.cache={};var l=r[t]=new f.Module(t);e[t][0].call(l.exports,p,l,l.exports,this)}return r[t].exports;function p(e){return f(p.resolve(e))}}f.isParcelRequire=!0,f.Module=function(e){this.id=e,this.bundle=f,this.exports={}},f.modules=e,f.cache=r,f.parent=o,f.register=function(r,t){e[r]=[function(e,r){r.exports=t},{}]};for(var c=0;c<t.length;c++)try{f(t[c])}catch(e){i||(i=e)}if(t.length){var l=f(t[t.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=l:"function"==typeof define&&define.amd?define(function(){return l}):n&&(this[n]=l)}if(parcelRequire=f,i)throw i;return f}({"nenD":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var e=function e(){if(this.constructor===e)throw new Error("Can't instantiate abstract class!");this.isCart=!!document.querySelector(".woocommerce-cart"),this.isShop=!!document.querySelector(".woocommerce-shop"),this.isSingle=!!document.querySelector(".single-product"),this.isCheckout=!!document.querySelector(".woocommerce-checkout"),this.isComparison=!!document.querySelector(".page-comparison"),this.isLostPassword=!!document.querySelector(".page-forgot-password")};e.prototype.alert=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=!(arguments.length>1&&void 0!==arguments[1])||arguments[1],o=document.querySelector(".woocommerce-notices-wrapper"),r=document.querySelector(".woocommerce-message");if(o){if(r)r.innerHTML='\n        <button class="w-close-btn" aria-label="Close alert"></button>\n        '.concat(e,"\n      "),setTimeout(function(){r.style.animation="toBottom 1s forwards",setTimeout(function(){return r.remove()},1e3)},3500);else{var n=document.createElement("div");n.className="woocommerce-message",n.setAttribute("role","alert"),n.innerHTML='\n        <button class="w-close-btn" aria-label="Close alert"></button>\n        '.concat(e,"\n    "),o.appendChild(n),setTimeout(function(){n.style.animation="toBottom 1s forwards",setTimeout(function(){return n.remove()},1e3)},3500)}t&&setTimeout(function(){window.scrollTo({top:0,behavior:"smooth"})},300)}},e.prototype.highlightInvalidFields=function(e,t){var o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};e.forEach(function(e){return e.classList.remove("form__input--error")});var r="<ul>";t.forEach(function(e){document.querySelector("[name=".concat(e,"]")).classList.add("form__input--error"),o[e]&&(r+="<li>".concat(o[e],"</li>"))}),(r+="</ul>").length>9&&"function"==typeof this.alert&&this.alert(r)};var t=e;exports.default=t;
},{}],"PegP":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var e=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},r=e;e instanceof FormData||(r=new FormData(e));var n={},a=[],l=!0,o=!1,i=void 0;try{for(var u,s=r.entries()[Symbol.iterator]();!(l=(u=s.next()).done);l=!0){var d=u.value,v=d[0],f=d[1];t.fields[v]&&(t.fields[v](f)||a.push(v)),n[v]=f}}catch(c){o=!0,i=c}finally{try{l||null==s.return||s.return()}finally{if(o)throw i}}return t.count&&t.count!==Object.keys(n).length&&t.push("_invalidCount"),a.length?{result:!1,invalidFields:a}:{result:!0,data:n}},t=e;exports.default=t;
},{}],"i6jj":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var t=r(require("./abstract.js")),e=r(require("../mst/form-validation.js"));function r(t){return t&&t.__esModule?t:{default:t}}function i(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter(function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable})),r.push.apply(r,i)}return r}function n(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?i(r,!0).forEach(function(e){o(t,e,r[e])}):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):i(r).forEach(function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))})}return t}function o(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var s=function(){t.default.apply(this,arguments),this.loginForm=document.querySelector(".login__form--login"),this.signupForm=document.querySelector(".login__new-client--signup"),this.accountForm=document.querySelector(".login__new-client--account"),this.lostPassFirst=document.querySelector(".login__form--restore-password"),this.lostPassSecond=document.querySelector(".login__form--new-password"),this.accountForms=document.querySelectorAll(".login__form"),this.checkoutHiddenForm=document.querySelector(".login__form--login-checkout-hidden"),this.userFieldsRules={fields:{billing_first_name:function(t){return/^[ÁáÐðÉéÍíÓóÚúÝýÞþÆæÖöA-Za-z\s]+$/.test(t.trim())&&t.trim().length&&t.trim().length<=20},billing_email:function(t){return/\S+@\S+\.\S+/.test(t)},billing_phone:function(t){return/^[0-9]+$/.test(t.trim())&&t.trim().length&&t.trim().length<=12},billing_address_1:function(t){return t.trim().length},billing_city:function(t){return t.trim().length},billing_postcode:function(t){return t.trim().length},billing_ssn:function(t){return/^\d{10}$/.test(t)}}},this.userErrorMessages={billing_first_name:mainState.i18n.error_billing_first_name,billing_email:mainState.i18n.error_billing_email,billing_phone:mainState.i18n.error_billing_phone,password:mainState.i18n.error_password,billing_address_1:mainState.i18n.error_billing_address_1,billing_city:mainState.i18n.error_billing_city,billing_postcode:mainState.i18n.error_billing_postcode,billing_ssn:mainState.i18n.error_billing_ssn},this.accountMenu=document.querySelector(".account__nav-list")};s.prototype=Object.create(t.default.prototype),s.prototype.constructor=s,s.prototype.initLoginForm=function(){var t=this;this.loginForm&&!this.isCheckout&&this.loginForm.addEventListener("submit",function(r){r.preventDefault();var i=(0,e.default)(r.target,{fields:{email:function(t){return/\S+@\S+\.\S+/.test(t)},user_password:function(t){return t.trim().length}}});if(i.result){var n=t;jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_login",data:i.data},success:function(t){t.success?r.target.dataset.redirect?location=r.target.dataset.redirect:location=mainState.accountUrl:n.alert(t.data.error)}})}else t.highlightInvalidFields(r.target.querySelectorAll(".login__form--login .form__input"),i.invalidFields)})},s.prototype.initSignupForm=function(){var t=this;this.signupForm&&this.signupForm.addEventListener("submit",function(r){r.preventDefault();var i=(0,e.default)(r.target,n({password:function(t){return t.trim().length>6}},t.userFieldsRules)),o=t;i.result?jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_sign_up",data:i.data},success:function(t){t.success?location=mainState.accountUrl:o.alert(t.data.error)}}):t.highlightInvalidFields(r.target.querySelectorAll(".login__new-client--signup .form__input"),i.invalidFields)})},s.prototype.initAccountForm=function(){var t=this;this.accountForm&&this.accountForm.addEventListener("submit",function(r){r.preventDefault();var i=(0,e.default)(r.target,t.userFieldsRules),n=t;i.result?jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_update_account_data",data:i.data},success:function(t){t.success?(n.highlightInvalidFields(r.target.querySelectorAll(".login__new-client--signup .form__input"),[],n.userErrorMessages),n.alert(mainState.i18n.dataUpdated)):n.alert(t.data.error)}}):t.highlightInvalidFields(r.target.querySelectorAll(".login__new-client--signup .form__input"),i.invalidFields,t.userErrorMessages)})},s.prototype.initFirstLostPasswordForm=function(){var t=this;this.isLostPassword&&this.lostPassFirst&&this.lostPassFirst.addEventListener("submit",function(r){r.preventDefault();var i=(0,e.default)(r.target,{fields:{"restore-email":function(t){return/\S+@\S+\.\S+/.test(t)}}}),n={"restore-email":mainState.i18n.error_billing_email},o=t;i.result?jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_restore_password_first",data:i.data},success:function(t){t.success?(o.lostPassFirst.remove(),document.querySelector(".search__result-title-box").classList.remove("hidden")):o.alert(t.data.error)}}):t.highlightInvalidFields(r.target.querySelectorAll(".login__form--restore-password .form__input"),i.invalidFields,n)})},s.prototype.initSecondLostPasswordForm=function(){var t=this;this.isLostPassword&&this.lostPassSecond&&this.lostPassSecond.addEventListener("submit",function(r){r.preventDefault();var i=(0,e.default)(r.target,{fields:{new_password_first:function(t){return t.length>=6},new_password_second:function(t){return t.length>=6}}}),o={new_password_first:mainState.i18n.error_password};if(i.result){if(i.data.new_password_first!==i.data.new_password_second)return t.highlightInvalidFields(r.target.querySelectorAll(".login__form--restore-password .form__input"),["new_password_first","new_password_second"],{new_password_first:mainState.i18n.error_passwords_arent_equal});var s=n({key:restoreData.key,login:restoreData.login},i.data),a=t;jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_restore_password_second",data:s},success:function(t){t.success?location=mainState.loginUrl:a.alert(t.data.error)}})}else t.highlightInvalidFields(r.target.querySelectorAll(".login__form--restore-password .form__input"),i.invalidFields,o)})},s.prototype.initAccountMenu=function(){var t=this;this.accountMenu&&this.accountMenu.addEventListener("click",function(e){var r=e.target;r.classList.contains("account__nav-link")&&(t.accountMenu.querySelectorAll("a").forEach(function(t){return t.classList.remove("account__nav-link--active")}),r.classList.add("account__nav-link--active"),"orders"===r.dataset.href&&(document.querySelector(".orders").classList.remove("hidden"),document.querySelector(".account-data-container").classList.add("hidden")),"account"===r.dataset.href&&(document.querySelector(".orders").classList.add("hidden"),document.querySelector(".account-data-container").classList.remove("hidden")))})},s.prototype.setFormsCollapsing=function(){this.accountForms.length&&this.accountForms.forEach(function(t){var e=t.querySelector(".login__title");e&&e.addEventListener("click",function(){t.classList.toggle("collapsed"),e.classList.toggle("login__title--active")})})},s.prototype.initCheckoutLoginForm=function(){var t=this;this.checkoutHiddenForm&&this.isCheckout&&this.checkoutHiddenForm.addEventListener("submit",function(r){r.preventDefault();var i=(0,e.default)(r.target,{fields:{email:function(t){return/\S+@\S+\.\S+/.test(t)},user_password:function(t){return t.trim().length}}});if(i.result){var n=t;jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_login",data:i.data},success:function(t){t.success?r.target.dataset.redirect?location=r.target.dataset.redirect:location=mainState.accountUrl:n.alert(t.data.error)}})}else t.highlightInvalidFields(r.target.querySelectorAll(".login__form--login-checkout-visible .form__input"),i.invalidFields)})},s.prototype.init=function(){this.initLoginForm(),this.initSignupForm(),this.initAccountForm(),this.initAccountMenu(),this.initFirstLostPasswordForm(),this.initSecondLostPasswordForm(),this.setFormsCollapsing(),this.initCheckoutLoginForm()};var a=s;exports.default=a;
},{"./abstract.js":"nenD","../mst/form-validation.js":"PegP"}],"BCzK":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var e=t(require("./abstract.js"));function t(e){return e&&e.__esModule?e:{default:e}}var r=function(){e.default.apply(this,arguments)};r.prototype=Object.create(e.default.prototype),r.prototype.constructor=r,r.prototype.listenCompareBtns=function(){document.querySelector(".compare-btn")&&document.addEventListener("click",function(e){var t=e.target;if(t.classList.contains("compare-btn")&&!t.classList.contains("compare-btn--active")){var r=t.parentElement.parentElement.dataset.id,a=t.closest("ul");jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_add_to_comparing",data:{product_id:r}},beforeSend:function(){t.disabled=!0,a&&jQuery(a).block()},complete:function(){t.disabled=!1,a&&jQuery(a).unblock()},success:function(e){e.success&&(t.classList.add("compare-btn--active"),t.closest(".product-item").classList.add("header__user-list--active"),document.querySelectorAll(".header__comparison-link").forEach(function(e){if(e.classList.add("heartBeat"),setTimeout(function(){return e.classList.remove("heartBeat")},1300),e.children[1]){var t=parseInt(e.children[1].innerText);e.children[1].innerText=t+1}else{var r=document.createElement("span");r.className="quantity-product-circle",r.innerText="1",e.appendChild(r)}}))}})}if(t.classList.contains("compare-btn")&&t.classList.contains("compare-btn--active")){var n=t.parentElement.parentElement.dataset.id,o=t.closest("ul");jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_remove_from_comparing",data:{product_id:n}},beforeSend:function(){t.disabled=!0,o&&jQuery(o).block()},complete:function(){t.disabled=!1,o&&jQuery(o).unblock()},success:function(e){e.success&&(t.classList.remove("compare-btn--active"),t.closest(".product-item").classList.remove("header__user-list--active"),document.querySelectorAll(".header__comparison-link").forEach(function(e){var t=parseInt(e.children[1].innerText);e.classList.add("heartBeat"),setTimeout(function(){return e.classList.remove("heartBeat")},2e3),t-1?e.children[1].innerText=t-1:e.children[1].remove()}));t.disabled=!1}})}})},r.prototype.initComparisonRemoveBtns=function(){this.isComparison&&document.addEventListener("click",function(e){if(e.target.classList.contains("compare__remove-bnt")){var t=e.target.parentElement.dataset.id;jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_remove_from_comparing",data:{product_id:t}},success:function(e){if(e.success){document.querySelectorAll('[data-product-id="'.concat(t,'"]')).forEach(function(e){return e.remove()}),document.querySelectorAll("[data-product-id]").length<2&&document.querySelector(".compare__hide-filter")&&document.querySelector(".compare__hide-filter").remove(),document.querySelector("[data-product-id]")||(document.querySelector(".compare__table").remove(),document.querySelector(".compare__table-wrap").innerHTML='\n               <div class="search__result-title-box">\n                <h2 class="secondary-title search__result-title">\n                  '.concat(mainState.i18n.comparingIsEmpty,"\n                </h2>\n              </div>\n              "),document.querySelector(".compare__table-wrap").classList.remove("compare__table-wrap"),window.scrollTo({top:0,behavior:"smooth"}));var r=document.querySelector(".header__comparison-link"),a=parseInt(r.children[1].innerText);r.classList.add("heartBeat"),setTimeout(function(){return r.classList.remove("heartBeat")},2e3),a-1?r.children[1].innerText=a-1:r.children[1].remove()}}})}})},r.prototype.setSingleCompareButton=function(){this.isSingle&&document.addEventListener("click",function(e){var t=e.target;if(t.classList.contains("one-product__compare-link")&&!t.classList.contains("one-product__compare-link--active")){var r=e.target.dataset.id;jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_add_to_comparing",data:{product_id:r}},success:function(e){if(e.success){t.innerText=mainState.i18n.inComparisonList,t.href=mainState.comparisonUrl,t.classList.add("one-product__compare-link--active");var r=document.querySelector(".header__comparison-link");if(r.classList.add("heartBeat"),setTimeout(function(){return r.classList.remove("heartBeat")},1300),r.children[1]){var a=parseInt(r.children[1].innerText);r.children[1].innerText=a+1}else{var n=document.createElement("span");n.className="quantity-product-circle",n.innerText="1",r.appendChild(n)}}}})}})},r.prototype.initHidingCheckbox=function(){if(this.isComparison){var e=document.querySelector("#hide-filter-check");e&&e.addEventListener("change",function(e){var t=e.target.checked,r={skuRow:document.querySelectorAll(".compare__model-row td"),imgRow:document.querySelectorAll(".compare__img-row td"),priceRow:document.querySelectorAll(".compare__price-row td"),availabilityRow:document.querySelectorAll(".compare__status-row td")};if(!(r.skuRow.length<=1))if(t){var a=function(e){r.hasOwnProperty(e)&&([].every.call(r[e],function(t){return t.innerHTML===r[e][0].innerHTML})&&r[e][0].parentElement.classList.add("hidden"))};for(var n in r)a(n)}else{var o=document.querySelectorAll(".compare__status-row.hidden");o&&o.forEach(function(e){return e.classList.remove("hidden")})}})}},r.prototype.init=function(){this.listenCompareBtns(),this.setSingleCompareButton(),this.initHidingCheckbox(),this.initComparisonRemoveBtns()};var a=r;exports.default=a;
},{"./abstract.js":"nenD"}],"MJuN":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var e=function(){document.querySelectorAll('a[href*="#"]').forEach(function(e){e.addEventListener("click",function(t){t.preventDefault();var o=new URL(document.URL),r=new URL(e.href),n=r.hash;if("#"!==n)if(r.pathname===o.pathname){var a=document.querySelector(n);a&&a.scrollIntoView({behavior:"smooth"})}else location=r.href})})},t=e;exports.default=t;
},{}],"MXVW":[function(require,module,exports) {
"use strict";var t=i(require("./modules/classes/abstract.js")),e=i(require("./modules/classes/account.js")),o=i(require("./modules/classes/comparing.js")),n=i(require("./modules/mst/smooth-anchors.js")),r=i(require("./modules/mst/form-validation.js"));function i(t){return t&&t.__esModule?t:{default:t}}var s=function(){t.default.apply(this,arguments),this.hambButton=document.querySelector(".hamburger"),this.mobileMenu=document.querySelector(".header__mobile-menu"),this.mobileMenuWrapper=document.querySelector(".mobile-menu-wrapper"),this.footerForm=document.querySelector("form.form"),this.formInputs=document.querySelectorAll(".form__input"),this.footerFormErrorMessage=document.querySelector(".form__error"),this.footerFormSuccessMessage=document.querySelector(".form__success"),this.instructionVideoLinks=document.querySelectorAll(".main-instructions__video"),this.quantityContainers=document.querySelectorAll(".product-quantity"),this.quantityInputs=document.querySelectorAll(".qty"),this.shopSliderContainer=document.querySelector(".custom-banner__slider"),this.shopSidebar=document.querySelector(".widget_product_categories"),this.catalogProductWrappers=document.querySelectorAll(".category-product__product-list")};s.prototype=Object.create(t.default.prototype),s.prototype.constructor=s,s.prototype.smoothAnchors=n.default,s.prototype.setAnimations=function(){"function"==typeof AOS&&AOS.init()},s.prototype.initHamburgerMenu=function(){var t=this;this.hambButton.addEventListener("click",function(){t.hambButton.classList.toggle("is-active"),t.mobileMenu.classList.toggle("header__mobile-menu--visible"),t.mobileMenuWrapper.classList.toggle("mobile-menu-wrapper--pos")})},s.prototype.fixCatalogsTitle=function(){var t=document.querySelector(".catalog__title, .widget_product_categories h2");t&&"Vöruflokkar"===t.innerText.trim()&&(t.innerHTML='Vöru<span style="margin-right: 1.1px;">f</span>lokkar')},s.prototype.initVideoViewer=function(){this.instructionVideoLinks.length&&"function"==typeof BigPicture&&this.instructionVideoLinks.forEach(function(t){t.addEventListener("click",function(e){e.preventDefault(),BigPicture({el:t,vidSrc:t.href})})})},s.prototype.setClientsSlider=function(){"function"==typeof jQuery&&jQuery(".clients__list").slick({prevArrow:"",nextArrow:"",dots:!0,appendDots:jQuery(".clients__carousel-buttons"),customPaging:function(){return'<button class="clients__carousel-btn"></button>'},slidesToShow:6,slidesToScroll:6,autoplay:!0,autoplaySpeed:5e3,responsive:[{breakpoint:992,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:575,settings:{slidesToShow:1,slidesToScroll:1,dots:!1}}]})},s.prototype.setTestimonialsSlider=function(){"function"==typeof jQuery&&jQuery(".testimonials__reviews").slick({prevArrow:"",nextArrow:"",dots:!0,appendDots:jQuery(".testimonials__buttons"),customPaging:function(t,e){return e<10&&(e="0".concat(e+1)),'<button class="testimonials__btn" data-count="'.concat(e,'"></button>')},slidesToShow:2,slidesToScroll:2,autoplay:!0,autoplaySpeed:5e3,responsive:[{breakpoint:575,settings:{slidesToShow:1,slidesToScroll:1}}]})},s.prototype.initFooterForm=function(){var t=this;this.footerForm.addEventListener("submit",function(e){e.preventDefault();var o=(0,r.default)(e.target,{fields:{name:function(t){return/^[ÁáÐðÉéÍíÓóÚúÝýÞþÆæÖöA-Za-z\s]+$/.test(t.trim())&&t.trim().length&&t.trim().length<=30},phone:function(t){return/^[0-9]+$/.test(t.trim())&&t.trim().length&&t.trim().length<=12},email:function(t){return/\S+@\S+\.\S+/.test(t)},company:function(t){return t.trim().length&&t.trim().length<=20},message:function(t){return t.trim().length<=200}}});if(o.result){var n=t;jQuery.ajax({type:"POST",url:mainState.ajaxUrl,data:{action:"mst_bodleid_cb",data:o.data},success:function(){n.footerForm.remove(),n.footerFormSuccessMessage.classList.remove("hidden")}})}else t.highlightInvalidFields(t.formInputs,o.invalidFields),t.footerFormErrorMessage&&t.footerFormErrorMessage.classList.add("form__error--is-active")})},s.prototype.setFormFloatedLabels=function(){var t=function(t){t.value?t.classList.add("form__input-filled"):t.classList.remove("form__input-filled")};this.formInputs.forEach(function(e){t(e),e.addEventListener("change",function(){t(e)})})},s.prototype.setCartInputButtons=function(){if(this.isCart){var t=function(){setTimeout(function(){return jQuery('[name="update_cart"]').trigger("click")},1200)};document.addEventListener("click",function(e){var o=e.target;if(o.classList.contains("one-product__btn--plus")){e.preventDefault();var n=parseInt(o.previousElementSibling.children[1].value)+1;o.previousElementSibling.children[1].value=n,document.querySelector('button[name="update_cart"]')&&(document.querySelector('button[name="update_cart"]').disabled=!1),t()}if(o.classList.contains("one-product__btn--minus")){e.preventDefault();var r=parseInt(o.nextElementSibling.children[1].value)-1;if(r<=0)return void(o.nextElementSibling.children[1].value=0);o.nextElementSibling.children[1].value=r,document.querySelector('button[name="update_cart"]')&&(document.querySelector('button[name="update_cart"]').disabled=!1),t()}}),this.quantityInputs.forEach(function(t){t.addEventListener("change",function(){0===parseInt(t.value)?t.parentElement.nextElementSibling.classList.add("one-product__btn--inactive"):t.parentElement.nextElementSibling.classList.remove("one-product__btn--inactive")})})}},s.prototype.updateCartShippingMethods=function(){this.isCart&&document.addEventListener("click",function(t){t.target.classList.contains("shipping_method")&&(document.querySelector('[name="update_cart"]').disabled=!1,setTimeout(function(){return jQuery('[name="update_cart"]').trigger("click")},1200))})},s.prototype.fixCheckoutNotice=function(){this.isCheckout&&this.isCart&&jQuery(document).ajaxComplete(function(){jQuery("html, body").stop()})},s.prototype.initShopSlider=function(){this.shopSliderContainer&&jQuery(".custom-banner__slider").slick({arrows:!1,dots:!0,appendDots:jQuery(".custom-banner__nav-list"),customPaging:function(t,e){return e<10&&(e="0".concat(e+1)),'<button class="custom-banner__nav-btn" data-count="'.concat(e,'"></button>')}})},s.prototype.setSingleInputButtons=function(){if(this.isSingle){var t=document.querySelector(".one-product__btn--plus"),e=document.querySelector(".one-product__btn--minus");t&&t.addEventListener("click",function(t){t.preventDefault();var e=t.target,o=parseInt(e.previousElementSibling.children[1].value)+1;e.previousElementSibling.children[1].value=o}),e&&e.addEventListener("click",function(t){t.preventDefault();var e=t.target,o=parseInt(e.nextElementSibling.children[1].value)-1;e.nextElementSibling.children[1].value=o<=0?1:o})}},s.prototype.setCloseModalButton=function(){document.addEventListener("click",function(t){t.target.classList.contains("w-close-btn")&&t.target.parentElement.remove()})},s.prototype.setSingleProductGallery=function(){if(this.isSingle){var t=document.querySelector(".one-product__product-gallery"),e=document.querySelectorAll(".one-product__product-gallery li").length;t&&(jQuery(".one-product__open-img").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,fade:!0,asNavFor:".one-product__product-gallery"}),jQuery(".one-product__product-gallery").slick({slidesToShow:e,slidesToScroll:1,asNavFor:".one-product__open-img",dots:!1,arrows:!1,centerMode:!0,focusOnSelect:!0})),window.addEventListener("resize",function(){jQuery(".one-product__product-gallery").slick("refresh")})}},s.prototype.initShopSidebar=function(){if(this.shopSidebar){var t=document.querySelectorAll("li.cat-parent > a"),e=document.querySelector(".current-cat-parent");e&&e.classList.add("cat-parent--active"),t.forEach(function(t){t.addEventListener("click",function(e){e.preventDefault(),t.parentElement.classList.toggle("cat-parent--active")})});var o=document.querySelector(".widget_product_categories .widget-title");if(o){var n=function(){var t=document.querySelector(".widget_product_categories .product-categories");t&&(""===t.style.display||"none"===t.style.display?t.style.display="block":t.style.display="none")};window.matchMedia("(max-width: 992px)").matches&&o.addEventListener("click",n),window.addEventListener("resize",function(){window.matchMedia("(max-width: 992px)").matches?o.addEventListener("click",n):o.removeEventListener("click",n)})}}},s.prototype.initAddToCartAJAX=function(){var t=this,e=document.querySelectorAll(".ajax_add_to_cart");e.length&&e.forEach(function(e){e.addEventListener("click",function(e){e.preventDefault();var o=e.target,n=o.closest("ul");if(!o.classList.contains("is-disabled")){var r={action:"woocommerce_ajax_add_to_cart",product_id:e.target.dataset.product_id,product_sku:e.target.dataset.product_sku,quantity:1,variation_id:e.target.dataset.variation},i=t;jQuery.ajax({type:"POST",url:wc_add_to_cart_params.ajax_url,data:r,beforeSend:function(){o.classList.add("is-disabled"),n&&jQuery(n).block()},complete:function(){o.classList.remove("is-disabled"),n&&jQuery(n).unblock()},success:function(t){if(!1!==t.success){o.parentElement.classList.add("to-cart-box--added"),o.innerText=wc_add_to_cart_params.i18n_view_cart;var e=o.closest(".product-item").querySelector(".product-info h4, .product-info h3").innerText;o.classList.remove("ajax_add_to_cart");var n=o.cloneNode(!0);o.parentElement.replaceChild(n,o),document.querySelectorAll(".header__cart-link").forEach(function(t){if(t.classList.add("heartBeat"),setTimeout(function(){return t.classList.remove("heartBeat")},1300),t.children[1]){var e=parseInt(t.children[1].innerText);t.children[1].innerText=e+1}else{var o=document.createElement("span");o.className="quantity-product-circle",o.innerText="1",t.appendChild(o)}});var r='\n\t\t            <a href="'.concat(wc_add_to_cart_params.cart_url,'" tabindex="1" class="button wc-forward">\n                  ').concat(wc_add_to_cart_params.i18n_view_cart,"\n                </a>\n\t\t            “").concat(e,"” hefur verið bætt í vörukörfuna þína.");i.alert(r,!1)}}})}})})},s.prototype.fixInputsInCheckout=function(){this.isCheckout&&(jQuery(".woocommerce-input-wrapper").each(function(){jQuery(this).insertBefore(jQuery(this).prev())}),jQuery(".login__new-client--checkout .form__input").unwrap(),jQuery(".send-comment-form .form__input-box--textarea textarea").unwrap(),jQuery("#account_password").unwrap())},s.prototype.initCatalogProductSliders=function(){if(this.catalogProductWrappers){window.matchMedia("(max-width: 992px)").matches&&"function"==typeof jQuery&&jQuery(".category-product__product-list").slick({arrows:!1,dots:!1,autoplay:!0,autoplaySpeed:5e3,responsive:[{breakpoint:99999,settings:"unslick"},{breakpoint:992,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:575,settings:{slidesToShow:1,slidesToScroll:1}}]}),window.addEventListener("resize",function(){window.matchMedia("(max-width: 992px)").matches&&jQuery(".category-product__product-list").slick("refresh")})}},s.prototype.initSingleProductSlider=function(){"function"==typeof jQuery&&this.isSingle&&jQuery(".product-menu").length&&jQuery(".product-menu").slick({arrows:!1,dots:!1,autoplay:!0,autoplaySpeed:5e3,slidesToShow:4,slidesToScroll:1,responsive:[{breakpoint:992,settings:{slidesToShow:2,slidesToScroll:1}},{breakpoint:575,settings:{slidesToShow:2,slidesToScroll:1}}]})},s.prototype.init=function(){this.initHamburgerMenu(),this.setAnimations(),this.smoothAnchors(),this.fixCatalogsTitle(),this.initVideoViewer(),this.initFooterForm(),this.setClientsSlider(),this.setTestimonialsSlider(),this.setFormFloatedLabels(),this.setCartInputButtons(),this.updateCartShippingMethods(),this.fixCheckoutNotice(),this.initShopSlider(),this.initShopSidebar(),this.initAddToCartAJAX(),this.setSingleInputButtons(),this.setCloseModalButton(),this.setSingleProductGallery(),this.fixInputsInCheckout(),this.initCatalogProductSliders(),this.initSingleProductSlider()},document.addEventListener("DOMContentLoaded",function(){(new s).init(),(new e.default).init(),(new o.default).init()});
},{"./modules/classes/abstract.js":"nenD","./modules/classes/account.js":"i6jj","./modules/classes/comparing.js":"BCzK","./modules/mst/smooth-anchors.js":"MJuN","./modules/mst/form-validation.js":"PegP"}]},{},["MXVW"], null)
//# sourceMappingURL=/common.js.map