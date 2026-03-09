<div class="modal fade" id="addDichVuModal" tabindex="-1" aria-labelledby="addDichVuModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="addDichVuModalLabel"><i class="bi bi-plus-circle"></i> Thêm Dịch Vụ
                    Mới</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('dichvu.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tên dịch vụ<span class="text-danger">*</span></label>
                        <input type="text" name="Ten_dich_vu" class="form-control"
                            placeholder=" Dọn rác, Wifi, Gửi xe..." required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Đơn vị tính <span class="text-danger">*</span></label>
                            <input type="text" name="Don_vi_tinh" class="form-control"
                                placeholder="Tháng, Người, Chiếc..." required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Đơn giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" name="Don_gia" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Lưu Dịch Vụ</button>
                </div>
            </form>
        </div>
    </div>
</div>
