import {
	delegate,
	addClass,
	removeClass,
	appendHtml,
	getNoScriptContent,
	loadNoscriptContent
} from 'lib/dom'

export default el => {
	console.log('Initializing job listing section', el);

	const prevButton = el.querySelector('.job-listing-section__pagination-prev')
	const nextButton = el.querySelector('.job-listing-section__pagination-next')

	if (!prevButton || !nextButton) {
		console.log('Missing pagination buttons');
		return;
	}

	const updatePageParameter = (page) => {
		const url = new URL(window.location.href)
		url.searchParams.set('paged', page)
		return url.toString()
	}
	if (prevButton) {
		prevButton.addEventListener('click', (e) => {
			e.preventDefault();
			const page = parseInt(prevButton.dataset.page)
			if (page > 0) {
				window.location.href = updatePageParameter(page);
			}
		})
	}

	if (nextButton) {
		nextButton.addEventListener('click', (e) => {
			e.preventDefault();
			const page = parseInt(nextButton.dataset.page)
			const totalPages = parseInt(el.querySelector('.job-listing-section__pagination-total')?.textContent || '0')
			if (page <= totalPages) {
				window.location.href = updatePageParameter(page);
			}
		})
	}
}
