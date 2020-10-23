<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        try {
            $record = Product::where('slug', $slug)->first();
            $test = json_decode( $record->option);
            if( empty($test)) throw new \Exception('Không có thông tin cấu hình!');
            $setting = [
                'Hãng sản xuất'         => $test->Manufacturer,
                'Kích thước'            => $test->Size,
                'Trọng lượng'           => $test->Weight,
                'Bộ nhớ đệm / Ram'      => $test->Ram,
                'Bộ nhớ trong'          => $test->Internalmemory,
                'Loại SIM'              => $test->SIM,
                'Loại màn hình'         => $test->screen,
                'Kích thước màn hình'   => $test->Screensize,
                'Độ phân giải màn hình' => $test->Screenresolution,
                'Hệ điều hành'          => $test->Operatingsystem,
            ];
            if( empty($record)) throw new \Exception('Sản phẩm không tồn tại!');
            return view('frontend.product.product')->with([
                'record' => $record,
                'setting' => $setting
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
