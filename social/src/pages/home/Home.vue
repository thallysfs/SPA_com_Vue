<template>

  <site-template>

    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-vue tamanho="4">
          <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-vue>
        <grid-vue tamanho="8">
          <span class="black-text">
            <h5>Maria Silva</h5>
            This is a square image.
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
