import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import './postcss/frontend.css'

import init from 'lib/init-blocks'

document.addEventListener('DOMContentLoaded', () => {
	init({
		block: 'blocks'
	}).mount()
})
