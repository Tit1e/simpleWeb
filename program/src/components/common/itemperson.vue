<template>
  <div class="itemperson">
    <div class="list" v-for="list in lists">
      <div class="dy_time">
        {{ list.time}}
      </div>
      <div class="dy_content">
        <pre>{{ list.content}}</pre>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['lists']
}
</script>
<style lang="scss" scoped>
.itemperson {
  padding-top: 1rem;
  .list {
    padding: 0.3rem 4%;
    border-left: 2px solid #333;
    margin-left: 10%;
    position: relative;
    .dy_time {
      display: inline-block;
      background-color: #333;
      color: #fff;
      padding: 0.1rem 0.2rem;
      font-size: 0.3rem;
      font-weight: bold;
      line-height: 0.5rem;
      left: 0%;
      top: 0.3rem;
      position: absolute;
      border-radius: 0px 3px 3px 0px;
      left: -5%;
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
    }
  }
}
</style>
