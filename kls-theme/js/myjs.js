// проверка формы поиска
const form = document.querySelector('.aws-search-form');
const input = document.querySelector('.aws-search-field');

//document.addEventListener('click',e => console.log(e.target))


///
const childElement = document.querySelector('.aws-search-btn_icon > svg');
// console.log(childElement);
const parentElement = childElement.closest("form");
// console.log(parentElement);
const inputField = parentElement.querySelector('.aws-search-field');
//console.log(inputField);

inputField.value = '';

childElement.addEventListener('click', e => {
    // const activeElement = inputField.hasFocus();
    // console.log(activeElement);
    if (inputField == document.activeElement) {
        //console.log("focuseddd");
    } else {
        //console.log('noooooo');
        inputField.focus();
        // e.preventDefault();
    }
});

// очистка формы при закрытие input
document.addEventListener('click', e => {
    if ( e != childElement && e.target != inputField ) {
        inputField.value = '';
    }
});

// jQuery
// оформление добавления товара в корзину
jQuery(document).ready(function($) {
    // https://gist.github.com/bagerathan/2b57e7413bfdd09afa04c7be8c6a617f
    $('body').on('adding_to_cart', function (e, btn, data) {
        btn.closest('.product__wrap').find('.ajax-loader').fadeIn();
    });

    $('body').on('added_to_cart', function (e, response_fragments, response_cart_hash, btn) {
        btn.closest('.product__wrap').find('.ajax-loader').fadeOut();
    });
});

// Fancybox gallery
Fancybox.bind("[data-fancybox]", {
    caption: false,
    contentClick: "next",
    Carousel: {
        Panzoom: {
            decelFriction: 0.5,
        },
    },
    Toolbar: {
        display: {
            left: [],
            middle: ["prev", "infobar", "next"],
            right: ["close"],
        }
    }
});