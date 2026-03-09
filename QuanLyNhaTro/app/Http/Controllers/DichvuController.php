<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dichvu;

class DichvuController extends Controller
{
    public function index()
    {
        $dichvu = Dichvu::all();
        return view('dich_vu.index', compact('dichvu'));
    }
    public function store(Request $request)
    {
        Dichvu::create($request->all());
        return back()
            ->with('thongbao', 'Thêm dịch vụ thành công!');
    }
    public function destroy($id)
    {
        Dichvu::destroy($id);
        return back()
            ->with('thongbao', 'Xóa dịch vụ thành công!');
    }
}
