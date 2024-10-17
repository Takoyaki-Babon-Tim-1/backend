const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    slidesPerView: "auto",
    pagination: {
        el: '.swiper-pagination',
        clickable: false,
    },
    on: {
        slideChange: function () {
        swiper.pagination.update();
        },
    },
});

const tabs = new Swiper('.swiper-tabs', {
    // Optional parameters
    direction: 'horizontal',
    slidesPerView: "auto",
    spaceBetween: 16,
    slidesOffsetBefore: 20,
    slidesOffsetAfter: 20,
});