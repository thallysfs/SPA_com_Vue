<template>
<div class="row">
    <div class="card">
          <div class="card-content">
            <div class="row valign-wrapper">
                  <grid-vue tamanho="1">
                    <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
                  </grid-vue>
                  <grid-vue tamanho="11">
                    <span class="black-text">
                      <strong>{{nome}}</strong> - <small>{{data}}</small>

                    </span>
                  </grid-vue>
              </div>
            <slot/>
          </div>
          <div class="card-action">
            <p>
              <a style="cursor:pointer" @click="curtida(id)"><i class="material-icons">{{curtiu}}</i>{{totalCurtidas}}</a>

            <!-- {{comentarios.lenth}} comentarios (variável que vem do props com todos os comentários. lenth método do javascript que contas quantos registros existem )  -->
              <a style="cursor:pointer" @click="abreComentarios(id)"><i class="material-icons">insert_comment</i>{{comentarios.length}}</a>
            </p>
            <p v-if="exibirComentario" class="right-align">
              <input type="text" name="" id="" placeholder="Comentar">
              <button class="btn waves-effect waves-light orange"><i class="material-icons">send</i></button>
            </p>
            <p v-if="exibirComentario">
              <ul class="collection">
                <li class="collection-item avatar" v-for="item in comentarios" :key="item.id">
                  <img src="http://materializecss.com/images/yuna.jpg" alt="" class="circle">
                  <span class="title">id usuario = {{item.user_id}} <small>{{item.data}}</small></span>
                  <p>
                    {{item.texto}}
                  </p>
                </li>

                <li class="collection-item avatar">
                  <img src="http://materializecss.com/images/yuna.jpg" alt="" class="circle">
                  <span class="title">Maria da silva <small>12h30 12/03/2019</small></span>
                  <p>
                    Gostei do conteúdo!
                  </p>
                </li>

              </ul>
            </p>
          </div>
    </div>
</div>
</template>

<script>
//importandoa Grid porque irei trabalhar com ela neste componente
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'CardConteudoVue',
  props:['id','perfil', 'nome', 'data', 'totalcurtidas', 'curtiuconteudo', 'comentarios'],
  data () {
    return {
      //criei variável curtiu com o valor do ícone do coração vazio
      curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
      totalCurtidas: this.totalcurtidas,
      exibirComentario: false
    }
  },
  components:{
    GridVue,
  },
  methods: {
    curtida(id){

      this.$http.put(this.$urlAPI+'conteudo/curtir/'+id,{},
      {"headers":{"authorization":"Bearer "+ this.$store.getters.getToken}})
      .then(response=>{

        if(response.status){
        this.totalCurtidas = response.data.curtidas;
        this.$store.commit('setConteudosLinhaTempo',response.data.lista.conteudos.data);
          if(this.curtiu == 'favorite_border'){
            //favorite é o ícone do coração cheio
            this.curtiu ='favorite';
          }else{
            this.curtiu ='favorite_border';
          }
        }else{
          alert(response.data.erro)
        }


      }).catch(e => {
        console.log(e)
        alert("Erro: Tente novamente mais tarde!!!");
    });



    },//fim do método curtida
    abreComentarios(id){
      this.exibirComentario = !this.exibirComentario;

    }//fim do método abreComentario

  }
}
</script>

<!-- Adicione "Scoped" atributo limita o CSS apenas nesse componente  -->
<style scoped>

</style>
