import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/home/home'
import Article from '@/components/home/article'
import Registered from '@/components/registered/registered'
import Login from '@/components/login/login'
import Index from '@/components/index/index'
import Adddymnamic from '@/components/add/Adddynamic'
import Person from '@/components/person/person'
import Center from '@/components/center/center'
import Forgot from '@/components/forgot/forgot'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/index'
    },
    {
      path: '/home',
      component: Home
    },
    {
      path: '/article',
      component: Article
    },
    {
      path: '/registered',
      component: Registered
    },
    {
      path: '/login',
      component: Login
    },
    {
      path: '/index',
      component: Index
    },
    {
      path: '/add',
      component: Adddymnamic
    },
    {
      path: '/person/id/:id',
      component: Person
    },
    {
      path: '/center',
      component: Center
    },
    {
      path: '/forgot',
      component: Forgot
    }
  ]
})
