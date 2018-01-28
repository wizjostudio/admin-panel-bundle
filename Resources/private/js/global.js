import axios from 'axios'
import Vue from 'vue'
import Translator from 'bazinga-translator'
import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

import $Scriber from './Scriber'

const nav = document.querySelector('.main-panel #navigation .navbar-nav')
const mobileNav = document.querySelector('.sidebar .nav-mobile-menu')
mobileNav.innerHTML = nav.innerHTML

const html = document.querySelector('html')
const sidebarToggle = document.getElementById('sidebar-toggle')

sidebarToggle.addEventListener('click', e => {
  e.preventDefault()
  html.classList.toggle('nav-open')
})

Translator.defaultDomain = 'admin'

Vue.use(BootstrapVue)
Vue.use(VueRouter)
Vue.use(Vuex)

Vue.use({
  install: (Vue, options) => {
    Vue.prototype.$t = Translator
    Vue.prototype.$http = axios
    Vue.prototype.$Scriber = $Scriber
  }
});

global.Vue = Vue
global.axios = axios
global.$Scriber = $Scriber
global.Translator = Translator
global.VueRouter = VueRouter
global.Vuex = Vuex
