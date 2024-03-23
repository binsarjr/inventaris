"use strict";

$("#swal-1").click(function () {
    swal("Hello");
});

$("#swal-2").click(function () {
    swal("Good Job", "You clicked the button!", "success");
});

$("#swal-3").click(function () {
    swal("Good Job", "You clicked the button!", "warning");
});

$("#swal-4").click(function () {
    swal("Good Job", "You clicked the button!", "info");
});

$("#swal-5").click(function () {
    swal("Good Job", "You clicked the button!", "error");
});

// $("#swal-6").on("click", function () {
//     swal({
//         title: "Apakah Anda yakin?",
//         text: "Setelah dihapus, Anda tidak akan dapat memulihkan file ini!",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     }).then((willDelete) => {
//         if (willDelete) {
//             swal("Sukses! File Anda telah dihapus!", {
//                 icon: "success",
//             });
//         } else {
//             swal("File Anda aman!");
//         }
//     });
// });
function confirmDelete(userId) {
    swal({
        title: "Apakah Anda yakin?",
        text: "Setelah dihapus, Anda tidak akan dapat memulihkan file ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            // Submit the specific form based on user ID
            document.getElementById("deleteForm-" + userId).submit();
            // swal("Sukses! File Anda telah dihapus!", {
            //     icon: "success",
            // });
        } else {
            swal("File Anda aman!");
        }
    });
}

function tolakTransaksi(userId) {
    swal({
        title: "Apakah Anda yakin?",
        text: "Setelah ditolak, Anda tidak akan dapat mengembalikan status transaksi ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            //submit button
            document.getElementById("tolakTransaksi-" + userId).submit();
        } else {
            swal("Transaksi aman!");
        }
    });
}

$("#swal-7").click(function () {
    swal({
        title: "What is your name?",
        content: {
            element: "input",
            attributes: {
                placeholder: "Type your name",
                type: "text",
            },
        },
    }).then((data) => {
        swal("Hello, " + data + "!");
    });
});

$("#swal-8").click(function () {
    swal("This modal will disappear soon!", {
        buttons: false,
        timer: 3000,
    });
});
