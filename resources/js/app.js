require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2');

window.CEP = require('./app/cep');
window.Form = require('./app/form');
window.Util = require('./app/util');

window.Cliente = require('./app/cliente');
window.Produto = require('./app/produto');
window.Pedido = require('./app/pedido');

window.$(document).ready(function(){
    Form.default.iniciar();
});