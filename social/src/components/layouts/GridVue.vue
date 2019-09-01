<template>
  <div :class="'col s' + tamanho">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'GridVue',
  props:['tamanho'],
  data () {
    return {

    }
  }
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
