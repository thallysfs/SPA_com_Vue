<template>

  <login-template>

    <h2>Login</h2>

    <input type="text" name="email" placeholder="E-mail" value="">
    <input type="password" name="senha" placeholder="Senha" value="">
    <button type="button" class="btn">Entrar</button>



  </login-template>


  </template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'


export default {
  name: 'Login',
  data () {
    return {

    }
  },
  components:{
    LoginTemplate,
    CardConteudoVue,
    CardDetalheVue,
    PublicarConteudoVue,


  }
}
</script>

<style scoped>

</style>
