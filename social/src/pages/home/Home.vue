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
        :id="item.id"
        :totalcurtidas="item.total_curtidas"
        :comentarios="item.comentarios"
        :curtiuconteudo="item.curtiu_conteudo"
        :perfil="item.user.imagem"
        :nome="item.user.name"
        :data="item.data">
          <card-detalhe-vue
            :img="item.imagem"
            :titulo="item.titulo"
            :txt="item.texto"
            :link ="item.link" />
        </card-conteudo-vue>
        <button v-if="urlProximaPagina" @click="carregaPaginacao()" class="btn blue">Mais...</button>
        <!-- A diretiva v-scroll foi criada no main.js -->
        <div v-scroll="handleScroll"></div>
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
      urlProximaPagina:null,
      paraScroll: false
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

          //aqui eu pego o valor da url da próxima página
          this.urlProximaPagina = response.data.conteudos.next_page_url;

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
  methods: {
    carregaPaginacao(){
      //aqui verifico se a variável próxima página não foi alimentada, pois só faz sentido continuar se existir uma próxima url
      if(!this.urlProximaPagina){
        return;
      }

      this.$http.get(this.urlProximaPagina,
      {"headers":{"authorization":"Bearer "+ this.$store.getters.getToken}})
      .then(response => {
        console.log(response);
        if(response.data.status){
          this.$store.commit('setPaginacaoConteudosLinhaTempo',response.data.conteudos.data);
          this.urlProximaPagina = response.data.conteudos.next_page_url;
          this.paraScroll = false;
        }
      })
      .catch(e => {
        console.log(e)
        alert("Erro: Tente novamente mais tarde!!!");
        alert(this.urlProximaPagina);
      })

    },//fim do método CarregaPaginacao

    //médoto que irá interagir com a diretiva criada no main.js para efito da timeline infinita
    handleScroll: function (evt, el) {
      //console.log(window.scrollY);
      //console.log(document.body.clientHeight);
      if(this.paraScroll){
        return;
      }
      //window.scrollY é o valor das rotações do scroll, document.body.clientHeight é o tamanho da página. 816 é a altura da página quando o scroll está no rodapé
      if(window.scrollY >= document.body.clientHeight -916){
        console.log('Ok');
        this.carregaPaginacao();
        this.paraScroll = true;
      }

    }
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
