<template>
  <div class="item">
    <router-link tag="div" :to="'/person/id/' + list.user_id" class="list" v-for="(list,index) in Lists" :key="list.dynamic_id">
        <div class="name">
          {{ list.nick_name }}
          <div class="time">
            {{ list.time}}
          </div>
        </div>
      <div class="dy_content">
          <pre>{{ list.content }}</pre>
          <!-- <a v-if="list.dy_pic" :href="'http://opo1g1k78.bkt.clouddn.com/' + list.dy_picture" target="_blank">
              <img class="dy_pic" :src="'http://opo1g1k78.bkt.clouddn.com/' + list.sm_dy_pic">
          </a> -->
      </div>
    </router-link>
  </div>
</template>
<script>
export default {
  props: ['Lists']
}
</script>
<style lang="scss" scoped>
.list {
  padding: 0.3rem 4%;
  border-left: 2px solid #333;
  margin-left: 10%;
  position: relative;
  font-size: 0.34rem;
  .name {
    display: inline-block;
    background-color: #333;
    color: #fff;
    border-radius: 3px;
    padding: 0.1rem 0.2rem;
    font-size: 0.3rem;
    font-weight: bold;
    position: absolute;
    line-height: 0.5rem;
    left: 0%;
    top: 0.3rem;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    .time {
      display: inline-block;
      font-size: 0.3rem;
      position: absolute;
      left: 110%;
      top: 50%;
      color: #333;
      -webkit-transform: translateY(-50%);
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -o-transform: translateY(-50%);
      transform: translateY(-50%);
      width: 6rem;
      font-weight: 400;
    }
  }
  .dy_content {
    display: block;
    box-sizing: border-box;
    margin-top: 1rem;
    border: 1px solid #333;
    border-radius: 3px;
    background-color: #fff;
    padding: 0.2rem 0.3rem;
    pre {
      display: block;
      box-sizing: border-box;
      white-space: pre-wrap;
      letter-spacing: 0.03rem;
      font-size: 0.4rem;
      line-height: 0.6rem;
      background-color: #fff;
      color: #333;
      text-align: justify;
      word-wrap: break-word;
    }
    img{
      width: 100%;
      margin-top: 0.3rem;
    }
  }
}
</style>
