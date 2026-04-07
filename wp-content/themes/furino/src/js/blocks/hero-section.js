import {
	delegate,
} from 'lib/dom'

export default el => {
	const heroImage = el.querySelector('.hero-section__image')

	if (heroImage) {
		heroImage.style.transition = 'transform 220ms ease, filter 220ms ease'
		heroImage.style.transformOrigin = 'center center'

		heroImage.addEventListener('mouseenter', () => {
			heroImage.style.transform = 'scale(1.03)'
			heroImage.style.filter = 'brightness(1.03)'
		})

		heroImage.addEventListener('mouseleave', () => {
			heroImage.style.transform = 'scale(1)'
			heroImage.style.filter = 'brightness(1)'
		})

		heroImage.addEventListener('click', () => {
			heroImage.animate(
				[
					{ transform: 'scale(1.03)' },
					{ transform: 'scale(0.98)' },
					{ transform: 'scale(1.03)' }
				],
				{
					duration: 280,
					easing: 'ease-out'
				}
			)
		})
	}

	if (process.env.NODE_ENV === 'development') {
		console.log('[furino] hero-section initialized')
	}

	delegate(el, 'click', '.js-scroll-to', (e) => {
		e.preventDefault()
		const href = e.delegateTarget.getAttribute('href')

		if (href && href.startsWith('#')) {
			const targetSection = document.querySelector(href)
			if (targetSection) {
				targetSection.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				})
			}
		} else if (href) {
			const targetSection = document.getElementById(href)
			if (targetSection) {
				targetSection.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				})
			}
		}
	})
}
