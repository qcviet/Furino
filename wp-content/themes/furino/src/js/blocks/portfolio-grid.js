import {
	delegate,
	addClass,
	removeClass,
	selectAll,
	select
} from 'lib/dom'

export default el => {
	if (!el) return

	const POSTS_PER_PAGE = 6

	const cards = selectAll('.portfolio-grid__card', el)
	const paginationContainer = select('.portfolio-grid__pagination', el)
	let currentPage = 1

	const dropdownButton = select('.portfolio-grid__category-button', el)
	const dropdownList = select('.portfolio-grid__category-list', el)
	const categoryLinks = selectAll('.portfolio-grid__category-link', el)

	if (dropdownButton && dropdownList) {
		dropdownButton.addEventListener('click', (e) => {
			e.stopPropagation()
			dropdownList.classList.toggle('active')
		})

		document.addEventListener('click', (e) => {
			if (!dropdownList.contains(e.target) && !dropdownButton.contains(e.target)) {
				dropdownList.classList.remove('active')
			}
		})
		categoryLinks.forEach(link => {
			link.addEventListener('click', (e) => {
				e.preventDefault()
				const selectedCategory = link.dataset.category
				categoryLinks.forEach(l => removeClass('active', l))
				addClass('active', link)
				dropdownButton.textContent = link.textContent
				cards.forEach(card => {
					const cardCategories = card.dataset.categories.split(',')
					if (!selectedCategory || cardCategories.includes(selectedCategory)) {
						card.style.display = ''
					} else {
						card.style.display = 'none'
					}
				})
				dropdownList.classList.remove('active')
			})
		})
	}

	const changePage = (pageNum) => {
		const totalPages = Math.ceil(cards.length / POSTS_PER_PAGE)
		if (pageNum < 1 || pageNum > totalPages) return

		const startIndex = (pageNum - 1) * POSTS_PER_PAGE
		const endIndex = startIndex + POSTS_PER_PAGE
		cards.forEach((card, index) => {
			if (index >= startIndex && index < endIndex) {
				card.style.display = ''
			} else {
				card.style.display = 'none'
			}
		})

		const buttonsContainer = select('.portfolio-grid__buttons', paginationContainer)
		const firstButton = buttonsContainer.querySelector('.portfolio-grid__button:first-child')
		const lastButton = buttonsContainer.querySelector('.portfolio-grid__button:last-child')

		firstButton.textContent = pageNum.toString()
		firstButton.dataset.page = pageNum.toString()
		firstButton.classList.add('active')
		lastButton.classList.remove('active')

		const prevArrow = select('.portfolio-grid__prev', paginationContainer)
		const nextArrow = select('.portfolio-grid__next', paginationContainer)

		prevArrow.classList.toggle('disabled', pageNum === 1)
		nextArrow.classList.toggle('disabled', pageNum === totalPages)

		currentPage = pageNum

		el.scrollIntoView({ behavior: 'smooth', block: 'start' })
	}

	if (cards.length > POSTS_PER_PAGE) {
		delegate('click', (e) => {
			e.preventDefault()
			const pageNum = parseInt(e.target.dataset.page)
			if (pageNum && pageNum !== currentPage) {
				changePage(pageNum)
			}
		}, '.portfolio-grid__button', paginationContainer)

		delegate('click', (e) => {
			e.preventDefault()
			const arrow = e.target.closest('.portfolio-grid__arrow')
			if (!arrow || arrow.classList.contains('disabled')) return

			if (arrow.classList.contains('portfolio-grid__prev')) {
				changePage(currentPage - 1)
			} else if (arrow.classList.contains('portfolio-grid__next')) {
				changePage(currentPage + 1)
			}
		}, '.portfolio-grid__arrow', paginationContainer)
	}
}
