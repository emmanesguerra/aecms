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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./core/Layouts/assets/js/admin/content/content-ext.js":
/*!*************************************************************!*\
  !*** ./core/Layouts/assets/js/admin/content/content-ext.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

proccessdata = function proccessdata(id, method) {
  axios({
    method: method,
    url: contentindexurl + '/' + id
  }).then(function (response) {
    window.contentformvue.model = response.data;
    window.contentformvue.errors = [];
    $('#formtab').tab('show');
    proccessnoti({
      data: {
        title: 'Action Completed',
        message: 'This page id #' + id + ' has been retreived and ready to be updated <br />',
        icon: 'icon glyphicon glyphicon-info-sign',
        type: 'info'
      },
      statusText: ''
    });
  })["catch"](function (error) {
    if (error.response) {
      proccessnoti(error);
    }
  });
};

showmodal = function showmodal(id) {
  content_id = id;
  $('#idtobedeleted').html(id);
  $('#modal-danger').modal('show');
};

contenttable = $('#contentlists').DataTable({
  processing: true,
  "ajax": contentdataurl,
  "aaSorting": [],
  "columns": [{
    "data": "id"
  }, {
    "data": "name"
  }, {
    render: function render(data, type, full) {
      if (full.type == 'M') {
        return 'Main';
      } else {
        return 'Panel';
      }
    }
  }, {
    render: function render(data, type, full) {
      var page = '';

      _.each(full.pages, function (data) {
        page += page == '' ? data.name : ', ' + data.name;
      });

      return page;
    }
  }, {
    "data": "created_at"
  }, {
    "data": "updated_at"
  }, {
    width: "5%",
    bSearchable: false,
    bSortable: false,
    mRender: function mRender(data, type, full) {
      return '<button onclick="proccessdata(' + full.id + ', `get`)" class="btn btn-primary btn-xs"><i class="fa fa-pencil "></i></button>';
    }
  }]
});
filetable = $('#filelists').DataTable({
  processing: true,
  "ajax": filedata + '/active',
  "aaSorting": [],
  "columns": [{
    mRender: function mRender(data, type, full) {
      if (full.extension == 'jpg' || full.extension == 'png' || full.extension == 'gif') {
        return '<img src="' + full.path + '" width="250" />';
      } else {
        return '<i class="fa fa-file" style="font-size: 100px">';
      }
    }
  }, {
    "data": "path"
  }]
});

/***/ }),

/***/ 9:
/*!*******************************************************************!*\
  !*** multi ./core/Layouts/assets/js/admin/content/content-ext.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! c:\xampp\htdocs\aecms\core\Layouts\assets\js\admin\content\content-ext.js */"./core/Layouts/assets/js/admin/content/content-ext.js");


/***/ })

/******/ });