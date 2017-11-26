<template>
  <div class="registered">
    <top></top>
    <div v-if="UserName">
      <h2 class="reg-h2">你好，你想我怎么称呼你？</h2>
      <input type="text" class="reg-input" v-model="username">
      <span class="reg-tip" v-if="username.length > 6 || !username">昵称不能为空并且长度不能超过6位</span>
    </div>
    <div v-if="Email">
      <h2 class="reg-h2">你的邮箱是？</h2>
      <input type="text" class="reg-input" v-model="email">
    </div>
    <div v-if="Password">
      <h2 class="reg-h2">你的密码是？</h2>
      <input type="password" class="reg-input" v-model="password">
      <h2 class="reg-h2">还记得刚才输的密码吗？</h2>
      <input type="password" class="reg-input" v-model="passwordAgain">
    </div>
    <div>
      <button ref="pre" class="btn btn-black reg-btn-left" v-if="!UserName" @click="_pre()">上一步</button>
      <button ref="next" class="btn btn-black reg-btn-right" v-if="!Password" @click="_next()">下一步</button>
      <button ref="register" class="btn btn-black reg-btn-right" v-if="Password" @click="_register()">注册</button>
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
      transitionName: 'slide-left',
      step: 1,
      UserName: true,
      Email: false,
      Password: false,
      username: '',
      email: '',
      password: '',
      passwordAgain: '',
      msg: '',
      mailReg: /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/
    }
  },
  methods: {
    _whichShow: function (step) {
      switch (step) {
        case 1 :
          this.UserName = true
          this.Email = false
          this.Password = false
          break
        case 2:
          this.UserName = false
          this.Email = true
          this.Password = false
          break
        case 3:
          this.UserName = false
          this.Email = false
          this.Password = true
          break
      }
    },
    _next: function () {
      this.step <= 2 ? this.step++ : this.step = 3
      this._whichShow(this.step)
    },
    _pre: function () {
      this.step >= 2 ? this.step-- : this.step = 3
      this._whichShow(this.step)
    },
    _register: function () {
      if (this.username.length > 6 || !this.username) {
        this.msg = '请仔细阅读昵称规则哦'
        return false
      }
      if (!this.mailReg.test(this.email)) {
        this.msg = '邮箱格式不正确哦'
        return false
      }
      if (this.password !== this.passwordAgain) {
        this.msg = '两次输入的密码不一样哦'
        return false
      }
      axios.post('index.php/Home/Index/registeredUser', qs.stringify({ 'nick_name': this.username, 'email': this.email, 'password': this.password, 'password_again': this.passwordAgain }))
      .then(res => {
        if (res.data.code === 1) {
          this.msg = res.data.msg
          setTimeout(() => {
            this.$router.push({ path: '/login' })
          }, 2000)
        } else if (res.data.code === 0) {
          this.msg = res.data.msg
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
.registered {
  height: 100%;
  .router {
    position: absolute;
    top: 1.28rem;
    bottom: 0;
    left: 0;
    right: 0;
  }
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to {
  opacity: 0
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
