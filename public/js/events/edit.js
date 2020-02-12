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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/events/edit.js":
/*!*************************************!*\
  !*** ./resources/js/events/edit.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var oldSubEventId;

window.editEvent = function (mainEventUrl) {
  var customCategoryName = document.getElementById('customCategoryName').value;
  var customCategoryDate = document.getElementById('customCategoryDate').value;
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: mainEventUrl,
    data: {
      'customCategoryName': customCategoryName,
      'customCategoryDate': customCategoryDate
    },
    type: 'PUT',
    success: function success(response) {
      ensureResponse(response);
    }
  });
};

function ensureResponse(isEdited) {
  if (isEdited) {
    document.getElementById('categorySuccess').style.display = 'block';
    setTimeout(function () {
      document.getElementById('categorySuccess').style.display = 'none';
    }, 2000);
  }
}

var addSubEventBtn = document.getElementById('addSubEvent');
addSubEventBtn.addEventListener('click', function () {
  var subCategoryName = document.getElementById('subCategoryName');
  var subCategoryAmount = document.getElementById('subEventAmount');
  var categoryId = document.getElementById('customEventCategory').value;
  sendSubCategory(subCategoryName, subCategoryAmount, categoryId);
});

window.sendSubCategory = function (subName, amount, categoryId) {
  var subCategoryInfo = {
    'subName': subName.value,
    'amount': amount.value,
    'categoryId': categoryId
  };
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: urlSubCategory,
    type: 'POST',
    data: subCategoryInfo,
    success: function success(response) {
      //create information record about the event 
      if ($.isEmptyObject(response.error)) {
        alert(response.success);
        createEventInfoRecordForUpdate(response.data, response.isUpdated);
      } else {
        printErrorMsg(response.error, 'sub');
      }
    }
  });
};

function createEventInfoRecordForUpdate(eventData, isUpdated) {
  var table_body = document.getElementById('event_table_body');

  if (isUpdated) {
    table_body.querySelectorAll('input').forEach(function (element) {
      if (element.value == eventData.name) {
        element.parentElement.parentElement.querySelector("td input[name='amount']").value = eventData.amount;
      }
    });
  } else {
    var table_row = document.createElement("tr");
    var table_data_amount = document.createElement("td");
    var table_data_amount_input = document.createElement('input');
    table_data_amount_input.setAttribute('type', 'number');
    table_data_amount_input.setAttribute('name', 'amount');
    table_data_amount_input.classList.add('form-control');
    table_data_amount_input.setAttribute('step', '0.01');
    table_data_amount_input.value = eventData.amount;
    var table_data_event_type = document.createElement("td");
    var table_data_event_type_input = document.createElement('input');
    table_data_event_type_input.classList.add('form-control');
    table_data_event_type_input.setAttribute('type', 'text');
    table_data_event_type_input.setAttribute('name', 'customSubCategoryName');
    table_data_event_type_input.value = eventData.name;
    var editBtn = document.createElement('button');
    editBtn.classList.add('btn', 'btn-gradient-danger', 'btn-fw');
    editBtn.innerHTML = "Edit Sub-Event";
    var successTd = document.createElement('td');
    var successChiledDiv = document.createElement('div');
    successChiledDiv.classList.add('alert', 'alert-success');
    successChiledDiv.setAttribute('id', 'subCategorySuccess');
    successChiledDiv.setAttribute('role', 'alert');
    successChiledDiv.setAttribute('style', 'display:none');
    successChiledDiv.innerHTML = "The Sub-Event Successfully Updated";
    successTd.appendChild(successChiledDiv);
    table_data_amount.appendChild(table_data_amount_input);
    table_data_event_type.appendChild(table_data_event_type_input);
    table_row.appendChild(table_data_event_type);
    table_row.appendChild(table_data_amount);
    table_row.appendChild(editBtn);
    table_row.appendChild(successTd);
    table_body.appendChild(table_row);
    editBtn.addEventListener('click', function () {
      // will be in the edit.js
      editSubEvent(editBtn, eventData.id);
    });
  }

  document.getElementById('subCategoryName').value = "";
  document.getElementById('subEventAmount').value = "";
}

window.editSubEvent = function (chiledElement, subEventId) {
  var customSubCategoryName = '';
  var customSubCategoryAmount = 0;
  var subCategoryName = chiledElement.parentElement.parentElement.querySelector('td input[name="customSubCategoryName"]');
  var subCategoryAmount = chiledElement.parentElement.parentElement.querySelector('td input[name="amount"]');
  customSubCategoryName = subCategoryName.value;
  customSubCategoryAmount = subCategoryAmount.value;
  setUrl(subEventId);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: subEventUrl,
    type: 'PUT',
    data: {
      'customSubCategoryName': customSubCategoryName,
      'customSubCategoryAmount': customSubCategoryAmount
    },
    success: function success(response) {
      renderSuccess(response, chiledElement);
    }
  });
};

function renderSuccess(isStored, chiledElement) {
  if (isStored) {
    chiledElement.parentElement.querySelector('#subCategorySuccess').style.display = 'block';
    setTimeout(function () {
      chiledElement.parentElement.querySelector('#subCategorySuccess').style.display = 'none';
    }, 2000);
  }
}

function setUrl(id) {
  if (subEventUrl.includes(':customSubCategoryId')) {
    subEventUrl = subEventUrl.replace(':customSubCategoryId', id);
    oldSubEventId = id;
  } else {
    subEventUrl = subEventUrl.replace('/SubEvents/' + oldSubEventId + '/update', '/SubEvents/' + id + '/update');
    oldSubEventId = id;
  }
}

/***/ }),

/***/ 4:
/*!*******************************************!*\
  !*** multi ./resources/js/events/edit.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/amrsamy/Desktop/Financial_Assistant/Personal_Financial_Assisstant/resources/js/events/edit.js */"./resources/js/events/edit.js");


/***/ })

/******/ });