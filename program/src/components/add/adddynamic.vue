<template>
  <div class="adddynamic">
    <top></top>
    <item-show :content="dynamic"></item-show>
    <textarea rows="8" placeholder="上面可以预览你动态发布后的样子" v-model="dynamic"></textarea>
    <div class="sent_button">
      <button type="button" class="btn btn-black center" @click="_issueDynamic()">发布</button>
    </div>
    <transition name="fade">
      <msg v-bind:msg="msg" v-if="msg" v-on:HideMsg="_hideMsg"></msg>
    </transition>
  </div>
</template>
<script>
import Top from '@/components/common/top'
import ItemShow from '@/components/common/itemshow'
import Msg from '@/components/msg/msg'
import axios from 'axios'
import qs from 'qs'
export default {
  components: {
    Top,
    ItemShow,
    Msg
  },
  data () {
    return {
      dynamic: '',
      userInfo: {},
      msg: ''
    }
  },
  methods: {
    _issueDynamic: function () {
      if (!this.dynamic) {
        this.msg = '发布内容不能为空'
        return false
      }
      axios.post('index.php/Home/Index/release', qs.stringify({ 'content': this.dynamic }))
      .then(res => {
        if (res.data.code === 1) {
          location.reload()
        } else if (res.data.code === 0) {
          this.msg = res.data.msg
        } else if (res.data.code === -1) {
          this.$router.push({path: '/login'})
        }
      })
      .catch(() => {
        this.msg = '服务器好像出了点问题呢'
      })
    },
    _hideMsg: function () {
      this.msg = ''
    }
  }
}
</script>
<style lang="scss" scoped>
.adddynamic {
  textarea {
    display: block;
    width: 80%;
    margin: 1rem auto 0.7rem auto;
    padding: 0.3rem;
    border-radius: 5px;
    border: 1px solid #333;
    box-sizing: border-box;
    line-height: 0.4rem;
    background-color: #fff;
    color: #333;
  }
  p {
    color: #e55f5f;
    text-align: center;
    font-size: 0.35rem;
    font-weight: bold;
    margin-top: 0.4rem;
  }
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to {
  opacity: 0
}
</style>
