<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categories;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories_parent = Categories::where('parent_id', '0')->get();
            if( count($categories_parent) <= 0) throw new \Exception('Chưa có danh mục!');
            return view('backend.category.create')->with([
                'parent' => $categories_parent
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $category           = new Categories();
            $category->title    = $request->title;
            $category->slug     = \Str::slug($request->title);
            $category->status   = $request->status;
            $category->parent_id = (isset($request->parent)) ? 0 : $request->childrent;
            $category->save();
            DB::commit();
            return redirect()->route('categoryall');
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
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
    public function edit($id, Request $request)
    {
        try {
            $item = Categories::find($id);
            if( empty($item)) throw new \Exception('Danh mục vừa chỉnh sửa không tồn tại');
            $item->title        = $request->title;
            $item->parent_id    = ( isset($request->parent)) ? 0 : $request->childrent;
            $item->status       =  $request->status;
            $item->save();
            return redirect()->back();
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
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
        try {
            $record = Categories::where('id', $id)->with([
                'childrent' => function($query) {},
                'product'   => function($query) {}
            ])->first();
            DB::beginTransaction();
            if( count($record->childrent) > 0) {
                foreach($record->childrent as $childrent) {
                    route('delete_category', $childrent->id);
                    dd('ok');
                }
            }
            if( count($record->product) > 0) {
                foreach($record->product as $product) {
                    route('delete_product', $product->id);
                }
            }
            if( empty($record) ) throw new \Exception('Danh mục không tồn tại!');
            $record->delete();
            DB::commit();
            return redirect()->back()->with([      
                "messages"  => 'Xoá danh mục thành công', 
                'color'     => 'alert-danger'
            ]);
        }catch(\Exception $e)
        {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }

    public function interface() {
        try {
            $category = Categories::orderBy('id','desc')->where('parent_id', 0)
            ->with([
                'childrent'
            ])->get();
            $record = Categories::orderBy('id','desc')->where('parent_id', 0)
            ->with([
                'childrent'
            ])->first();
            return view('backend.category.categories')->with([
                'category' => $category,
                'record'  => $record
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }

    public function ediInterface($id) {
        try {
            $category = Categories::where('id', $id)->first();
            if( empty($category)) throw new \Exception('Danh mục không tồn tại!');
            $parent = Categories::where('parent_id', 0)->geta();
            return view('backend.category.detail')->with([
                'category'  => $category,
                'parent'    => $parent
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }

    public function apiCategory($id) {
        try {
            $records = Categories::where('id', $id )->with([
                'childrent' => function($query) {}
            ])
            ->first();
            if( is_null($records)) throw new \Exception('Danh mục không tồn tại');
            return response()->json([
                'messages' => 'success',
                'data'  => $records
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'messages' => 'fail',
                'data'  => $e->getMessage()
            ]);
        }
    }
}
