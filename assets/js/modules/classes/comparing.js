/* global mainState, jQuery */
/**
 * COMPARING
 * Methods for work with product comparing
 *
 * @constructor
 */
import Abstract from './abstract.js';

const Comparing = function() {
  Abstract.apply(this, arguments);
};

Comparing.prototype = Object.create(Abstract.prototype);
Comparing.prototype.constructor = Comparing;

Comparing.prototype.listenCompareBtns = function() {
  if (!document.querySelector('.compare-btn')) return;

  document.addEventListener('click', (e) => {
    const el = e.target;

    if (el.classList.contains('compare-btn') && !el.classList.contains('compare-btn--active')) {
      const id = el.parentElement.parentElement.dataset.id;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_add_to_comparing',
          data: {
            product_id: id,
          },
        },
        beforeSend() {
          el.disabled = true;
        },
        success(resp) {
          if (resp.success) {
            el.classList.add('compare-btn--active');
            el.closest('.product-item').classList.add('header__user-list--active');

            const compareLink = document.querySelector('.header__comparison-link');

            compareLink.classList.add('heartBeat');
            setTimeout(() => compareLink.classList.remove('heartBeat'), 1300);

            if (compareLink.children[1]) {
              const value = parseInt(compareLink.children[1].innerText);
              compareLink.children[1].innerText = value + 1;
            } else {
              const span = document.createElement('span');

              span.className = 'quantity-product-circle';
              span.innerText = '1';

              compareLink.appendChild(span);
            }
          }

          el.disabled = false;
        }
      });
    }

    if (el.classList.contains('compare-btn') && el.classList.contains('compare-btn--active')) {
      const id = el.parentElement.parentElement.dataset.id;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_remove_from_comparing',
          data: {
            product_id: id,
          },
        },
        beforeSend() {
          el.disabled = true;
        },
        success(resp) {
          if (resp.success) {
            el.classList.remove('compare-btn--active');
            el.closest('.product-item').classList.remove('header__user-list--active');

            const compareLink = document.querySelector('.header__comparison-link');
            const value = parseInt(compareLink.children[1].innerText);

            compareLink.classList.add('heartBeat');
            setTimeout(() => compareLink.classList.remove('heartBeat'), 2000);

            if (value - 1) {
              compareLink.children[1].innerText = value - 1;
            } else {
              compareLink.children[1].remove();
            }
          }

          el.disabled = false;
        }
      });
    }

  });
};

Comparing.prototype.initComparisonRemoveBtns = function() {
  if (!this.isComparison) return;

  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('compare__remove-bnt')) {
      const id = e.target.parentElement.dataset.id;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_remove_from_comparing',
          data: {
            product_id: id,
          },
        },
        success(resp) {
          if (resp.success) {
            document.querySelectorAll(`[data-product-id="${id}"]`).forEach(el => el.remove());

            if (!document.querySelector('[data-product-id]')) {
              document.querySelector('.compare__table').remove();
              document.querySelector('.compare__table-wrap').innerHTML = `
               <div class="search__result-title-box">
                <h2 class="secondary-title search__result-title">
                  ${mainState.i18n_comparingEmpty}
                </h2>
              </div>
              `;
              document.querySelector('.compare__table-wrap').classList.remove('compare__table-wrap');

              window.scrollTo({
                top: 0,
                behavior: 'smooth'
              });
            }

            const compareLink = document.querySelector('.header__comparison-link');
            const value = parseInt(compareLink.children[1].innerText);

            compareLink.classList.add('heartBeat');
            setTimeout(() => compareLink.classList.remove('heartBeat'), 2000);

            if (value - 1) {
              compareLink.children[1].innerText = value - 1;
            } else {
              compareLink.children[1].remove();
            }
          }
        },
      });
    }
  });
};

Comparing.prototype.setSingleCompareButton = function() {
  if (!this.isSingle) return;

  document.addEventListener('click', (e) => {
    const el = e.target;

    if (el.classList.contains('one-product__compare-link') &&
      !el.classList.contains('one-product__compare-link--active')) {
      const id = e.target.dataset.id;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_add_to_comparing',
          data: {
            product_id: id,
          },
        },
        success(resp) {
          if (resp.success) {
            el.innerText = mainState.i18n_inComparisonList;
            el.href = mainState.comparisonUrl;
            el.classList.add('one-product__compare-link--active');

            const compareLink = document.querySelector('.header__comparison-link');

            compareLink.classList.add('heartBeat');
            setTimeout(() => compareLink.classList.remove('heartBeat'), 1300);

            if (compareLink.children[1]) {
              const value = parseInt(compareLink.children[1].innerText);
              compareLink.children[1].innerText = value + 1;
            } else {
              const span = document.createElement('span');

              span.className = 'quantity-product-circle';
              span.innerText = '1';

              compareLink.appendChild(span);
            }
          }
        }
      });
    }
  });
};


Comparing.prototype.init = function() {
  // Archive
  this.listenCompareBtns();

  // Single product
  this.setSingleCompareButton();

  // Comparing page
  this.initComparisonRemoveBtns();
};

export default Comparing;