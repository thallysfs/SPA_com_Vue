<template>

  <site-template>

    <span slot="menuesquerdo">
      <ul>
        <img src="https://www.oficinadanet.com.br/imagens/post/19125/social.jpg" class="responsive-img">
      </ul>
    </span>

    <span slot="principal">

      <h2>Perfil</h2>

      <input type="text" name="nome" placeholder="Nome" v-model="name">
      <input type="text" name="email" placeholder="E-mail" v-model="email">

      <div class="file-field input-field">
          <div class="btn">
            <span>Imagem</span>
            <input type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
      </div>

      <input type="password" name="senha" placeholder="Senha" v-model="password">
      <input type="password" name="senha" placeholder="Confirme a Senha" v-model="password_confirmation">
      <button type="button" class="btn" v-on:click="perfil()">Atualizar</button>

    </span>







  </site-template>


  </template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import axios from 'axios'


export default {
  name: 'Perfil',
  data () {
    return {
     usuario:false,

      name:'',
      email:'',
      password:'',
      password_confirmation:'',
    }
  },
  created() {
    //criando uma variável e pegando ela pela session
    let usuarioAux = sessionStorage.getItem('usuario');
    if(usuarioAux){
      this.usuario = JSON.parse(usuarioAux);
      this.name = this.usuario.name;
      this.email = this.usuario.email;
    }
  },
  components:{
    SiteTemplate,
  },
  methods:{
    perfil(){

      //neste ponto acessaremos a api do Laravel e passaremos as variáveis
      axios.put('http://127.0.0.1:8000/api/perfil', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      //configuração e envio do token, obs.: a palavra Bearer deve vir com um espaçõ + token
      },{"headers":{"authorization":"Bearer "+ this.usuario.token}})

      .then(response => {
        //console.log(response)
        if(response.data.token){
          // login com sucesso
          console.log(response.data);
          sessionStorage.setItem('usuario',JSON.stringify(response.data));
          alert('Perfil atualizado!');

        }else{
          // erros de validação
          console.log('erros de validação')
          let erros = '';
          for(let erro of Object.values(response.data)){
            erros += erro +" ";
          }
          alert(erros);
        }
      })

      //aqui trataremos ou visualizaremos o erro
      .catch(e => {
        console.log(e)
        alert("Erro: Tente novamente mais tarde!!!");
    })

    }
  }
}
</script>

<style scoped>

</style>
