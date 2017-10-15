<template>
  <div class="email">
    <h2 class="reg-h2">你的邮箱是？</h2>
    <input type="text" class="reg-input">
    <router-link tag="button" to="/registered/username"  class="btn btn-black reg-btn-left">上一步</router-link>
    <router-link tag="button" to="/registered/password"  class="btn btn-black reg-btn-right">下一步</router-link>
  </div>
</template>
<script>
export default {

}
</script>
<style lang="scss" scoped>

</style>
