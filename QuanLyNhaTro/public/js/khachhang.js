// Khởi tạo flatpickr cho form tạo mới và modal chỉnh sửa khách hàng
document.addEventListener('DOMContentLoaded', function () {
    var createInput = document.getElementById('create_Ngay_vao');
    if (createInput) {
        flatpickr(createInput, {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd/m/Y',
            defaultDate: createInput.dataset.default || new Date(),
            maxDate: createInput.dataset.max || null,
            locale: 'vn',
            allowInput: true,
            onReady: function (selectedDates, dateStr, instance) {
                instance.altInput.placeholder = 'DD/MM/YYYY';
            }
        });
    }

    var editInput = document.getElementById('edit_Ngay_vao');
    if (editInput) {
        window.fpEdit = flatpickr(editInput, {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'd/m/Y',
            maxDate: editInput.dataset.max || null,
            locale: 'vn',
            allowInput: true,
            onReady: function (selectedDates, dateStr, instance) {
                instance.altInput.placeholder = 'DD/MM/YYYY';
            }
        });
    }
});

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

        // Dùng flatpickr API để set ngày đúng định dạng
        var fpInstance = document.querySelector('#edit_Ngay_vao')._flatpickr;
        if (fpInstance) {
            fpInstance.setDate(ngayvao, true, 'Y-m-d');
        } else {
            $('#edit_Ngay_vao').val(ngayvao);
        }

        var form = $('#formEditKhach');
        form.attr('action', String(form.data('update-url')).replace(':id', id));

        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editKhachHangModal'));
        modal.show();
    });
});
