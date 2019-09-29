<template>

  <login-template>

    <span slot="menuesquerdo">
      <ul>
        <img src="https://www.oficinadanet.com.br/imagens/post/19125/social.jpg" class="responsive-img">
      </ul>
    </span>

    <span slot="principal">

      <h2>Cadastro</h2>

      <input type="text" name="nome" placeholder="Nome" v-model="name">
      <input type="text" name="email" placeholder="E-mail" v-model="email">
      <input type="password" name="senha" placeholder="Senha" v-model="password">
      <input type="password" name="senha" placeholder="Confirme a Senha" v-model="password_confirmation">
      <button type="button" class="btn" v-on:click="cadastro()">Enviar</button>
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
      name:'',
      email:'',
      password:'',
      password_confirmation:'',
    }
  },
  components:{
    LoginTemplate,
  },
  methods:{
    cadastro(){
      console.log("Cadastro realizado com sucesso!");
      //neste ponto acessaremos a api do Laravel e passaremos as variáveis
      this.$http.post(this.$urlAPI+'cadastro', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation

      })
      .then(response => {
        //console.log(response)
        if(response.data.status){
          //login efetuado com sucesso
          console.log('login com sucesso')
          //JSON.stringify(response.data) transforma o obj data em string
          sessionStorage.setItem('usuario', JSON.stringify(response.data.usuario));
          //Aqui estou redirecionando o usuário para / "home" usando a variável global $router e método "push"
          this.$router.push('/');
        }else if(response.data.status == false && response.data.validacao){
          //erros de validação
          console.log('erros de validação')
          let erros = '';
          //Object.values transforma o objeto reponse.data em array de valores
          for(let erro of Object.values(response.data.erros)){
            erros += erro +" ";
          }
          alert(erros);

        }else{
          alert('Erro no cadastro! Tente novamente mais tarde');
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
