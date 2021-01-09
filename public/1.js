(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./public/js/cep.js":
/*!**************************!*\
  !*** ./public/js/cep.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

CEP = {
  consulta: function () {
    var _consulta = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(input) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              input.on('blur', function (event) {
                CEP.valida($(this).val().replace(/\D/g, ''));
              });

            case 1:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    function consulta(_x) {
      return _consulta.apply(this, arguments);
    }

    return consulta;
  }(),
  valida: function valida(cep) {
    var validacep = /^[0-9]{8}$/;

    if (validacep.test(cep)) {
      CEP.popula(cep);
    }

    return false;
  },
  busca: function busca(cep) {
    return new Promise(function (resolve) {
      setTimeout(function () {
        resolve(fetch("https://viacep.com.br/ws/".concat(cep, "/json")));
      }, 500);
    });
  },
  objeto: function objeto() {
    return {
      cep: $("#cep"),
      rua: $("#rua"),
      bairro: $("#bairro"),
      cidade: $("#cidade"),
      uf: $("#uf")
    };
  },
  popula: function () {
    var _popula = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(cep) {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              Util.processing();
              _context2.next = 3;
              return CEP.busca(cep).then(function (response) {
                response.json().then(function (data) {
                  CEP.objeto().rua.val(data.logradouro);
                  CEP.objeto().bairro.val(data.bairro);
                  CEP.objeto().cidade.val(data.localidade);
                  CEP.objeto().uf.val(data.uf);
                });
              }).then(function () {
                Util.hideAll();
              });

            case 3:
              return _context2.abrupt("return", _context2.sent);

            case 4:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }));

    function popula(_x2) {
      return _popula.apply(this, arguments);
    }

    return popula;
  }()
};

/***/ })

}]);