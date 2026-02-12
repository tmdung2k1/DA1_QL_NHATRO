$(document).ready(function () {
    $(document).on('click', '.btn-edit-loaiphong', function () {
        var id = $(this).data('id');
        var ten = $(this).data('ten');
        var dongia = $(this).data('dongia');
        var mota = $(this).data('mota');

        $('#edit_Ten_loai_phong').val(ten);
        $('#edit_Don_gia').val(dongia);
        $('#edit_Mo_ta').val(mota);

        var form = $('#formEditLoaiPhong');
        form.attr('action', String(form.data('update-url')).replace(':id', id));

        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editLoaiPhongModal'));
        modal.show();
    });
});
