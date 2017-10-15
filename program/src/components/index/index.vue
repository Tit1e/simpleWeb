<template>
  <div class="index">
    <scroll ref="scroll" class="content-list" :data="lists" :pullup="pullup" v-on:scrollToEnd="_nextPage()">
      <div>
        <top></top>
        <item :Lists="lists"></item>
        <div id="allData">{{ tip }}</div>
      </div>
    </scroll>
  </div>
</template>
<script>
import Top from '@/components/common/top'
import Item from '@/components/common/item'
import Scroll from '@/components/common/scroll'
import axios from 'axios'
import qs from 'qs'
export default {
  components: {
    Top,
    Item,
    Scroll
  },
  data () {
    return {
      lists: [],
      pullup: true,
      page: 1,
      isAllData: false,
      tip: ''
    }
  },
  mounted () {
    this._get_list(this.page)
  },
  methods: {
    _get_list: function (page) {
      if (this.isAllData) {
        this.page--
        this.tip = '>_< 没有数据啦'
        return false
      }
      this.tip = '正在加载数据...'
      axios.post('index.php/Home/Index/getList', qs.stringify({'page': page}))
      .then(res => {
        if (res.data.data.length < 10 || res.data.data.length === 0) {
          this.tip = '>_< 没有数据啦'
          this.isAllData = true
        }
        if (this.lists.length) {
          this.lists = [...this.lists, ...res.data.data]
        } else {
          this.lists = res.data.data
        }
        this.tip = '更多数据'
      })
      .catch((res) => {
        this.tip = '请求失败'
      })
    },
    _nextPage: function () {
      this.page++
      this._get_list(this.page)
    }
  }
}
</script>
<style lang="scss" scoped>
.index{
  position: fixed;
  width: 100%;
  top: 0;
  bottom: 0;
  .content-list{
    height: 100%;
    overflow: hidden;
    #allData{
      font-size: 0.4rem;
      background-color: #333;
      color: #fff;
      width: 100%;
      height: 1rem;
      box-sizing: border-box;
      line-height: 1rem;
      text-align: center;
    }
  }
}
</style>
