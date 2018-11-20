import $ from 'jquery'
import AOS from 'aos'

$(function ($) {
  AOS.init({
    easing: 'ease-in-out',
    once: true,
  })

  let $topPart = $('.logo-animation .top-part')

  window.onscroll = function () {
    var scrolled = window.pageYOffset || document.documentElement.scrollTop
    if (scrolled > 10) {
      $topPart.addClass('to-left')
    } else {
      $topPart.removeClass('to-left')
    }

  }
})
