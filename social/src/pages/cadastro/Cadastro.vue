<template>

  <login-template>

    <span slot="menuesquerdo">
      <ul>
        <img src="https://www.oficinadanet.com.br/imagens/post/19125/social.jpg" class="responsive-img">
      </ul>
    </span>

    <span slot="principal">

      <h2>Cadastro</h2>

      <input type="text" name="nome" placeholder="Nome" value="">
      <input type="text" name="email" placeholder="E-mail" value="">
      <input type="password" name="senha" placeholder="Senha" value="">
      <input type="password" name="senha" placeholder="Confirme a Senha" value="">
      <button type="button" class="btn">Enviar</button>
              <!-- v-on cria um evento onclick que nega o valor atual da variável. Se ela for false, ou clicar vira true e vice versa -->
       <router-link class="btn orange" to="/login" >Já tenho Conta</router-link>

    </span>







  </login-template>


  </template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'


export default {
  name: 'Cadastro',
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
