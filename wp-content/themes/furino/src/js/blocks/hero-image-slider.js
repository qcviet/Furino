import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

export default el => {
  const mainSwiper = new Swiper(el.querySelector('.hero-image-slider__main'), {
		loop: true,
    modules: [Navigation],
    spaceBetween: 0,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });
}
