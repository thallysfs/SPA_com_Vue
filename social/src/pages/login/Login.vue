<template>

  <login-template>

    <span slot="menuesquerdo">
      <ul>
        <img src="https://www.oficinadanet.com.br/imagens/post/19125/social.jpg" class="responsive-img">
      </ul>
    </span>

    <span slot="principal">
      <h2>Login</h2>

        <input type="text" name="email" placeholder="E-mail" v-model="email">
        <input type="password" name="senha" placeholder="Senha" v-model="password">
        <button class="btn" v-on:click="login()">Entrar</button>
        <!-- v-on cria um evento onclick que nega o valor atual da variável. Se ela for false, ou clicar vira true e vice versa -->
        <router-link class="btn orange" to="/cadastro" >Cadastre-se</router-link>

    </span>

  </login-template>


  </template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios'


export default {
  name: 'Login',
  data () {
    return {
      email:'',
      password:''
    }
  },
  components:{
    LoginTemplate,


  },
  methods:{
    login(){
      console.log("ok");
      //neste ponto acessaremos a api do Laravel e passaremos as variáveis
      axios.post('http://127.0.0.1:8000/api/login', {
        email: this.email,
        password: this.password
      })
      .then(response => {
        console.log(response)
        if(response.data.token){
          //login efetuado com sucesso
          console.log('login com sucesso')
        }else if(response.data.status == false){
          //login não realizou
          console.log('login não existe')
          alert('Login inválido!');
        }else{
          //erros de validação
          console.log('erros de validação')
          let erros = '';
          //Object.values transforma o objeto reponse.data em array de valores
          for(let erro of Object.values(response.data)){
            erros += erro +" ";
          }
          alert(erros);
        }
      })
      //aqui trataremos ou visualizaremos o erro
      .catch(e => {
        console.log(e)
    })

    }
  }
}
</script>

<style scoped>

</style>
