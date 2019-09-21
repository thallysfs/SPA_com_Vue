<template>
  <span>
    <header>
      <nav-bar logo="Social" url="/" cor="green darken-1">
          <!-- se o usuário for falso, o li não irá aparecer -->
          <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
          <li v-if="!usuario"><router-link to="/cadastro">Cadastre-se</router-link></li>
          <li v-if="usuario"><router-link to="/perfil">{{usuario.name}}</router-link></li>
          <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
      </nav-bar>
    </header>

    <main>
      <div class="container">
        <div class="row">
            <grid-vue tamanho="8">
              <card-menu-vue>
                <slot name="menuesquerdo" />
              </card-menu-vue>
            </grid-vue>
          <grid-vue tamanho="4">
            <!-- Conteúdo do template que vem da Home -->
            <slot name="principal" />
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
  name: 'LoginTemplate',
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
  created() {
    console.log('created()');
    //criando uma variável e pegando ela pela session
    let usuarioAux = sessionStorage.getItem('usuario');
    if(usuarioAux){
      this.usuario = JSON.parse(usuarioAux);
      //Aqui estou redirecionando o usuário para / "home" usando a variável global $router e método "push"
          this.$router.push('/');

    }
  },
  methods: {
    sair(){
      //limpar a sessão do storange no browser
      sessionStorage.clear();
      this.usuario = false;
    }
  },
}
</script>

<style>

</style>
