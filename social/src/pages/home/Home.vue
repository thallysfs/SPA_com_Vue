<template>

  <site-template>
    <publicar-conteudo-vue/>


      <card-conteudo-vue perfil="https://materializecss.com/images/yuna.jpg"
      nome="Maria Silva"
      data="13/01/18 13:30">
        <card-detalhe-vue
          img="https://materializecss.com/images/sample-1.jpg"
          titulo=""
          txt="Uma linda imagem!!!" />
      </card-conteudo-vue>
  </site-template>


  </template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'


export default {
  name: 'Home',
  data () {
    return {

    }
  },
  components:{
    SiteTemplate,
    CardConteudoVue,
    CardDetalheVue,
    PublicarConteudoVue

  }
}
</script>

<style scoped>

</style>
