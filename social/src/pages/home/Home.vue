<template>

  <site-template>

    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-vue tamanho="4">
          <img :src="usuario.imagem" :alt="usuario.name" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-vue>
        <grid-vue tamanho="8">
          <span class="black-text">
            <h5>{{usuario.name}}</h5>
            Descrição
          </span>
        </grid-vue>
      </div>
    </span>

    <span slot="principal">
      <publicar-conteudo-vue/>

  <!-- O 'item' é o indice do objeto listaConteudos que setamos no método computado pegando pelo Vuex -->
        <card-conteudo-vue v-for="item in listaConteudos" :key="item.id"
        :perfil="item.user.imagem"
        :nome="item.user.name"
        :data="item.data">
          <card-detalhe-vue
            :img="item.imagem"
            :titulo="item.titulo"
            :txt="item.texto"
            :link ="item.link" />
        </card-conteudo-vue>
    </span>

  </site-template>


  </template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import GridVue from '@/components/layouts/GridVue'


export default {
  name: 'Home',
  data () {
    return {
      //criando variável para povoa-la com os dados da session mais abaixo no created()
      usuario:false,
    }
  },
  created() {
    //criando uma variável e pegando ela pela session
    let usuarioAux = this.$store.getters.getUsuario;
    if(usuarioAux){
      this.usuario = this.$store.getters.getUsuario;

      //neste ponto acessaremos a api do Laravel e passaremos as variáveis
      this.$http.get(this.$urlAPI+'conteudo/lista',
      //configuração e envio do token, obs.: a palavra Bearer deve vir com um espaçõ + token
      {"headers":{"authorization":"Bearer "+ this.$store.getters.getToken}})
      .then(response => {
        //aqui é retornado a variável 'conteudos' enviada no return do método lista no conteudoController
        console.log(response);
        if(response.data.status){
          //Vuex - this.$store (sempre usar), commit (quando chamar um método),
          //'setConteudosLinhaTempo' primeiro parâmetro, response.data.conteudos.data - objeto que vou atualizar
          //Aqui eu alimento a variável conteudo que criei no data(){ conteudos:[]} acima com os valores retornados
          //pelo Laravel salvos no Vuex
          this.$store.commit('setConteudosLinhaTempo',response.data.conteudos.data);


        }


      })

      //aqui trataremos ou visualizaremos o erro
      .catch(e => {
        console.log(e)
        alert("Erro: Tente novamente mais tarde!!!");
    })


    }
  },
  components:{
    SiteTemplate,
    CardConteudoVue,
    CardDetalheVue,
    PublicarConteudoVue,
    GridVue

  },
  computed:{
    // o método computado irá executar quando a página atualizar
    //após isso ele vai trazer os dados de todos os conteúdos salvos no Vuex
    listaConteudos(){
      return this.$store.getters.getConteudosLinhaTempo;
    }
  }
}
</script>

<style scoped>

</style>
