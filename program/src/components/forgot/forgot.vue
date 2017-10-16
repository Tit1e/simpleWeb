<template>
  <div class="forgot">
    <top></top>
    <div v-if="!isChecked">
      <h2 class="reg-h2">你注册时的邮箱是？</h2>
      <input type="text" class="reg-input" v-model="email">
      <button type="button" class="btn btn-black center" @click="_checkMail()">验证</button>
      <router-link tag="span" class="center" to="/login" :email="email">我想起密码了！</router-link>
    </div>
    <div v-if="isChecked">
      <h2 class="reg-h2">你的新密码是？</h2>
      <input type="password" class="reg-input" v-model="password">
      <h2 class="reg-h2">还记得刚才输的密码吗？</h2>
      <input type="password" class="reg-input" v-model="psdAgain">
      <button @click="_changePsd()" class="btn btn-black center">修改密码</button>
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
      isChecked: false
    }
  },
  methods: {
    _checkMail: function () {
      axios.post('index.php/Home/Index/checkMail', qs.stringify({ 'email': this.email }))
      .then(res => {
        res.data.code === 1 ? this.isChecked = !this.isChecked : console.log(res.data.msg)
      })
      .catch(() => {
        console.log('网络错误')
      })
    },
    _changePsd: function () {
      axios.post('index.php/Home/Index/changePsd', qs.stringify({ 'email': this.email, 'password': this.password, 'password_again': this.psdAgain }))
      .then(res => {
        res.data.code === 1 ? this.$router.push({path: '/login'}) : console.log(res.data.msg)
      })
      .catch(() => {
        console.log('网络错误')
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.forgot{
  button{
    margin-top: 2rem;
  }
  span{
    font-size: 0.34rem;
    display: block;
    margin-top: 0.6rem;
    font-weight: bold;
  }
}
</style>
