$(document).ready(function () {
    $('#select_hop_dong').change(function () {
        var id = $(this).val();
        if (id) {
            $.get('/hoa_don/lay-chi-so/' + id, function (data) {
                $('#dien_cu').val(data.dien_cu);
                $('#nuoc_cu').val(data.nuoc_cu);
            });
        }
    });
});
