import $ from 'jquery'
import AOS from 'aos'
import SVG from 'svg.js'

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
  function arrowsAnimation (front) {
    front.select('#arrow-0').
      animate(1000).
      scale(10, 10).
      scale(1, 1)
    front.select('#arrow-1').
      delay(500).
      animate(1000).
      scale(8, 8).
      scale(1, 1)
    front.select('#arrow-2').
      delay(1000).
      animate(1000).
      scale(10, 10).
      scale(1, 1).
      delay(2000).
      after(function () {
        arrowsAnimation(front)
      })
  }

  function circleAnimation (element) {
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
        circleAnimation(element)
      })
  }

  var mask = SVG.get('#forest')
  circleAnimation(mask.select('#mask-source'))

  if ($('#front-page').length) {
    var front = SVG.get('#front-page'),
      projects = front.select('#home-projects'),
      shop = front.select('#home-shop'),
      about = front.select('#home-about'),
      films = front.select('#home-films'),
      links = front.select('.zoom')

    arrowsAnimation(front)
    circleAnimation(about)
    circleAnimation(films)
    circleAnimation(projects)
    circleAnimation(shop)

    links.mouseover(function () { this.animate(150).scale(1.3, 1.3) }).
      mouseout(function () {this.animate(150).scale(1, 1)})
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
