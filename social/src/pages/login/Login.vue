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
        <button class="btn">Entrar</button>
        <!-- v-on cria um evento onclick que nega o valor atual da variável. Se ela for false, ou clicar vira true e vice versa -->
        <router-link class="btn orange" to="/cadastro" >Cadastre-se</router-link>

    </span>

  </login-template>


  </template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'


export default {
  name: 'Login',
  data () {
    return {
    }
  },
  components:{
    LoginTemplate,


  }
}
</script>

<style scoped>

</style>
