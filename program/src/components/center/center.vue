<template>
  <div class="center">
    <top></top>
    <div id="user_info">
      <div id="user_name">{{ nickName }}</div>
      <div id="create_time">{{ createTime }}</div>
    </div>
    <button class="btn btn-black center" @click="_loginOut()">退出登录</button>
  </div>
</template>
<script>
import Top from '@/components/common/top'
import axios from 'axios'
export default {
  components: {
    Top
  },
  data () {
    return {
      nickName: '',
      createTime: ''
    }
  },
  created () {
    this._setInfo()
  },
  methods: {
    _loginOut: function () {
      axios.post('index.php/Home/Index/login_out')
        .then(res => {
          localStorage.userInfo = '{"nick_name":"","isLogin":false,"create_time":""}'
          localStorage.pathHis = '["/index"]'
          res.data.code === 1 ? this.$router.push({ path: '/home' }) : console.log(res.data.msg)
        })
        .catch(() => {
          console.log('网络错误')
        })
    },
    _setInfo: function () {
      let userInfo = JSON.parse(localStorage.userInfo)
      this.nickName = userInfo.nick_name
      this.createTime = userInfo.create_time
    }
  }
}
</script>

<style lang="scss" scoped>
.center {
  #user_info {
    margin: 0 auto;
    background-color: #333;
    padding: 1rem 0;
    color: #fff;
    text-align: center;
    #user_name {
      font-size: 1rem;
      margin-bottom: 0.3rem;
    }
    #create_time {
      font-size: 0.6rem;
    }
  }
  button {
    margin-top: 2rem;
  }
}
</style>

