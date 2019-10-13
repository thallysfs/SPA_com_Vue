<template>
  <div class="row">
      <grid-vue class="input-field" tamanho="12">
        <input type="text" v-model="conteudo.titulo">
        <textarea v-if="conteudo.titulo" placeholder="Conteúdo" v-model="conteudo.texto" class="materialize-textarea"></textarea>
        <input v-if="conteudo.titulo && conteudo.texto" type="text" placeholder="link" v-model="conteudo.link">
        <input v-if="conteudo.titulo && conteudo.texto" type="text" placeholder="Url da imagem" v-model="conteudo.imagem">
        <label>O que está acontecendo?</label>
      </grid-vue>
      <p class="right-align">
        <!-- criação do botão abaixo pelas classes -->
        <!-- o if checa se existe algum conteúdo na variável 'conteudo', se sim ele exibe o botão -->
        <button @click="addConteudo()" v-if="conteudo.titulo && conteudo.texto" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</button>
      </p>
  </div>
</template>

<script>
//importandoa Grid porque irei trabalhar com ela neste componente
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'PublicarConteudoVue',
  props:[],
  data () {
    return {
      conteudo:{titulo:'', texto:'', link:'', imagem:''}
    }
  },
  components:{
    GridVue,
  },
  methods:{
    addConteudo(){
      console.log(this.conteudo);
      this.$http.post(this.$urlAPI+'conteudo/adicionar',{
        titulo: this.conteudo.titulo,
        texto: this.conteudo.texto,
        link: this.conteudo.link,
        imagem: this.conteudo.imagem
      },
      {"headers":{"authorization":"Bearer "+ this.$store.getters.getToken}}).then(response =>{
        //se status for true ele entrará no if
        if(response.data.status){
          console.log(response.data.conteudos);
          //aqui eu alimento a variável conteúdo com string vazia para limpar o conteúdo do form após o cadastro
          this.conteudo = {titulo:'', texto:'', link:'', imagem:''};

          //Vuex - this.$store (sempre usar), commit (quando chamar um método),
          //'setConteudosLinhaTempo' primeiro parâmetro, response.data.conteudos.data - objeto que vou atualizar
          this.$store.commit('setConteudosLinhaTempo',response.data.conteudos.data);


        }else if(response.data.status == false && response.data.validacao){
          //onde exibirei erros de validação
          let erros = '';
          for(let erro of Object.values(response.data.erros)){
            erros += erro +" ";
          }
          alert(erros);
        }
      }).catch(e =>{
        console.log(e)
        alert("Erro: Tente novamente mais tarde!!!");
    });
   }
  }
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
