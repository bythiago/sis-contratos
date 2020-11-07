require('./bootstrap');

window.Vue = require('vue');

Vue.component('produtos-table-component', require('./components/ProdutoComponent.vue').default);

const app = new Vue({
    el: '#app',
});
