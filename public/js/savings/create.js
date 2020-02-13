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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/savings/create.js":
/*!****************************************!*\
  !*** ./resources/js/savings/create.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var previousId;
document.getElementById("add_savings_btn").addEventListener('click', function () {
  var saving_amount = document.getElementById("saving_amount").value;
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    data: {
      saving_amount: saving_amount
    },
    dataType: "json",
    url: savingUrl,
    success: function success(response) {
      if ($.isEmptyObject(response.error)) {
        previousId = response.saving.id;
        createRecord(response.saving, response.sum);
      } else {
        printErrorMsg(response.error);
      }
    }
  });
}); //create DOM elements

function createRecord(response, sum) {
  if (editUrl.includes(':response.id')) {
    editUrl = editUrl.replace(':response.id', response.id);
    previousId = response.id;
  } else {
    editUrl = editUrl.replace('/savings/' + previousId + '/edit', '/savings/' + response.id + '/edit');
    previousId = response.id;
  }

  var table_body = document.getElementById("saving_table");
  var table_row = document.createElement("tr"); //amount td

  var table_data_amount = document.createElement("td");
  table_data_amount.innerHTML = response.amount; //edit btn

  var btn_edit = document.createElement("a");
  btn_edit.setAttribute("href", editUrl);
  btn_edit.innerHTML = "Edit";
  btn_edit.classList.add("btn-inverse-info", "btn-fw", "btn", "m-1");
  var edit_icon = document.createElement("i");
  edit_icon.classList.add("mdi", "mdi-file-check", "btn-icon-append", "m-1");
  btn_edit.appendChild(edit_icon);
  var table_data = document.createElement("td");
  table_data.appendChild(btn_edit); //delete btn

  var btn_delete = document.createElement("button");
  btn_delete.innerHTML = "Delete";
  btn_delete.classList.add("btn-inverse-danger", "btn-fw", "btn");
  btn_delete.setAttribute("id", response.id);
  var delete_icon = document.createElement("i");
  delete_icon.classList.add("mdi", "mdi-delete", "btn-icon-append", "m-1");
  btn_delete.appendChild(delete_icon); //let table_data_delete = document.createElement("td");

  table_data.appendChild(btn_delete); //Error div

  var errorDiv = document.createElement('div');
  errorDiv.classList.add('alert', 'alert-danger', 'print-error-msg-sub');
  errorDiv.style.display = 'none';
  var errorUl = document.createElement('ul');
  errorDiv.appendChild(errorUl); //total savings

  var total = document.getElementById("total");
  total.innerHTML = sum + "EGP";
  table_row.appendChild(table_data_amount);
  table_row.appendChild(table_data);
  table_body.appendChild(table_row); //delete with ajax

  var isRefreshed = true;
  confirmDelete(btn_delete, response.id, isRefreshed);
} //delete fn


function confirmDelete(btn_delete, id, isRefreshed) {
  if (isRefreshed) {
    btn_delete.addEventListener("click", function () {
      excuteDelete(btn_delete, id);
    });
  } else {
    excuteDelete(btn_delete, id);
  }
}

function excuteDelete(btn_delete, id) {
  if (delurl.includes(':saving.id')) {
    delurl = delurl.replace(':saving.id', id);
    previousId = id;
  } else {
    delurl = delurl.replace('/savings/' + previousId, '/savings/' + id);
    previousId = id;
  }

  ajaxDelete(btn_delete, delurl);
} //print error msg


function printErrorMsg(msg) {
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").css('display', 'block');
  $.each(msg, function (key, value) {
    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
  });
  setTimeout(function () {
    $(".print-error-msg").css('display', 'none');
  }, 4000);
}

/***/ }),

/***/ 7:
/*!**********************************************!*\
  !*** multi ./resources/js/savings/create.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\Personal_Financial_Assisstant\resources\js\savings\create.js */"./resources/js/savings/create.js");


/***/ })

/******/ });