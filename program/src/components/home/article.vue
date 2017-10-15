<template>
  <div class="article" @click="_toHome()">
    <h1 class="h1 center">陋室銘</h1>
    <h2>劉禹錫 唐</h2>
    <p>山不在高，有仙則名。</p>
    <p>水不在深，有龍則靈。</p>
    <p>斯是陋室，惟吾德馨。</p>
    <p>苔痕上階綠，草色入簾青。</p>
    <p>談笑有鴻儒，往來無白丁。</p>
    <p>可以調素琴，閱金經。</p>
    <p>無絲竹之亂耳，無案牘之勞形。</p>
    <p>南陽諸葛廬，西蜀子雲亭。</p>
    <p>孔子云：「何陋之有？」</p>
  </div>
</template>
<script>
export default {
  name: 'article',
  methods: {
    _toHome: function () {
      this.$router.push({path: '/home'})
    }
  }
}
</script>
<style lang="scss" scoped>
.article {
  h1 {
    padding-top: 1rem;
    padding-bottom: 0.4rem;
    letter-spacing: 0.2em;
  }
  h2 {
    font-size: 0.4rem;
    text-align: center;
  }
  p {
    font-size: 0.4rem;
    text-align: center;
    margin: 0.3rem 0;
    letter-spacing: 0.1em;
  }
}
</style>

