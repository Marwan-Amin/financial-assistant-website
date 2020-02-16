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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/targets/create.js":
/*!****************************************!*\
  !*** ./resources/js/targets/create.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var oldDeletedId, oldEditedId; // document.getElementById("add_target_btn").addEventListener('click',function(){
//   let target_amount = document.getElementById("target_amount").value;
//   let target_name = document.getElementById("target_name").value;
//   $.ajax({
//     headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//     type:"POST",
//     data : {target_amount , target_name},
//     dataType : "json",
//     url :storeTargetUrl,
//     success : function (response){
//       if($.isEmptyObject(response.error)){
//         createRecord(response.targetData);
//       }else{
//         printErrorMsg(response.error);
//       } 
//     }
//     ,
//     error : function (error){
//       // alert(error)
//     }
//   });
// });
//create DOM elements

function createRecord(response) {
  if (editTargetUrl.includes(':response.id')) {
    editTargetUrl = editTargetUrl.replace(':response.id', response.id);
    oldEditedId = response.id;
  } else {
    editTargetUrl = editTargetUrl.replace('/targets/' + oldEditedId + '/edit', '/targets/' + response.id + '/edit');
    oldEditedId = response.id;
  }

  var table_body = document.getElementById("tableDiv");
  var element = table_body.querySelector('tr td.dataTables_empty');

  if (element) {
    element.parentElement.remove();
  }

  table_body.querySelectorAll('div h4').forEach(function (element) {
    element.parentElement.remove();
  });
  var table_row = document.createElement("tr");
  table_row.setAttribute('role', 'row'); //target amount

  var table_data_target = document.createElement("td");
  table_data_target.classList.add('column1');
  table_data_target.innerHTML = response.target_name;
  table_data_target.style = "text-align: left; padding-left: 20px;"; //target name

  var table_data_amount = document.createElement("td");
  table_data_amount.classList.add('sorting_1');
  table_data_amount.innerHTML = response.target_amount; //progress 

  var table_data_progress = document.createElement("td");
  var progressBig_div = document.createElement('div');
  progressBig_div.classList.add('progress');
  progressBig_div.style = "height:20px; position:relative; text-align:center;";
  var progress_div = document.createElement('div');
  progress_div.setAttribute('role', 'progressbar');
  var span = document.createElement('span');
  span.setAttribute('style', 'position: absolute;left: 40%; top:3px; color:darkslateblue');

  if (response.progress >= 100) {
    table_data_amount.style = "font-weight:bold";
    table_data_target.style = "font-weight:bold";
    table_data_target.style = "text-align: left; padding-left: 20px;";
    span.innerHTML = 100 + '%';
    progressBig_div.classList.add('bg-success');
    progress_div.classList.add('progress-bar', 'progress-bar-striped', 'progress-bar-animated', 'bg-warning');
  } else {
    progress_div.style.width = response.progress + '%';
    span.innerHTML = Math.floor(response.progress * 100) / 100 + '%';
    progress_div.classList.add('progress-bar', 'progress-bar-striped', 'progress-bar-animated', 'bg-warning');
  }

  table_data_progress.appendChild(progressBig_div);
  progressBig_div.appendChild(progress_div);
  progressBig_div.appendChild(span); //edit btn

  var table_data = document.createElement("td");
  var btn_edit = document.createElement("a");
  btn_edit.setAttribute("href", editTargetUrl);
  btn_edit.classList.add("btn-inverse-info", "btn-fw", "btn", "m-1");
  btn_edit.innerHTML = "Edit";
  var edit_icon = document.createElement("i");
  edit_icon.classList.add("mdi", "mdi-file-check", "btn-icon-append", "m-1");
  btn_edit.appendChild(edit_icon);
  table_data.appendChild(btn_edit); //del btn

  var btn_delete = document.createElement("button");
  btn_delete.innerHTML = "Delete";
  btn_delete.setAttribute('type', 'submit');
  btn_delete.classList.add("btn-inverse-danger", "btn-fw", "btn");
  var delete_icon = document.createElement("i");
  delete_icon.classList.add("mdi", "mdi-delete", "btn-icon-append", "m-1");
  btn_delete.appendChild(delete_icon);
  var form = document.createElement('form');
  form.setAttribute('method', 'post');
  form.setAttribute('action', "/targets/".concat(response.id));
  form.classList.add('d-inline');
  var hiddenInputCsrf = document.createElement('input');
  hiddenInputCsrf.setAttribute('type', 'hidden');
  hiddenInputCsrf.setAttribute('name', '_token');
  hiddenInputCsrf.value = csrf;
  var hiddenInputMethod = document.createElement('input');
  hiddenInputMethod.setAttribute('type', 'hidden');
  hiddenInputMethod.value = 'DELETE';
  hiddenInputMethod.setAttribute('name', '_method');
  form.appendChild(hiddenInputCsrf);
  form.appendChild(hiddenInputMethod);
  form.appendChild(btn_delete);
  table_data.appendChild(form); //Error div

  var errorDiv = document.createElement('div');
  errorDiv.classList.add('alert', 'alert-danger', 'print-error-msg-sub');
  errorDiv.style.display = 'none';
  var errorUl = document.createElement('ul');
  errorDiv.appendChild(errorUl);
  table_row.appendChild(table_data_target);
  table_row.appendChild(table_data_amount);
  table_row.appendChild(table_data_progress);
  table_row.appendChild(table_data);
  table_body.appendChild(table_row);
  var elements = table_body.querySelectorAll('tr');

  if (elements.length % 2 == 0) {
    elements[elements.length - 1].classList.add('even');
  } else {
    elements[elements.length - 1].classList.add('odd');
  }

  var isAjax = true; //delete with ajax
  // ajaxUrl(btn_delete,response.id,isAjax);
} //delete fn


window.ajaxUrl = function (btn_delete, target_id, isAjax) {
  if (isAjax) {
    btn_delete.addEventListener("click", function () {
      setUrl(target_id);
      ajaxDelete(btn_delete, deleteTargetUrl);
    });
  } else {
    setUrl(target_id);
    ajaxDelete(btn_delete, deleteTargetUrl);
  }
};

function setUrl(id) {
  if (deleteTargetUrl.includes(':target.id')) {
    deleteTargetUrl = deleteTargetUrl.replace(':target.id', id);
  } else {
    deleteTargetUrl = deleteTargetUrl.substring(0, deleteTargetUrl.indexOf('/targets/')) + '/targets/' + id;
  }
}

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

/***/ 10:
/*!**********************************************!*\
  !*** multi ./resources/js/targets/create.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/amrsamy/Desktop/Financial_Assistant/Personal_Financial_Assisstant/resources/js/targets/create.js */"./resources/js/targets/create.js");


/***/ })

/******/ });