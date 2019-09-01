<template>
    <nav :class="cor || 'blue'">
      <div class="nav-wrapper container">
        <a :href="url || '#'" class="brand-logo">{{logo || 'Site'}}</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="">sass</a></li>
          <li><a href="">sass <span class="new badge">4</span></a></li>
          <li><a href="">sass</a></li>
        </ul>
      </div>
    </nav>
</template>

<script>
export default {
  name: 'NavBar',
  props:['logo', 'url', 'cor'],
  data () {
    return {

    }
  }
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
