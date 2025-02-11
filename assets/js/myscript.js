$(document).ready(function() {
    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        Swal.fire({
            title: 'Update',
            text: 'Berhasil ' + flashData,
            icon: 'success'
        });
    }
});