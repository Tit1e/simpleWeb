<template>
  <div class="top">
    <div class="logo center" @click="_toHome()">陋</div>
    <div id="user_ctrl">
      <span @click="_add()">
        <i class="iconfont icon-edit2"></i>
      </span>
      <span @click="_center()">
        <i class="iconfont icon-user4"></i>
      </span>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    _toHome: function () {
      let isLogin = JSON.parse(localStorage.userInfo).isLogin
      isLogin ? this.$router.push({ path: '/index' }) : this.$router.push({ path: '/home' })
    },
    _add: function () {
      let isLogin = JSON.parse(localStorage.userInfo).isLogin
      isLogin ? this.$router.push({ path: '/add' }) : this.$router.push({ path: '/login' })
    },
    _center: function () {
      let isLogin = JSON.parse(localStorage.userInfo).isLogin
      isLogin ? this.$router.push({ path: '/center' }) : this.$router.push({ path: '/login' })
    }
  }
}
</script>
<style lang="scss" scoped>
.top {
  height: 1.28rem;
  position: relative;
  .logo {
    line-height: 1.28rem;
  }
  #user_ctrl {
    height: 100%;
    position: absolute;
    top: 0;
    right: 0.4rem;
    bottom: 0;
    span {
      line-height: 1.28rem;
      margin-left: 0.3rem;
    }
  }
  .iconfont {
    font-size: 0.5rem;
  }
}
</style>

