<template>

  <site-template>

    <span slot="menuesquerdo">
      <ul>
        <img :src="usuario.imagem" class="responsive-img">
      </ul>
    </span>

    <span slot="principal">

      <h2>Perfil</h2>

      <input type="text" name="nome" placeholder="Nome" v-model="name">
      <input type="text" name="email" placeholder="E-mail" v-model="email">

      <div class="file-field input-field">
          <div class="btn">
            <span>Imagem</span>
            <input type="file" v-on:change="salvaImagem">
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


export default {
  name: 'Perfil',
  data () {
    return {
     usuario:false,

      name:'',
      email:'',
      password:'',
      password_confirmation:'',
      imagem:'',
    }
  },
  created() {
    //criando uma variável e pegando ela pela session pelo Vuex definido social\src\main.js
    let usuarioAux = this.$store.getters.getUsuario;
    if(usuarioAux){
      this.usuario = this.$store.getters.getUsuario;
      this.name = this.usuario.name;
      this.email = this.usuario.email;
    }
  },
  components:{
    SiteTemplate,
  },
  methods:{

    salvaImagem(e){
      //o método target.file = pega o caminho do upload, o dataTransfer.files possibilita pegar o caminho do upload arrastando e soltando o arquivo
      let arquivo = e.target.files || e.dataTransfer.files;
      if(!arquivo.length){
        return;
      }

      let reader = new FileReader();
      reader.onloadend = (e) => {
        this.imagem = e.target.result;
      };
      reader.readAsDataURL(arquivo[0]);
    },


    perfil(){

      //neste ponto acessaremos a api do Laravel e passaremos as variáveis
      this.$http.put(this.$urlAPI+'perfil', {
        name: this.name,
        email: this.email,
        imagem: this.imagem,
        password: this.password,
        password_confirmation: this.password_confirmation

      //configuração e envio do token, obs.: a palavra Bearer deve vir com um espaçõ + token
      },{"headers":{"authorization":"Bearer "+ this.$store.getters.getToken}})

      .then(response => {
        //console.log(response)
        if(response.data.status){
          // login com sucesso
          //console.log(response.data);
          this.usuario = response.data.usuario;
          //setando o Vuex
          this.$store.commit('setUsuario', response.data.usuario);
          sessionStorage.setItem('usuario',JSON.stringify(this.usuario));
          alert('Perfil atualizado!');

        }else if(response.data.status == false && response.data.validacao){
          // erros de validação
          //console.log('erros de validação')
          let erros = '';
          for(let erro of Object.values(response.data.erros)){
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
