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
      this.$http.post(this.$urlAPI+'login', {
        email: this.email,
        password: this.password
      })
      .then(response => {
        //console.log(response)
        if(response.data.status){
          //login efetuado com sucesso
          console.log('login com sucesso')
          //setando o Vuex
          this.$store.commit('setUsuario', response.data.usuario);
          //JSON.stringify(response.data) transforma o obj data em string
          sessionStorage.setItem('usuario', JSON.stringify(response.data.usuario));
          //Aqui estou redirecionando o usuário para / "home" usando a variável global $router e método "push"
          this.$router.push('/');
        }else if(response.data.status == false && response.data.validacao){
          //login não realizou
          console.log('Erros de Validação')
          let erros = '';
          //Object.values transforma o objeto reponse.data em array de valores
          for(let erro of Object.values(response.data.erros)){
            erros += erro +" ";
          }
          alert(erros);

        }else{
          //Login não existe
          console.log('Login não existe')
          alert('Login inválido');
        }
      })
      //aqui trataremos ou visualizaremos o erro
      .catch(e => {
        console.log(e)
        alert("Erro: Tente novamente mais tarde!");
    })

    }
  }
}
</script>

<style scoped>

</style>
