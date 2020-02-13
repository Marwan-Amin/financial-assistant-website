/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/expenses/create.js":
/*!*****************************************!*\
  !*** ./resources/js/expenses/create.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// hold the base value of the dropDownList of countries
var previousValue;
document.getElementById('selectCategory').querySelectorAll('div input').forEach(function (element) {
  element.addEventListener('change', function () {
    //     
    var categoryId = this.value;

    if (url.includes(':categoryId')) {
      url = url.replace(':categoryId', categoryId);
    } else {
      url = url.replace('ajax/' + previousValue, 'ajax/' + categoryId);
    } // check if the previous or base value is not equal the value changed because if it's the same value then no need to make ajax request as the value desn't changed


    if (previousValue != this.value) {
      $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function success(data) {
          //  function to render the data of the response 
          if (data) {
            renderSubCategories(data);
          } else {
            alert('Something Went Wrong Please Refresh The Page');
          }
        }
      });
      previousValue = categoryId;

      if (this.value == "Others") {
        // i send it to render and don't stop it as i will check there if it's empty and if it is i will create option tag element with no country was selected
        renderSubCategories("others");
      }
    }
  });
});

function renderSubCategories(subCategories) {
  var selectModal = document.getElementById('subCategoriesIcons');

  if (subCategories) {
    selectModal.innerHTML = '';

    if (subCategories != "others") {
      for (var i = 0; i < subCategories.length; i++) {
        var divBox = document.createElement('div');
        var spanName = document.createElement('span');
        spanName.innerHTML = subCategories[i].name;
        divBox.classList.add('cat-box');
        var divIcon = document.createElement('div');
        divIcon.classList.add('glyph-icon', subCategories[i].sub_category_icon);
        var label = document.createElement('label');
        label.setAttribute('for', subCategories[i].name);
        var radioItem = document.createElement('input');
        radioItem.setAttribute('type', 'radio');
        radioItem.setAttribute('name', 'subCategory');
        radioItem.setAttribute('id', subCategories[i].name);
        radioItem.value = subCategories[i].id;
        label.appendChild(divIcon);
        label.appendChild(spanName);
        divBox.appendChild(radioItem);
        divBox.appendChild(label);
        selectModal.appendChild(divBox);
      }
    } else {
      var _divBox = document.createElement('div');

      _divBox.classList.add('cat-box');

      var _label = document.createElement('label');

      _label.innerHTML = 'Others';
      var input = document.createElement('input');
      input.setAttribute('type', 'text');
      input.setAttribute('name', 'subCategory');
      input.classList.add('form-control');
      selectModal.appendChild(_divBox);

      _divBox.appendChild(_label);

      _divBox.appendChild(input);
    }
  }
}

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/expenses/create.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/marwan/Desktop/Personal_Financial_Assisstant/resources/js/expenses/create.js */"./resources/js/expenses/create.js");


/***/ })

/******/ });