(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[3],{

/***/ "./public/js/util.js":
/*!***************************!*\
  !*** ./public/js/util.js ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports) {

Util = {
  processing: function processing() {
    bootbox.dialog({
      message: '<div class="text-center"><i class="fas fa-cog fa-spin"></i> Processando</div>',
      closeButton: false
    });
  },
  hideAll: function hideAll() {
    return new Promise(function (resolve) {
      setTimeout(function () {
        resolve(bootbox.hideAll());
      }, 100);
    });
  },
  formatarPalavras: function formatarPalavras(input) {
    $(input).on("keyup", function () {
      var palavra = input.val();
      palavra = Util.retirarCaracteresEspeciais(palavra);
      input.val(palavra);
    });
  },
  retirarCaracteresEspeciais: function retirarCaracteresEspeciais(palavra) {
    palavra = this.substituirAcentos(palavra);
    palavra = palavra.replace(/[^a-zA-Z 0-9]/g, '');
    return palavra;
  },
  substituirAcentos: function substituirAcentos(palavra) {
    var com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ';
    var sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
    var nova = '';

    for (var i = 0; i < palavra.length; i++) {
      if (com_acento.search(palavra.substr(i, 1)) >= 0) {
        nova += sem_acento.substr(com_acento.search(palavra.substr(i, 1)), 1);
      } else {
        nova += palavra.substr(i, 1);
      }
    }

    return nova;
  }
};

/***/ })

}]);