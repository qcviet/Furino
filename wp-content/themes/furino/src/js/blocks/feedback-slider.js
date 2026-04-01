import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

export default el => {
  new Swiper(el.querySelector('.js-swiper'), {
    modules: [Navigation, Pagination],
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    initialSlide: 0,
    centeredSlides: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      }
    }
  });
}