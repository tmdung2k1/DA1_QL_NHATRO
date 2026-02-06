@extends('layout.master')
@section('tieude', 'Tổng Quan')
@section('noidung')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Doanh Thu Tháng</h5>
                    <p>12,500,000 VND</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Phòng Đang Thuê</h5>
                    <p class="card-text fs-3">8/10</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Khách chưa đóng tiền</h5>
                    <p class="card-text fs-3">2</p>
                </div>

            </div>
        </div>
    </div>
@endsection
