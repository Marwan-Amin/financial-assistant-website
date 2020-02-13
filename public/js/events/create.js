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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/events/create.js":
/*!***************************************!*\
  !*** ./resources/js/events/create.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var addEvent = document.getElementById('addEvent');

if (addEvent) {
  addEvent.addEventListener('click', function () {
    var eventName = document.getElementById('category').value;
    var eventDate = document.getElementById('date').value;

    if (
    /*(eventName && eventName != "") &&(eventDate && eventDate!="")*/
    true) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: urlEvent,
        data: {
          'eventName': eventName,
          'eventDate': eventDate
        },
        success: function success(response) {
          if ($.isEmptyObject(response.error)) {
            renderResponse(response);
          } else {
            printErrorMsg(response.error, 'event');
          }
        }
      });
    }
  });
} //render the inputs needed for the event that user has entered


function renderResponse(data) {
  if (data.isStored) {
    var eventActionContainer = document.getElementById('eventActionButtons'); //set the href for the edit anchor tag 

    editHref = editHref.replace(':data.categoryId', data.categoryId);
    var editEvent = document.createElement('a');
    editEvent.innerHTML = 'Edit Event';
    editEvent.setAttribute('href', editHref);
    editEvent.setAttribute('class', "btn btn-gradient-success"); //create anchor tag for create new event

    var _addEvent = document.createElement('a');

    _addEvent.setAttribute('href', addEventHref);

    _addEvent.innerHTML = "Add Event";

    _addEvent.setAttribute('class', "btn btn-gradient-success"); //append the anchor tags into the eventActionContainer Div


    eventActionContainer.appendChild(editEvent);
    eventActionContainer.appendChild(_addEvent); //create input and set event name into that input 

    var eventName = document.createElement('input');
    eventName.setAttribute('type', 'text');
    document.getElementById('subCategoryNameLabel').innerHTML = 'Event Expense'; //create input and set event amount into that input 

    var eventSubCategoryAmount = document.createElement('input');
    eventSubCategoryAmount.setAttribute('type', 'number');
    eventSubCategoryAmount.setAttribute('step', '0.01');
    document.getElementById('subCategoryAmountLabel').innerHTML = 'Amount';
    var errorDiv = document.createElement('div');
    errorDiv.classList.add('alert', 'alert-danger', 'print-error-msg-sub');
    errorDiv.style.display = 'none';
    var errorUl = document.createElement('ul');
    errorDiv.appendChild(errorUl); //create add custom sub expents button

    var addSubCategoryButton = document.createElement('button');
    addSubCategoryButton.innerHTML = "Add Sub-Expense";
    addSubCategoryButton.setAttribute('class', "btn btn-gradient-success"); // append the rest of the elements

    var subCategoryNameParent = document.getElementById('subCategoryName');
    subCategoryNameParent.appendChild(eventName);
    var subCategoryAmountParent = document.getElementById('subCategoryAmount');
    subCategoryAmountParent.appendChild(eventSubCategoryAmount);
    subCategoryAmountParent.appendChild(errorDiv); //disabled the input and add button of event after the user enter one to stop him of enter more than one event at a time

    document.getElementById('addEvent').disabled = true;
    document.getElementById('category').disabled = true;
    document.getElementById('date').disabled = true;
    document.getElementById('buttonSubCategory').appendChild(addSubCategoryButton); // this function will store custoSubCategory By Ajax and it will send data and elements needed to support this operation

    subCategoryAjax(addSubCategoryButton, eventName, eventSubCategoryAmount, data.categoryId);
  }
}

function subCategoryAjax(addButton, subName, amount, categoryId) {
  addButton.addEventListener('click', function () {
    //check if the three fields is full and not empty and if it is it will alert an error
    sendSubCategoryAjax(subName, amount, categoryId);
  });
}

window.sendSubCategoryAjax = function (subName, amount, categoryId) {
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
        createEventInfoRecord(response.data, response.isUpdated);
      } else {
        printErrorMsg(response.error, 'sub');
      }
    }
  });
};

function createEventInfoRecord(eventData, isUpdated) {
  var table_body = document.getElementById('event_table_body');

  if (isUpdated) {
    table_body.querySelectorAll('td').forEach(function (element) {
      if (element.innerHTML == eventData.name) {
        element.nextSibling.innerHTML = eventData.amount + " EGP";
      }
    });
  } else {
    var table_row = document.createElement("tr");
    var table_data_amount = document.createElement("td");
    table_data_amount.innerHTML = eventData.amount + " EGP";
    var table_data_event_type = document.createElement("td");
    table_data_event_type.innerHTML = eventData.name;
    table_row.appendChild(table_data_event_type);
    table_row.appendChild(table_data_amount);
    table_body.appendChild(table_row);
  }

  document.getElementById('subCategoryName').querySelector('input').value = "";
  document.getElementById('subCategoryAmount').querySelector('input').value = "";
}

function printErrorMsg(msg, type) {
  var typeClass = '';

  if (type == 'event') {
    typeClass = 'msg';
  } else {
    typeClass = 'msg-sub';
  }

  $(".print-error-" + typeClass).find("ul").html('');
  $(".print-error-" + typeClass).css('display', 'block');
  $.each(msg, function (key, value) {
    $(".print-error-" + typeClass).find("ul").append('<li>' + value + '</li>');
  });
  setTimeout(function () {
    $(".print-error-" + typeClass).css('display', 'none');
  }, 2000);
}

/***/ }),

/***/ 3:
/*!*********************************************!*\
  !*** multi ./resources/js/events/create.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/amrsamy/Desktop/Financial_Assistant/Personal_Financial_Assisstant/resources/js/events/create.js */"./resources/js/events/create.js");


/***/ })

/******/ });