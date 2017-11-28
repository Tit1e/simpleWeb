<template>
  <div class="person">
    <scroll ref="scroll" class="content-list" :data="Lists" :pullup="pullup" v-on:scrollToEnd="_nextPage()">
      <div>
        <top></top>
        <div id="nick_name">{{ nickName }}</div>
        <itemperson :lists="Lists"></itemperson>
        <div id="since">Since {{ since }}</div>
      </div>
  </scroll>
  </div>
</template>
<script>
import Top from '@/components/common/top'
import Itemperson from '@/components/common/itemperson'
import Scroll from '@/components/common/scroll'
import axios from 'axios'
import qs from 'qs'
export default {
  components: {
    Itemperson,
    Scroll,
    Top
  },
  data () {
    return {
      Lists: [],
      page: 1,
      nickName: '',
      since: '',
      isAllData: false,
      pullup: true
    }
  },
  created () {
    this._getPerson(this.page)
  },
  watch: {
    '$route' (to, from) {
      this._getPerson(this.page)
    }
  },
  methods: {
    _getPerson: function (page) {
      if (this.isAllData) {
        this.page--
        return false
      }
      let userId = this.$route.params.id
      axios.post('index.php/Home/Index/person', qs.stringify({'user_id': userId, 'page': page}))
      .then(res => {
        if (res.data.data.length < 10 || res.data.data.length === 0) {
          this.isAllData = true
        }
        this.nickName = res.data.nick_name
        this.since = res.data.since
        if (this.Lists.length) {
          this.Lists = [...this.Lists, ...res.data.data]
        } else {
          this.Lists = res.data.data
        }
      })
      .catch(() => {
        console.log('网络错误')
      })
    },
    _nextPage: function () {
      this.page++
      this._getPerson(this.page)
    }
  }
}
</script>
<style lang="scss" scoped>
.person {
  position: fixed;
  width: 100%;
  top: 0;
  bottom: 0;
  .content-list{
    height: 100%;
    overflow: hidden;
    #nick_name {
      position: absolute;
      top: 1.28rem;
      left: 0%;
      font-size: 0.6rem;
      padding: 0rem 0.5rem;
      background-color: #333;
      color: #fff;
      font-weight: bold;
      width: 100%;
      height: 1rem;
      box-sizing: border-box;
      line-height: 1rem;
    }
    #since {
      font-size: 0.6rem;
      padding: 0rem 0.5rem;
      background-color: #333;
      color: #fff;
      font-weight: bold;
      width: 100%;
      height: 1rem;
      box-sizing: border-box;
      line-height: 1rem;
    }
  }
  
}
</style>
