<template>
  <div class="login">
    <top></top>
    <div>
      <h2 class="login-h2">你注册时的邮箱是？</h2>
      <input type="text" class="reg-input" v-model="email">
      <h2 class="login-h2">你注册时的密码是？</h2>
      <input type="password" class="reg-input" v-model="password">
      <button class="center btn btn-white" @click="_login()">登录</button>
      <router-link tag="span" to="/forgot" class="center" v-if="false">忘记密码点这里</router-link>
    </div>
    <transition name="fade">
      <msg v-bind:msg="msg" v-if="msg" v-on:HideMsg="_hideMsg"></msg>
    </transition>
  </div>
</template>
<script>
import Top from '@/components/common/top'
import Msg from '@/components/msg/msg'
import axios from 'axios'
import qs from 'qs'
export default {
  components: {
    Top,
    Msg
  },
  data () {
    return {
      email: '',
      password: '',
      msg: '',
      mailReg: /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/
    }
  },
  methods: {
    _login: function () {
      if (!this.mailReg.test(this.email)) {
        this.msg = '邮箱格式不正确哦'
        return false
      }
      if (!this.password) {
        this.msg = '请先输入密码哦'
        return false
      }
      axios.post('index.php/Home/Index/loginAuthentication', qs.stringify({ 'email': this.email, 'password': this.password }))
      .then(res => {
        if (res.data.code !== 1) {
          this.msg = res.data.msg
        } else {
          this.$router.push({ path: '/index' })
          this.$emit('setName', {'nick_name': res.data.nick_name, 'create_time': res.data.create_time})
        }
      })
      .catch(() => {
        this.msg = '网络错误'
      })
    },
    _hideMsg: function () {
      this.msg = ''
    }
  }
}
</script>
<style lang="scss" scoped>
  .login{
    button{
      margin-top: 1rem;
    }
    span{
      font-size: 0.34rem;
      display: block;
      margin-top: 0.6rem;
      font-weight: bold;
    }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-to {
      opacity: 0
    }
  }
</style>
