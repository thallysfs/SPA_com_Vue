<template>
  <div class="row">
      <grid-vue class="input-field" tamanho="12">
        <textarea v-model="conteudo" class="materialize-textarea"></textarea>
        <label>O que está acontecendo?</label>
      </grid-vue>
      <p>
        <!-- criação do botão abaixo pelas classes -->
        <!-- o if checa se existe algum conteúdo na variável 'conteudo', se sim ele exibe o botão -->
        <grid-vue v-if="conteudo" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</grid-vue>
      </p>
  </div>
</template>

<script>
//importandoa Grid porque irei trabalhar com ela neste componente
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'PublicarConteudoVue',
  props:['img', 'titulo', 'txt'],
  data () {
    return {
      conteudo:''
    }
  },
  components:{
    GridVue,
  }
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
