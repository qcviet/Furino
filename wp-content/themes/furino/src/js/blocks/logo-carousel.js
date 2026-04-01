import Swiper from 'swiper';
import { Autoplay } from 'swiper/modules';
import { select, on, loadNoscriptContent } from 'lib/dom';
import { throttle } from 'lib/utils';

export default (el) => {
	let swiper = null;
	let swiperEl = null;
	const mainEl = select('.js-main', el);

	const init = () => {
		if (!mainEl) return;

		if (swiper) return;

		loadNoscriptContent(mainEl);

		swiperEl = select('.js-swiper', el);

		if (!swiperEl) return;

		if (swiperEl) {
			swiper = new Swiper(swiperEl, {
				modules: [Autoplay],
				slidesPerView: 3,
				spaceBetween: 24,
				direction: 'horizontal',
				height: 'auto',
				loop: true,
				speed: 6000,
				autoplay: {
					delay: 0,
					reverseDirection: true,
				},
				breakpoints: {
					960: {
						slidesPerView: 6,
						spaceBetween: 24,
					},
				},
			});
		}
	};

	init();

	on('scroll', throttle(init, 50), window);
};
