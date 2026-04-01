import {
	delegate,
	addClass,
	removeClass,
	appendHtml,
	getNoScriptContent,
	loadNoscriptContent
} from 'lib/dom'

export default el => {
	delegate(el, 'click', '.js-scroll-to', (e) => {
		e.preventDefault();
		const href = e.delegateTarget.getAttribute('href');

		if (href && href.startsWith('#')) {
			const targetSection = document.querySelector(href);
			if (targetSection) {
				targetSection.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		} else if (href) {
			const targetSection = document.getElementById(href);
			if (targetSection) {
				targetSection.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		}
	});
}
