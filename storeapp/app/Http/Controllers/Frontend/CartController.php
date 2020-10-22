<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       try {           
           return view('frontend.cart.checkout');
       }catch(\Exception $e) {
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
    public function update(Request $request)
    {
        dd($request->name);
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

    public function add($slug, Request $request) {
        try {           
            $record = Product::where('slug', $slug)->first();
            if( empty($record) === 0) throw new \Exception('Sản phẩm không tồn tại');
            $item = [
                'id' => $record->id,
                'name' => $record->title,
                'price' => ($record->price_sale > 0) ? $record->price_sale : $record->price,
                'quantity'   => (!empty($request->quantity))? $request->quantity : 1,
                'attributes' => $record
            ];
            $record = Cart::add($item);
            return redirect()->back();
        }catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
    
    public function delete($id) {
        try {
            $item = Product::find($id);
            if( is_null($item)) throw new \Exception('Sản phẩm không tồn tại!');
            $record = Cart::remove($item->id);
            return redirect()->back();
        }catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function detail() {
        return view('frontend.cart.detail');
    }

    public function plus($id) {
        try {
            Cart::update($id, [
                'quantity' => +1
            ]);
            return response()->json();
        }catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function mines($id) {
        try {
            Cart::update($id, [
                'quantity' => -1
            ]);
            return response()->json();
        }catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
