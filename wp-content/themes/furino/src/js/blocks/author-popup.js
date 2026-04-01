import {
	delegate,
	addClass,
	removeClass,
	appendHtml,
	getNoScriptContent,
	loadNoscriptContent
} from 'lib/dom'

export default el => {
  const closePopup = (popup) => {
    popup.classList.add('hidden');
    document.body.style.overflow = '';
  };
  const openPopup = (popup) => {
    popup.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  };
  const closeButton = el.querySelector('.author-popup__close');
  if (closeButton) {
    closeButton.addEventListener('click', () => {
      closePopup(el);
    });
  }
  el.addEventListener('click', (e) => {
    if (e.target === el) {
      closePopup(el);
    }
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !el.classList.contains('hidden')) {
      closePopup(el);
    }
  });
  const popupContent = el.querySelector('.author-popup__content');
  if (popupContent) {
    popupContent.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  }
}
