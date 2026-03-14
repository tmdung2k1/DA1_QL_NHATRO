const qrModal = document.getElementById('qrModal');

function openQrModal() {
    if (!qrModal) {
        return;
    }

    qrModal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeQrModal() {
    if (!qrModal) {
        return;
    }

    qrModal.classList.remove('show');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && qrModal && qrModal.classList.contains('show')) { // Đóng modal khi nhấn phím Escape 
        closeQrModal();
    }
});