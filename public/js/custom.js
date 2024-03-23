/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function previewImage() {
    const image = document.querySelector("#foto");
    const imgPreview = document.querySelector(".img-preview");

    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob;
}

document.addEventListener("DOMContentLoaded", function () {
    // Simpan URL gambar asli
    const imgPreview = document.querySelector(".img-preview");
    if (imgPreview) {
        imgPreview.setAttribute("data-src", imgPreview.src);
    }

    // Tambahkan event listener pada tombol reset
    const resetButton = document.getElementById("reset-button");
    if (resetButton) {
        resetButton.addEventListener("click", resetPhoto);
    }
});

function resetPhoto() {
    // Ambil URL gambar asli dari elemen data-src dan setel kembali sebagai sumber gambar
    const imgPreview = document.querySelector(".img-preview");
    const originalSrc = imgPreview.getAttribute("data-src");
    imgPreview.src = originalSrc;
}
// document.addEventListener("DOMContentLoaded", function () {
//     // Fungsi untuk mengembalikan nilai foto awal
//     function reset() {
//         var imgPreview = document.querySelector(".img-preview");
//         imgPreview.src = "";
//         document.getElementById("nama_lengkap").value = "";
//         document.getElementById("username").value = "";
//         document.getElementById("role").checked = false;
//     }

//     // Tambahkan event listener pada tombol reset
//     var resetButton = document.getElementById("reset-button");
//     if (resetButton) {
//         resetButton.addEventListener("click", reset);
//     }
// });
