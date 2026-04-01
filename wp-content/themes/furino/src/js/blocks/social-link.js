import {
	select,
	on,
	copyTextToClipboard,
	addClass,
	removeClass,
	hasClass,
	getData,
	setStyle
} from 'lib/dom'

class SocialLinks {
	constructor() {
		this.init();
	}

	init() {
		this.bindEvents();
	}

	bindEvents() {
		document.addEventListener('click', (e) => {
			const socialLink = e.target.closest('.social-links__item');
			if (!socialLink) return;

			if (socialLink.dataset.type === 'clipboard') {
				e.preventDefault();
				this.handleCopyLink(socialLink);
			}
		});
	}

	bindEvents() {
		document.addEventListener('click', (e) => {
			const socialLink = e.target.closest('.social-links-projects__item');
			if (!socialLink) return;

			if (socialLink.dataset.type === 'clipboard') {
				e.preventDefault();
				this.handleCopyLink(socialLink);
			}
		});
	}
	async handleCopyLink(element) {
		try {
			await navigator.clipboard.writeText(window.location.href);
			element.classList.add('is-copied');

			setTimeout(() => {
				element.classList.remove('is-copied');
			}, 2000);
		} catch (err) {
			console.error('Failed to copy link:', err);
		}
	}
}

// Initialize
new SocialLinks();
