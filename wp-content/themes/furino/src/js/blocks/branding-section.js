import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

export default el => {
	const titles = Array.from(el.querySelectorAll('.branding-section__title')).map(title => title.textContent);
	const swiper = new Swiper(el.querySelector('.js-swiper'), {
		modules: [Navigation, Pagination],
		slidesPerView: 1,
		spaceBetween: 0,
		loop: true,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
			renderBullet: function (index, className) {
				return `<div class="${className}"><span>${titles[index]}</span></div>`;
			},
		},
		effect: 'fade',
		fadeEffect: {
			crossFade: true
		}
	});
}