(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./public/js/form.js":
/*!***************************!*\
  !*** ./public/js/form.js ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  Form.iniciar();
});
Form = {
  autocomplete: function autocomplete(input) {
    input.select2({
      ajax: {
        url: input.data('href'),
        dataType: "json",
        processResults: function processResults(data) {
          return {
            results: data.results
          };
        }
      },
      minimumInputLength: 3,
      allowClear: true,
      placeholder: "".concat(input.data('placeholder')),
      theme: 'bootstrap4'
    });
  },
  select2: function select2(input) {
    input.select2({
      theme: 'bootstrap4'
    });
  },
  validation: function validation(input) {
    return input.validate({
      errorElement: 'span',
      errorPlacement: function errorPlacement(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function highlight(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function unhighlight(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  },
  readonly: function (_readonly) {
    function readonly() {
      return _readonly.apply(this, arguments);
    }

    readonly.toString = function () {
      return _readonly.toString();
    };

    return readonly;
  }(function () {
    if (typeof readonly != 'undefined' && readonly.length > 0) {
      $("form :input").attr("disabled", true);
    }
  }),
  iniciar: function iniciar() {
    Form.readonly();
  }
};

/***/ })

}]);