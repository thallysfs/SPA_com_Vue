<template>
  <span>
    <!-- a div só existirá se existir a variável 'img'
     existir e se img for diferente de '#'.
     -->
    <div v-if="img && img != '#'" class="card-image">
      <!-- target="_blank" abre o link em outra página -->
      <!-- Se existir e link e link for diferente de '#' -->
      <a v-if="link && link != '#'" :href="link" target="_blank">
        <img :src="img">
        <span class="card-title">{{titulo || ''}}</span>
      </a>
      <!-- se o 'link' não vier vazio ou vier '#' mostrarei o span abaixo -->
      <span v-if="!link || link == '#'">
        <img :src="img">
        <span class="card-title">{{titulo || ''}}</span>
      </span>
    </div>

    <div class="card-content">
      <!-- se img não existir ou for igual a '#' é pq não tenho img então trarei o span abaixo -->
      <span v-if="img || img != '#'">
        <span class="card-title">{{titulo || ''}}</span>
      </span>
      <p>{{txt}}</p>
      <!-- Se existir e link e link for diferente de '#' -->
      <p v-if="link && link != '#'"><a :href="link" target="_blank">Confira mais aqui...</a></p>
      </div>
  </span>
</template>

<script>

export default {
  name: 'CardDetalheVue',
  props:['img', 'titulo', 'txt', 'link'],
  data () {
    return {

    }
  },
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
