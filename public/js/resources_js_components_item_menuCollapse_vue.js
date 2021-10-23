"use strict";
(self["webpackChunkboxity_app"] = self["webpackChunkboxity_app"] || []).push([["resources_js_components_item_menuCollapse_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: ["title", "icon", "routerLink", "isSidebar", "listId"],
  data: function data() {
    return {
      content: false,
      isShow: true,
      heightContent: 0,
      heightTemp: 0
    };
  },
  // watch: {
  //   printOut () {
  //     if (this.group) {
  //       return this.group + " - " + this.name
  //     }
  //     return this.name
  //   }
  // },
  // created: function () {
  //   this.item = this.submitted ? "" : this.item;
  // },
  // created: function () {
  //   this.log();
  // },
  computed: {},
  mounted: function mounted() {
    // console.log(this.height)
    this.cong();
  },
  methods: {
    cong: function cong() {
      this.heightTemp = this.listId ? document.getElementById(this.listId).offsetHeight : 0;
      this.heightContent = this.heightTemp;
    },
    show: function show() {
      // console.log('coba:',this.$refs.coba.clientHeight, ', id:',document.getElementById(this.id).offsetHeight, ' content:', this.heightContent)
      this.isShow = !this.isShow;
      this.heightContent = this.isShow ? this.heightTemp : 0;
    }
  }
});

/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\nsection[data-v-4398c4ed] {\n    width: 100%;\n    cursor: pointer;\n}\n.button[data-v-4398c4ed] {\n    background: #fff;\n    color: #262729;\n    display: flex;\n    align-items: center;\n    padding: 10px 1.25rem;\n    position: relative;\n}\n.button[data-v-4398c4ed]:hover {\n    background: rgba(5, 5, 7, 0.05);\n}\n.content[data-v-4398c4ed] {\n    display: block;\n    position: absolute;\n    top: 0;\n    left: 75px;\n    z-index: 99;\n    cursor: context-menu;\n    padding-left: 7px;\n}\n.content .value[data-v-4398c4ed] {\n    text-align: left !important;\n    display: block;\n    background: #fff;\n    width: 14em;\n    padding: 7px;\n}\n.menu[data-v-4398c4ed] {\n    font-size: 14px;\n    font-weight: 600;\n    color: #f06532;\n    text-transform: capitalize;\n}\n.expandable[data-v-4398c4ed] {\n    background: #fff;\n    overflow: hidden;\n\n    transition: all 0.2s ease-in-out;\n    height: 0;\n    margin: 0 1.75rem;\n}\n\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_style_index_0_id_4398c4ed_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css& */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_style_index_0_id_4398c4ed_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_style_index_0_id_4398c4ed_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/item/menuCollapse.vue":
/*!*******************************************************!*\
  !*** ./resources/js/components/item/menuCollapse.vue ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _menuCollapse_vue_vue_type_template_id_4398c4ed_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true& */ "./resources/js/components/item/menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true&");
/* harmony import */ var _menuCollapse_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./menuCollapse.vue?vue&type=script&lang=js& */ "./resources/js/components/item/menuCollapse.vue?vue&type=script&lang=js&");
/* harmony import */ var _menuCollapse_vue_vue_type_style_index_0_id_4398c4ed_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css& */ "./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _menuCollapse_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _menuCollapse_vue_vue_type_template_id_4398c4ed_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _menuCollapse_vue_vue_type_template_id_4398c4ed_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "4398c4ed",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/item/menuCollapse.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/item/menuCollapse.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/item/menuCollapse.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./menuCollapse.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css&":
/*!****************************************************************************************************************!*\
  !*** ./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css& ***!
  \****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_style_index_0_id_4398c4ed_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=style&index=0&id=4398c4ed&scoped=true&lang=css&");


/***/ }),

/***/ "./resources/js/components/item/menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/components/item/menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true& ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_template_id_4398c4ed_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_template_id_4398c4ed_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_menuCollapse_vue_vue_type_template_id_4398c4ed_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/item/menuCollapse.vue?vue&type=template&id=4398c4ed&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("section", [
    _c(
      "div",
      {
        staticClass: "button",
        style: _vm.isSidebar ? "" : "height: 42px ",
        on: {
          click: _vm.show,
          mouseover: function($event) {
            _vm.content = true
          },
          mouseleave: function($event) {
            _vm.content = false
          }
        }
      },
      [
        _c(
          "span",
          {
            staticClass: "material-icons-outlined nav-icon icon",
            staticStyle: { "font-size": "14px", color: "rgba(0,0,0,.2)" },
            style: _vm.routerLink ? "margin: 0 14px 0 0" : "margin: 0 10px 0 0"
          },
          [_vm._v(_vm._s(_vm.icon))]
        ),
        _vm._v(" "),
        _c("span", { staticClass: "menu menu-text" }, [
          _vm._v(_vm._s(_vm.title))
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "expandable",
        style: _vm.isSidebar
          ? { height: _vm.heightContent + "px" }
          : "height: 0"
      },
      [_vm._t("default")],
      2
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.content && !_vm.isSidebar && !_vm.routerLink,
            expression: "content && !isSidebar && !routerLink"
          }
        ],
        staticClass: "content",
        on: {
          mouseover: function($event) {
            _vm.content = true
          },
          mouseleave: function($event) {
            _vm.content = false
          }
        }
      },
      [_c("div", { staticClass: "value" }, [_vm._t("default")], 2)]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);