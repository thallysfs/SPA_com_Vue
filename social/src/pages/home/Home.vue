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


        <card-conteudo-vue perfil="https://materializecss.com/images/yuna.jpg"
        nome="Maria Silva"
        data="13/01/18 13:30">
          <card-detalhe-vue
            img="https://materializecss.com/images/sample-1.jpg"
            titulo=""
            txt="Uma linda imagem!!!" />
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
      usuario:false
    }
  },
  created() {
    //criando uma variável e pegando ela pela session
    let usuarioAux = this.$store.getters.getUsuario;;
    if(usuarioAux){
      this.usuario = this.$store.getters.getUsuario;;
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
