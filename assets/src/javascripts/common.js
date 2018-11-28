import $ from 'jquery'
import AOS from 'aos'
import SVG from 'svg.js'

function getRand (min, max) {
  return Math.random() * (max - min) + min
}

$(function ($) {
  AOS.init({
    easing: 'ease-in-out',
    once: true,
  })

  let $topPart = $('.logo-animation .top-part, .logo-animation .right-part')

  function adjustLogo () {
    var scrolled = window.pageYOffset || document.documentElement.scrollTop
    if (scrolled > 10) {
      $topPart.addClass('to-left')
    } else {
      $topPart.removeClass('to-left')
    }
  }

  window.onscroll = adjustLogo
  adjustLogo()

  if ($('body').hasClass('home')) {
    setInterval(function () {
      //$topPart.toggleClass('to-left')
    }, 20000)
  }

  // Animations
  function arrowsAnimation () {
    arrows.animate(3000).
      dmove(80, 0).
      loop(1000, true)
  }

  function homeAnimation (element) {
    let r = Math.random()
    element.animate(4000).
      dmove(15 * r, 15 * r).
      animate(4000).
      dmove(-10 * r, -5 * r).
      animate(4000).
      dmove(-10 * r, -5 * r).
      animate(4000).
      dmove(5 * r, -5 * r).
      after(function () {
        homeAnimation(element)
      })
  }

  if ($('#front-page').length) {
    var front = SVG.get('#front-page'),
      projects = front.select('#home-projects'),
      shop = front.select('#home-shop'),
      about = front.select('#home-about'),
      films = front.select('#home-films'),
      arrows = front.select('#Arrows')

    arrowsAnimation()
    homeAnimation(about)
    homeAnimation(films)
    homeAnimation(projects)
    homeAnimation(shop)

    about.mouseover(function () { this.pause() })
    shop.mouseover(function () { this.pause() })
    films.mouseover(function () { this.pause() })
    projects.mouseover(function () { this.pause() })
    about.mouseout(function () { this.play() })
    shop.mouseout(function () { this.play() })
    films.mouseout(function () { this.play() })
    projects.mouseout(function () { this.play() })
  }
})
