<template>
  <span>
    <!-- a dic só existirá se existir a variável 'img'  -->
    <div v-if="img" class="card-image">
      <img :src="img">
      <span class="card-title">{{titulo || ''}}</span>
    </div>
    <div v-if="txt" class="card-content">
      <p>{{txt}}</p>
      </div>
  </span>
</template>

<script>

export default {
  name: 'CardDetalheVue',
  props:['img', 'titulo', 'txt'],
  data () {
    return {

    }
  },
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
