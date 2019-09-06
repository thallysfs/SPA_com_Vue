<template>
    <nav :class="cor || 'blue'">
      <div class="nav-wrapper container">
        <!-- <a :href="url || '#/'" class="brand-logo">{{logo || 'Site'}}</a> abaixo segue router-link no logar do "a" -->
        <router-link class="brand-logo" :to="url || '/'">{{logo || 'Site'}}</router-link>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <slot />
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
