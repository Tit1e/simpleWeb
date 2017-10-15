import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/home/home'
import Article from '@/components/home/article'
import Registered from '@/components/registered/registered'
import Username from '@/components/registered/username'
import Email from '@/components/registered/email'
import Password from '@/components/registered/password'
import Login from '@/components/login/login'
import Index from '@/components/index/index'
import Adddymnamic from '@/components/add/Adddynamic'
import Person from '@/components/person/person'
import Center from '@/components/center/center'

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
      component: Registered,
      children: [
        {
          path: '/',
          redirect: '/registered/username'
        },
        {
          path: '/registered/username',
          component: Username
        },
        {
          path: '/registered/email',
          component: Email
        },
        {
          path: '/registered/password',
          component: Password
        }
      ]
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
    }
  ]
})
