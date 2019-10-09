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

  <!-- O 'item' é o indice da variável conteudo que setamos abaixo com o retorno do Laravel -->
        <card-conteudo-vue v-for="item in conteudos" :key="item.id"
        :perfil="item.user.imagem"
        :nome="item.user.name"
        :data="item.data">
          <card-detalhe-vue
            :img="item.imagem"
            :titulo="item.titulo"
            :txt="item.texto" />
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
      conteudos:[]
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
          //Aqui eu alimento a variável conteudo que criei no data() acima com os valores retornados pelo Laravel
          this.conteudos = response.data.conteudos.data;
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

  }
}
</script>

<style scoped>

</style>
