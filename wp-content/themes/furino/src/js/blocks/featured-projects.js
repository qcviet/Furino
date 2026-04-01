import Swiper from 'swiper';
import { Navigation, EffectCreative } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

export default el => {
  if (!el) return;

  const itemsContainer = el.querySelector('.featured-projects__items');
  const cards = el.querySelectorAll('.featured-projects__card');
  if (!cards.length || !itemsContainer) return;

  let swiper = null;
  let isMobileView = window.innerWidth <= 781;
  let originalStructure = null;

  const saveOriginalStructure = () => {
    originalStructure = itemsContainer.cloneNode(true);
  };

  const initializeMobileSwiper = () => {
    if (swiper) return;

    itemsContainer.classList.add('swiper');
    const swiperWrapper = document.createElement('div');
    swiperWrapper.className = 'swiper-wrapper';

    const pagination = itemsContainer.querySelector('.featured-projects__pagination');

    Array.from(cards).forEach(card => {
      card.classList.add('swiper-slide');
      swiperWrapper.appendChild(card);
    });

    itemsContainer.innerHTML = '';
    itemsContainer.appendChild(swiperWrapper);

    if (pagination) {
      itemsContainer.appendChild(pagination);
      const prevButton = pagination.querySelector('.featured-projects__pagination-button:first-child');
      const nextButton = pagination.querySelector('.featured-projects__pagination-button:last-child');

      prevButton?.classList.add('swiper-button-prev');
      nextButton?.classList.add('swiper-button-next');
    }

    swiper = new Swiper(itemsContainer, {
      modules: [Navigation, EffectCreative],
      slidesPerView: 1,
      centeredSlides: true,
      spaceBetween: 30,
      grabCursor: true,
      loop: true,
      effect: 'creative',
      creativeEffect: {
        prev: {
          translate: ['-20%', 0, -1],
          opacity: 0.5,
          scale: 0.9
        },
        next: {
          translate: ['100%', 0, 0],
          opacity: 0.5,
          scale: 0.9
        }
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
        hideOnClick: false
      }
    });
  };

  const restoreDesktopView = () => {
    if (swiper) {
      swiper.destroy(true, true);
      swiper = null;
    }

    if (originalStructure) {
      const newElement = originalStructure.cloneNode(true);
      itemsContainer.parentNode.replaceChild(newElement, itemsContainer);
      return newElement;
    }
    return itemsContainer;
  };

  const handleResize = () => {
    const wasInMobileView = isMobileView;
    isMobileView = window.innerWidth <= 781;

    if (wasInMobileView !== isMobileView) {
      if (isMobileView) {
        initializeMobileSwiper();
      } else {
        const newContainer = restoreDesktopView();
        // Update references after DOM changes
        if (newContainer !== itemsContainer) {
          itemsContainer = newContainer;
          cards = itemsContainer.querySelectorAll('.featured-projects__card');
        }
      }
    }
  };
  saveOriginalStructure();
  if (isMobileView) {
    initializeMobileSwiper();
  }

  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(handleResize, 250);
  });
}