import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import authorPopup from './author-popup';

export default el => {
  const swiper = new Swiper(el.querySelector('.js-swiper'), {
    modules: [Navigation, Pagination],
    slidesPerView: 1,
    loop: true,
    speed: 800,
    rtl: true,
    slideToClickedSlide: true,
    pagination: {
      el: '.swiper-pagination',
      type: 'fraction',
      renderFraction: function (currentClass, totalClass) {
        return '<span class="' + currentClass + '"></span>' +
               ' / ' +
               '<span class="' + totalClass + '"></span>';
      }
    },
    navigation: {
      prevEl: el.querySelector('.swiper-button-prev'),
      nextEl: el.querySelector('.swiper-button-next'),
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
      },
      781: {
        slidesPerView: 2,
      },
      320: {
        slidesPerView: 1,
        width: null
      }
    }
  });

  const popupWrappers = document.querySelectorAll('.author-popup-wrapper');
  popupWrappers.forEach(wrapper => {
    const popup = wrapper.querySelector('.author-popup');
    if (popup) {
      authorPopup(popup);
    }
  });

  const popupTriggers = el.querySelectorAll('[data-popup-trigger]');
  popupTriggers.forEach(trigger => {
    trigger.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      const authorId = this.getAttribute('data-author-id');
      const popupWrapper = document.querySelector(`.author-popup-wrapper[data-author-id="${authorId}"]`);
      if (popupWrapper) {
        popupWrapper.classList.remove('hidden');
        const popup = popupWrapper.querySelector('.author-popup');
        if (popup) {
          popup.classList.remove('hidden');
        }
        document.body.style.overflow = 'hidden';
      }
    });
  });
}
