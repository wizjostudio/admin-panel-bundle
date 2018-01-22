import axios from 'axios'
import Vue from 'vue'
import Translator from 'bazinga-translator'

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

$Scriber.$t = Vue.prototype.$t = Translator

global.Vue = Vue
global.axios = axios
global.$Scriber = $Scriber
global.Translator = Translator
