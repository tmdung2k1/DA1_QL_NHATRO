$(document).ready(function () {
    $(document).on('click', '.btn-edit-phong', function () {
        var id = $(this).data('id');
        var ten = $(this).data('ten');
        var loai = $(this).data('loai');
        var trangthai = $(this).data('trangthai');

        $('#edit_Ten_phong').val(ten);
        $('#edit_Ma_loai_phong').val(loai);
        $('#edit_Trang_thai').val(trangthai);

        var form = $('#formEditPhong');
        var updateUrlTemplate = form.data('update-url');
        form.attr('action', String(updateUrlTemplate).replace(':id', id));

        var modalElement = document.getElementById('editPhongModal');
        var editModal = bootstrap.Modal.getOrCreateInstance(modalElement);
        editModal.show();
    });
});