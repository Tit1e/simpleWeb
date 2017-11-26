<template>
  <div class="msg">
      <div class="alertMsg">
        {{ msg }}
      </div>
  </div>
</template>
<style lang="scss">
  .msg{
    .alertMsg{
      color: #fff;
      background-color: #333;
      border-radius: 3px;
      padding: .15rem .3rem;
      font-size: 14px;
      position: fixed;
      bottom: 100px;
      left: 50%;
      transform: translateX(-50%);
    }
  }
</style>
<script>
export default {
  props: ['msg'],
  mounted () {
    setTimeout(() => {
      this.$emit('HideMsg')
    }, 2000)
  }
}
</script>

