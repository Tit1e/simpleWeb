<template>
  <div class="home">
    <div class="logo">陋</div>
    <h1 class="h1">欢迎来到</h1>
    <br>
    <h1 class="h1" @click="_showArticle()">陋网</h1>
    <p>这是一个非常简陋的网站</p>
    <router-link tag="button" to="/registered/username" type="button" class=" btn btn-black center bold">注册</router-link>
    <router-link tag="button" to="/login"  type="button" class=" btn btn-white center bold">登录</router-link>
    <router-link tag="p" id="toIndex" to="/index" class="center">我只是想来看看</router-link>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
    }
  },
  methods: {
    _showArticle: function () {
      this.$router.push({path: '/article'})
    }
  }
}
</script>

<style scoped lang="scss">
.home {
  .logo {
    padding: 1.5rem 0 1.5rem 1rem;
    text-align: left;
  }
  .h1 {
    margin-left: 1rem;
    padding-bottom: 0.4rem;
    letter-spacing: 0.2em;
    display: inline-block;
  }
  p {
    margin-left: 1rem;
    margin-bottom: 2rem;
    font-size: 0.4rem;
    letter-spacing: 0.1em;
  }
  button{
    margin-bottom: 0.3rem;
    font-size: 0.4rem;
  }
  #toIndex{
    margin: 0.5rem 0;
    font-weight: bold;
  }
}
</style>
