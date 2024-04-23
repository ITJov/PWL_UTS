$(document).on('click','#deleteData', function (e){
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
        title: "Penghapusan Data",
        text: "Apakah anda akan menghapus data ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00a65a",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus data",
        cancelButtonText: "Batalkan",
    }).then((result) => {
        if (result.isConfirmed) {
                window.location = link ;

        }
    });
})