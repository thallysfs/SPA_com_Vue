// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
//Aqui importo os arquivos que serão carregados para todo o projeto, pois essa é a página principal
import Vue from 'vue'
import App from './App'
import router from './router'
import axios from 'axios'

Vue.config.productionTip = false
//definindo uma instância do Axios para acessar em qualquer parte do Vue
Vue.prototype.$http = axios
//Definindo uma instância para o caminho da API
Vue.prototype.$urlAPI = 'http://127.0.0.1:8000/api/'

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
