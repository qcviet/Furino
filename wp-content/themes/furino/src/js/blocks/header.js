import {
	delegate,
	addClass,
	removeClass,
	appendHtml,
	getNoScriptContent,
	loadNoscriptContent
} from 'lib/dom'

export default el => {
	const languageSwitcher = el.querySelector('.language-switcher')
	const languageSwitcherCurrent = el.querySelector('.language-switcher__current')
	const languageLinks = el.querySelectorAll('.language-switcher__dropdown a')

	if (!languageSwitcher || !languageSwitcherCurrent) return
	languageSwitcherCurrent.addEventListener('click', () => {
		languageSwitcher.classList.toggle('is-active')
	})

	document.addEventListener('click', (event) => {
		if (!languageSwitcher.contains(event.target)) {
			languageSwitcher.classList.remove('is-active')
		}
	})
	languageLinks.forEach(link => {
		link.addEventListener('click', (e) => {
			e.preventDefault()
			const lang = link.getAttribute('data-lang')
			const langText = link.querySelector('.language-text').textContent
			const langIcon = link.querySelector('.language-icon').innerHTML
			languageSwitcherCurrent.querySelector('.language-text').textContent = langText
			languageSwitcherCurrent.querySelector('.language-icon').innerHTML = langIcon
			languageSwitcher.classList.remove('is-active')
		})
	})

	const menuToggle = el.querySelector('.menu-toggle')
	const fullscreenMenu = el.querySelector('.fullscreen-menu')
	const closeButton = el.querySelector('.fullscreen-menu__close')

	if (menuToggle && fullscreenMenu && closeButton) {
		menuToggle.addEventListener('click', () => {
			fullscreenMenu.classList.add('is-active')
			document.body.style.overflow = 'hidden'
		})

		closeButton.addEventListener('click', () => {
			fullscreenMenu.classList.remove('is-active')
			document.body.style.overflow = ''
		})

		fullscreenMenu.addEventListener('click', (e) => {
			if (e.target === fullscreenMenu) {
				fullscreenMenu.classList.remove('is-active')
				document.body.style.overflow = ''
			}
		})

		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && fullscreenMenu.classList.contains('is-active')) {
				fullscreenMenu.classList.remove('is-active')
				document.body.style.overflow = ''
			}
		})
	}
}
