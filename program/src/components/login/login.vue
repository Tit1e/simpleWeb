<template>
  <div class="login">
    <top></top>
    <div>
      <h2 class="login-h2">你注册时的邮箱是？</h2>
      <input type="text" class="reg-input" v-model="email">
      <h2 class="login-h2">你注册时的密码是？</h2>
      <input type="password" class="reg-input" v-model="password">
      <button class="center btn btn-white" @click="_login()">登录</button>
      <span class="center">忘记密码点这里</span>
    </div>
  </div>
</template>
<script>
import Top from '@/components/common/top'
import axios from 'axios'
import qs from 'qs'
export default {
  components: {
    Top
  },
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    _login: function () {
      axios.post('index.php/Home/Index/loginAuthentication', qs.stringify({ 'email': this.email, 'password': this.password }))
      .then(res => {
        if (res.data.code !== 1) {
          console.log('登录失败')
        } else {
          this.$router.push({ path: '/index' })
          this.$emit('setName', {'nick_name': res.data.nick_name, 'create_time': res.data.create_time})
        }
      })
      .catch(() => {
        console.log('网络错误')
      })
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
  }
</style>
