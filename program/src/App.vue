<template>
  <div id="app">
    <transition :name="transitionName">
      <keep-alive>
        <router-view class='router' v-on:setName="_setUserinfo"/>
      </keep-alive>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      transitionName: 'slide-left'
    }
  },
  created () {
    this._setLocalStorage()
  },
  mounted () {
    this._isLogin()
  },
  methods: {
    _setLocalStorage: function () {
      if (!localStorage.pathHis) {
        localStorage.pathHis = '["/index"]'
      }
      if (!localStorage.userInfo) {
        localStorage.userInfo = '{"nick_name":"","isLogin":false,"create_time":""}'
      }
    },
    _setUserinfo: function (data) {
      let userInfo = {}
      userInfo.nick_name = data.nick_name
      userInfo.create_time = data.create_time
      userInfo.isLogin = true
      localStorage.userInfo = JSON.stringify(userInfo)
    },
    _isLogin: function () {
      if (localStorage.userInfo) {
        let isLogin = JSON.parse(localStorage.userInfo).isLogin
        isLogin ? this.$router.push({path: '/index'}) : this.$router.push({path: '/home'})
      }
    }
  },
  watch: {
    '$route' (to, from) {
      let pathHis = localStorage.pathHis
      let arr = JSON.parse(pathHis)
      let isback = arr.indexOf(to.path)
      if (isback !== -1) {
        this.transitionName = 'slide-right'
        if (from.path !== '/index') {
          arr.splice(arr.indexOf(from.path), 1)
        }
        if (to.path === '/index') {
          arr = ['/index']
        }
        localStorage.pathHis = JSON.stringify(arr)
      } else {
        arr.push(to.path)
        localStorage.pathHis = JSON.stringify(arr)
        this.transitionName = 'slide-left'
      }
    }
  }
}
</script>

<style lang="scss">
$black: #333;
$white: #fff;
$warning: #f24949;
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  // -webkit-font-smoothing: antialiased;
  // -moz-osx-font-smoothing: grayscale;
  height: 100%;
  .btn {
    display: block;
    padding: 0.25rem;
    border-radius: 3px;
    width: 3.4rem;
    border: none;
    font-size: initial;
    box-sizing: border-box;
  }
  .btn-black {
    color: $white;
    background-color: $black;
    border: 1px solid $black;
  }
  .btn-white {
    color: $black;
    background-color: $white;
    border: 1px solid $black;
  }
  .h1 {
    font-size: 0.8rem;
    font-weight: bold;
  }
  .bold {
    font-weight: bold;
  }
  .center {
    text-align: center;
    margin-left: auto;
    margin-right: auto;
  }
  .logo {
    font-size: 0.6rem;
    font-weight: bold;
  }
  .reg-h2{
    font-weight: bold;
    font-size: 0.6rem;
    padding-top: 2rem;
    padding-left: 1rem;
    letter-spacing: 0.1em;
  }
  .reg-input{
    display: block;
    width: 80%;
    margin: 0.4rem auto 0rem auto;
    padding: 0.1rem 0.2rem;
    font-size: 0.5rem;
    border: none;
    border-bottom: 2px solid #333;
    text-align: center;
    font-weight: bold;
  }
  .reg-tip{
    padding-left: 1rem;
    font-weight: bold;
    font-size: 0.34rem;
  }
  .reg-btn-left{
    position: fixed;
    bottom: 0.4rem;
    left: 0.6rem;
  }
  .reg-btn-right{
    position: fixed;
    bottom: 0.4rem;
    right: 0.6rem;
  }
  .login-h2{
    font-weight: bold;
    font-size: 0.6rem;
    padding-top: 1rem;
    padding-left: 1rem;
    letter-spacing: 0.1em;
  }
}

.router {
  position: absolute;
  width: 100%;
  transition: all .4s ease;
}

.slide-left-enter,
.slide-right-leave-active {
  -webkit-transform: translate(100%, 0);
  transform: translate(100%, 0);
}

.slide-left-leave-active,
.slide-right-enter {
  -webkit-transform: translate(-100%, 0);
  transform: translate(-100% 0);
}
</style>
