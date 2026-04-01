import {
	delegate,
	addClass,
	removeClass
} from 'lib/dom'

export default el => {
	if (!el) return;

	const pagination = el.querySelector('.portfolio-grid__pagination');
	if (!pagination) return;

	function goToPage(pageNumber) {
		const currentUrl = new URL(window.location.href);
		currentUrl.searchParams.set('paged', pageNumber);
		window.location.href = currentUrl.toString();
	}

	delegate(pagination, '.portfolio-grid__button', 'click', (e) => {
		const newPage = parseInt(e.target.dataset.page, 10);
		if (!isNaN(newPage)) {
			goToPage(newPage);
		}
	});

	delegate(pagination, '.portfolio-grid__prev:not(.disabled)', 'click', () => {
		const currentPage = parseInt(pagination.querySelector('.portfolio-grid__button.active').dataset.page, 10);
		goToPage(currentPage - 1);
	});

	delegate(pagination, '.portfolio-grid__next:not(.disabled)', 'click', () => {
		const currentPage = parseInt(pagination.querySelector('.portfolio-grid__button.active').dataset.page, 10);
		goToPage(currentPage + 1);
	});
}


