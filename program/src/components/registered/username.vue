<template>
  <div class="username">
    <h2 class="reg-h2">你好，你想我怎么称呼你？</h2>
    <input type="text" class="reg-input">
    <span class="reg-tip">昵称不能为空并且长度不能超过6位</span>
    <router-link tag="button" to="/registered/email"  class="btn btn-black reg-btn-right">下一步</router-link>
  </div>
</template>
<script>
export default {

}
</script>
<style lang="scss" scoped>
</style>
