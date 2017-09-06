$(function () {
'use strict'

	var $cdTop = $('.cd-top')

	$(window).on('scroll', function () {
		var top = document.body.scrollTop
		if (top > 200) {
			$cdTop.show()
		} else {
			$cdTop.hide()
		}
	})

	function runScroll() {
		scrollTo(document.body, 0, 600);
	}
	$cdTop.on('click', runScroll)

	function scrollTo(element, to, duration) {
		if (duration <= 0) {
			return
		}
		var difference = to - element.scrollTop
		var perTick = difference / duration * 10
		setTimeout(function() {
			element.scrollTop = element.scrollTop + perTick
			if (element.scrollTop == to) {
				return
			}
			scrollTo(element, to, duration - 10)
		}, 10)
	}

})
$(function () {
'use strict'

	var $cdTop = $('.cd-tel')

	$(window).on('scroll', function () {
		var top = document.body.scrollTop
		if (top > -10) {
			$cdTop.show()
		} else {
			$cdTop.hide()
		}
	})


	function scrollTo(element, to, duration) {
		if (duration <= 0) {
			return
		}
		var difference = to - element.scrollTop
		var perTick = difference / duration * 10
		setTimeout(function() {
			element.scrollTop = element.scrollTop + perTick
			if (element.scrollTop == to) {
				return
			}
			scrollTo(element, to, duration - 10)
		}, 10)
	}

})