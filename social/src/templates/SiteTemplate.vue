<template>
  <span>
    <header>
      <nav-bar logo="Social" url="/" cor="green darken-1">
          <li><router-link to="/">Home</router-link></li>
          <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
          <li v-if="!usuario"><router-link to="/cadastro">Cadastre-se</router-link></li>
          <li v-if="usuario"><router-link to="/perfil">{{usuario.name}}</router-link></li>
          <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
      </nav-bar>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <grid-vue tamanho="4">
            <card-menu-vue>
              <slot name="menuesquerdo" />
            </card-menu-vue>
            <card-menu-vue>
              <h3>Amigos</h3>
              <li>Murilo</li>
              <li>Gustavo</li>
            </card-menu-vue>
          </grid-vue>
          <grid-vue tamanho="8">
            <!-- Conteúdo do template que vem da Home -->
            <slot name="principal"/>
          </grid-vue>
        </div>
      </div>
    </main>

    <footer-vue cor="green darken-1" logo="Social" descricao="Teste de descrição">
      <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
    </footer-vue>







  </span>
</template>

<script>

import NavBar from '@/components/layouts/NavBar'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
  name: 'SiteTemplate',

  data(){
    return {
      usuario:false
    }
  },
  components:{
    NavBar,
    FooterVue,
    GridVue,
    CardMenuVue,
  },
  //este método é executado quando o componente é criado
  created() {
    console.log('created()');
    //criando uma variável e pegando ela pela session pelo Vuex definido social\src\main.js
    let usuarioAux = this.$store.getters.getUsuario;
    if(usuarioAux){
      this.usuario = this.$store.getters.getUsuario;
    }else{
      this.$router.push('/login');
    }
  },
  methods: {
    sair(){
      //abaixo uso o método do Vuex para setar usuario como null
      this.$store.commit('setUsuario', null);
      //limpar a sessão do storange no browser
      sessionStorage.clear();
      this.usuario = false;
      //redirecionando para a tela de login
      this.$router.push('/login');
    }
  },
}
</script>

<style>

</style>
