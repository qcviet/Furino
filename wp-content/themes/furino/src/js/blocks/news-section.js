import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

export default el => {
  let swiper = null;
  const MOBILE_BREAKPOINT = 781;

  const initSwiper = () => {
    if (window.innerWidth < MOBILE_BREAKPOINT && !swiper) {
      swiper = new Swiper(el.querySelector('.js-swiper'), {
        modules: [Navigation, Pagination],
        slidesPerView: 1,
        spaceBetween: 16,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });
    } else if (window.innerWidth >= MOBILE_BREAKPOINT && swiper) {
      swiper.destroy();
      swiper = null;
    }
  };

  initSwiper();

  window.addEventListener('resize', initSwiper);

  return () => {
    window.removeEventListener('resize', initSwiper);
    if (swiper) {
      swiper.destroy();
      swiper = null;
    }
  };
};
