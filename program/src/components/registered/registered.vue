<template>
  <div class="registered">
    <top></top>
    <transition :name="transitionName">
      <router-view class="router" />
    </transition>
  </div>
</template>
<script>
import Top from '@/components/common/top'
export default {
  components: {
    Top
  },
  data () {
    return {
      transitionName: 'slide-left'
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
