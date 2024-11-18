const swiper = new Swiper(".swiper", {
    // Optional parameters
    direction: "horizontal",
    spaceBetween: 16,
    slidesPerView: "auto",
    slidesOffsetBefore: 20,
    slidesOffsetAfter: 20,
});


// add rating
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#star-rating .star');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const selectedRating = this.getAttribute('data-index');

            // Reset semua bintang ke gambar abu-abu
            stars.forEach(star => {
                star.src = "{{ asset('assets/images/icons/Star-grey.svg') }}";
            });

            // Ganti gambar bintang menjadi emas sesuai dengan rating yang dipilih
            stars.forEach(star => {
                if (star.getAttribute('data-index') <= selectedRating) {
                    star.src = "{{ asset('assets/images/icons/Star 1.svg') }}"; 
                }
            });
        });
    });
});


// image modal in profile
function openImageModal(imageSrc) {
    const modal = document.getElementById("imageModal");
    const zoomedImage = document.getElementById("zoomedImage");

    zoomedImage.src = imageSrc;
    modal.classList.add("opacity-100", "pointer-events-auto");

    document.body.style.overflow = "hidden";
}

function closeImageModal() {
    const modal = document.getElementById("imageModal");
    modal.classList.remove("opacity-100", "pointer-events-auto");

    document.body.style.overflow = "auto";
}

document.getElementById("imageModal").addEventListener("click", function (e) {
    if (e.target === this) {
        closeImageModal();
    }
});
