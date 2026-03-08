document.addEventListener('DOMContentLoaded', function () {
    //VẼ BIỂU ĐỒ CỘT (DOANH THU 6 THÁNG)
    const revCanvas = document.getElementById('revenueChart');
    if (revCanvas) {
        // Đọc dữ liệu từ data
        const labelsThang = JSON.parse(revCanvas.dataset.labels);
        const dataDoanhThu = JSON.parse(revCanvas.dataset.values);
        new Chart(revCanvas.getContext('2d'), {
            type: 'bar', // Loại biểu đồ
            data: {
                labels: labelsThang,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: dataDoanhThu,
                    backgroundColor: 'rgba(25, 135, 84, 0.7)', // Màu nền của cột
                    borderColor: '#198754', // Màu viền của cột
                    borderWidth: 1, // Độ dày viền của cột
                    borderRadius: 5 // Bo góc cột
                }]
            },
            options: {
                responsive: true, // Biểu đồ tự động điều chỉnh kích thước
                maintainAspectRatio: false, // Không giữ tỷ lệ khung hình
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Định dạng số trên trục y theo định dạng tiền tệ Việt Nam
                            callback: function (value) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Ẩn chú thích
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.raw.toLocaleString('vi-VN') + ' VNĐ';
                            }
                        }
                    }
                }
            }
        });
    }
    //VẼ BIỂU ĐỒ TRÒN (THỐNG KÊ PHÒNG TRỐNG/ĐÃ THUÊ)
    const roomCanvas = document.getElementById('roomChart');
    if (roomCanvas) {
        // Đọc dữ liệu từ data
        const phongTrong = parseInt(roomCanvas.dataset.phongTrong);
        const phongCoKhach = parseInt(roomCanvas.dataset.phongCoKhach);
        new Chart(roomCanvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Phòng trống', 'Phòng đã thuê'],
                datasets: [{
                    data: [phongTrong, phongCoKhach],
                    backgroundColor: ['#ffc107', '#198754'], // Màu nền cho từng phần của biểu đồ
                    borderColor: '#fff', // Màu viền giữa các phần
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%', // Tạo lỗ ở giữa biểu đồ để tạo hiệu ứng doughnut
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20, // Khoảng cách giữa các mục trong chú thích
                        }
                    }
                }
            }
        });
    }
});