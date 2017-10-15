<template>
  <div class="password">
    <h2 class="reg-h2">你的密码是？</h2>
    <input type="password" class="reg-input">
    <h2 class="reg-h2">还记得刚才输的密码吗？</h2>
    <input type="password" class="reg-input">
    <router-link tag="button" to="/registered/email"  class="btn btn-black reg-btn-left">上一步</router-link>
    <button class="btn btn-black reg-btn-right">注册</button>
  </div>
</template>
<script>
export default {

}
</script>
<style lang="scss" scoped>

</style>
