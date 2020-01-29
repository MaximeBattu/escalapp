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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// disable succes or error message after 4s
setTimeout(function () {
  $('#adminAccessError').fadeOut();
  $('#addSuccessRoom').fadeOut();
  $('#administratorRight').fadeOut();
  $('#profileModification').fadeOut();
}, 4000);
var DISPLAY_NONE = 'd-none';
document.addEventListener('DOMContentLoaded', function () {
  /**
   * @param {object} room
   * @param {number} room.id
   * @param {string} room.name
   * @param {string} room.address
   * @param {string} room.email
   *
   * @return {Promise}
   */
  function updateRoom(room) {
    return $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/admin/gestion-salles/modifier/route/".concat(room.id),
      type: 'PUT',
      data: JSON.stringify({
        name: room.name,
        email: room.email,
        address: room.address
      })
    });
  }

  $('.updatable-field').on('dblclick', function (e) {
    var $td = $(this);
    $td.next().children('.field-update').val($td.html());
    $td.addClass(DISPLAY_NONE);
    $td.next().removeClass(DISPLAY_NONE);
  });
  $(document).on('keydown', '.field-update', function (e) {
    if (e.keyCode === 13) {
      var $input = $(this);
      var newValue = $input.val();
      var $td = $input.parent();
      $td.addClass(DISPLAY_NONE);
      $td.prev().removeClass(DISPLAY_NONE);
      $td.prev().html(newValue);
      var $tr = $td.parent();
      var id = $tr.find('.room-id').html();
      var name = $tr.find('.room-name').html();
      var email = $tr.find('.room-email').html();
      var address = $tr.find('.room-address').html();
      updateRoom({
        id: id,
        name: name,
        email: email,
        address: address
      }).then(function (res) {
        return console.log(res);
      })["catch"](function (err) {
        console.error(err);
      });
      /* .then(res => {
       console.log('success')
      }).catch(console.error)*/
    }
  });
  var body = document.querySelector('body');
  var images = document.querySelectorAll("#image");
  var div = create('div', null, body);
  var imageDiv = create("div", null, body, null, "centerImage");
  var centerImage = document.querySelector("#centerImage");
  console.log(images);
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    var _loop = function _loop() {
      var image = _step.value;
      image.addEventListener('click', function () {
        console.log(image.style.borderColor);
        div.classList.toggle("transparentDiv");
        imageDiv.classList.toggle("imageCenter");
        imageDiv.style.background = "url('" + image.src + "')";
        imageDiv.style.border = "3px solid " + image.style.borderColor;
        imageDiv.style.opacity = "1";
        console.log(image.classList);
      });
      div.addEventListener('click', function () {
        div.classList.remove("transparentDiv");
        imageDiv.classList.remove("imageCenter");
        imageDiv.style.background = null;
        centerImage.style.border = "none";
      });
      centerImage.addEventListener('click', function () {
        div.classList.remove("transparentDiv");
        imageDiv.classList.remove("imageCenter");
        imageDiv.style.background = null;
        centerImage.style.border = "none";
      });
    };

    for (var _iterator = images[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      _loop();
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator["return"] != null) {
        _iterator["return"]();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  var contest = document.querySelector("#contest");
  var open = document.querySelector("#open");
  var close = document.querySelector("#closeContest");
  var escalapp = document.querySelector(".escalapp");
  var roomsuccess = document.querySelectorAll(".roomsuccess");
  var scores = document.querySelectorAll(".score");
  var _iteratorNormalCompletion2 = true;
  var _didIteratorError2 = false;
  var _iteratorError2 = undefined;

  try {
    for (var _iterator2 = roomsuccess[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
      var title = _step2.value;
      title.addEventListener("click", function () {
        var _iteratorNormalCompletion3 = true;
        var _didIteratorError3 = false;
        var _iteratorError3 = undefined;

        try {
          for (var _iterator3 = scores[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
            var score = _step3.value;
            score.style.display = "block";
          }
        } catch (err) {
          _didIteratorError3 = true;
          _iteratorError3 = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion3 && _iterator3["return"] != null) {
              _iterator3["return"]();
            }
          } finally {
            if (_didIteratorError3) {
              throw _iteratorError3;
            }
          }
        }
      });
    }
  } catch (err) {
    _didIteratorError2 = true;
    _iteratorError2 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
        _iterator2["return"]();
      }
    } finally {
      if (_didIteratorError2) {
        throw _iteratorError2;
      }
    }
  }

  open.addEventListener("click", function () {
    contest.style.left = "0";
    open.style.left = "-5vw";
    close.style.left = "13vw";
    escalapp.style.marginLeft = "10%";
  });
  close.addEventListener("click", function () {
    contest.style.left = "-13vw";
    close.style.left = "-2vw";
    open.style.left = "0";
    escalapp.style.marginLeft = null;
  });
});

function create(tag, text, parent) {
  var classs = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  var id = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
  var o = document.createElement(tag);

  if (text != null) {
    o.appendChild(document.createTextNode(text));
  }

  if (classs != null) {
    o.classList.add(classs);
  }

  if (id != null) {
    o.id = id;
  }

  parent.appendChild(o);
  return o;
}

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/main.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! F:\Users\Maxime BATTU\Desktop\code\escalapp\resources\js\main.js */"./resources/js/main.js");


/***/ })

/******/ });