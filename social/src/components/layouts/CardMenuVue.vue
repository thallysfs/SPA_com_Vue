<template>
  <div class="card-panel grey lighten-5 z-depth-1">
    <slot/>
  </div>
</template>

<script>
export default {
  name: 'CardMenuVue',
  props:[],
  data () {
    return {

    }
  }
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
