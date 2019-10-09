// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
//Aqui importo os arquivos que serão carregados para todo o projeto, pois essa é a página principal
import Vue from 'vue'
import App from './App'
import router from './router'
import axios from 'axios'
import Vuex from 'vuex'
Vue.use(Vuex)

Vue.config.productionTip = false
//definindo uma instância do Axios para acessar em qualquer parte do Vue
Vue.prototype.$http = axios
//Definindo uma instância para o caminho da API
Vue.prototype.$urlAPI = 'http://127.0.0.1:8000/api/'

//utilizando Vuex
var store = {
  state:{
    //coloquei uma condição de valores dentro da variável
    //sessionStorage.getItem('usuario') pegando valor do usuário pela sessão no browser
    usuario: sessionStorage.getItem('usuario') ? JSON.parse(sessionStorage.getItem('usuario')) : null
  },
  //listas
  getters:{
    getUsuario: state => {
      return state.usuario;
    },
    getToken: state =>{
      return state.usuario.token;
    }
  },
  //métodos para modificação do status
  mutations:{
    setUsuario(state, n){
      state.usuario = n;
    },
  }
}




/* eslint-disable no-new */
new Vue({
  el: '#app',
  store: new Vuex.Store(store),
  router,
  components: { App },
  template: '<App/>'
})
