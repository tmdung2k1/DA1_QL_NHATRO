$(document).ready(function () {
    $(document).on('click', '.btn-edit-khach', function () {
        var id = $(this).data('id');
        var hoten = $(this).data('hoten');
        var cccd = $(this).data('cccd');
        var sdt = $(this).data('sdt');
        var quequan = $(this).data('quequan');
        var email = $(this).data('email');
        var ngayvao = $(this).attr('data-ngayvao');

        $('#edit_Ho_ten').val(hoten);
        $('#edit_Cccd').val(cccd);
        $('#edit_Sdt').val(sdt);
        $('#edit_Que_quan').val(quequan);
        $('#edit_Email').val(email);
        $('#edit_Ngay_vao').val(ngayvao);

        var form = $('#formEditKhach');
        form.attr('action', String(form.data('update-url')).replace(':id', id));

        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editKhachHangModal'));
        modal.show();
    });
});
