<template>

  <login-template>

    <span slot="menuesquerdo">
      <ul>
        <img src="https://www.oficinadanet.com.br/imagens/post/19125/social.jpg" class="responsive-img">
      </ul>
    </span>

    <span slot="principal">
      <h2>Login</h2>

      <input type="text" name="email" placeholder="E-mail" value="">
      <input type="password" name="senha" placeholder="Senha" value="">
      <button type="button" class="btn">Entrar</button>
    </span>







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
