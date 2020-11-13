<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Validators\Validator;
use Illuminate\Support\Facades\Storage;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Media;
use App\Model\Manufacturer;
use App\Model\Size;
use App\Model\Weight;
use App\Model\Ram;
use App\Model\Internalmemory;
use App\Model\SIM;
use App\Model\screen;
use App\Model\Screensize;
use App\Model\Screenresolution;
use App\Model\Pin;
use App\Model\Operatingsystem;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $records = Product::orderBy('id','desc')
            ->paginate(8);
            if( count($records) <= 0 ) throw new \Exception('Không có sản phẩm nào');
            return view('backend.product.product')->with([
                'records' => $records
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
        try{
            DB::beginTransaction();
            $media_id = [];
            foreach($request->media as $item) {
                $item->storeAs('public\images', date("Y-m-d").date("h-i-sa").$item->getClientOriginalName());
                $media = new Media();
                $media->title = date("Y-m-d").date("h-i-sa").$item->getClientOriginalName();
                $media->save();
                $media_id[] = $media->id;
            }
            $check_data = Product::where('title', $request->title)->orwhere('sku', $request->sku)->first();
            if( !is_null($check_data)) throw new \Exception('Sản phẩm đã tồn tại!');
            $avatar = new Media();
            if( !$request->hasFile('media')) throw new \Exception('Chưa chọn hình ảnh hoặc hình ảnh không tồn tại!');
            $request->avatar->storeAs('public\images', date("Y-m-d").date("h-i-sa").$request->avatar->getClientOriginalName());
            $avatar->title = date("Y-m-d").date("h-i-sa").$request->avatar->getClientOriginalName();
            $avatar->save();
            $product                = new Product();
            $product->title         = $request->title;
            $product->slug          = \Str::slug($product->title);
            $product->sku           = $request->sku;
            $product->price         = $request->price;
            $product->price_sale    = $request->price_sale;
            $product->content       = $request->editor;
            $product->qty           = $request->qty;
            $product->weight        = $request->weight;
            $product->width         = $request->width;
            $product->height        = $request->height;
            $product->category_id   = $request->childrent;
            $product->avatar_id     = $avatar->id;
            $product->media_id      = !is_null($request->media) ? $media_id :[];
            $product->description   = $request->description;
            $product->option        = ProductController::Option($request);
            if( empty($product)) throw new \Exception('Thêm sản phẩm thất bại!');
            $product->save();
            DB::commit();
            return redirect()->route('productall');
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
    public function edit($id)
    {
        try {
            $item = Product::where('id', $id)->with([
                'media' => function($query) {},
                'category'  => function($query) {
                    $query->with([
                        'parent' => function($query) {},
                    ]);
                }
            ])->first();
            $sub_category       = Categories::where('parent_id',($item->category->parent_id == 0) ? $item->category->id : 1)->get();
            $parent             = Categories::where('parent_id', 0)->get();
            $manufacturer       = Manufacturer::all();
            $size               = Size::all();
            $weight             = Weight::all();
            $ram                = Ram::all();
            $internalmemory     = Internalmemory::all();
            $sim                = Sim::all();
            $screen             = screen::all();
            $screensize         = Screensize::all();
            $screenresolution   = Screenresolution::all();
            $operatingsystem    = Operatingsystem::all();
            $pin                = Pin::all();
            if( empty($item)) throw new \Exception('Sản phẩm không tồn tại!');
            return view('backend.product.detail')->with([
                'item'               => $item,
                'sub_category'       => $sub_category,
                'parent'             => $parent,
                'manufacturers'      => $manufacturer,
                'sizes'              => $size,
                'rams'               => $ram,
                'internalmemorys'    => $internalmemory,
                'weights'            => $weight,
                'sims'               => $sim,
                'screensizes'        => $screensize,
                'screenresolutions'  => $screenresolution,
                'screens'            => $screen,
                'operatingsystems'   => $operatingsystem,
                'pins'               => $pin,
            ]);
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
    public function update($id, Request $request) 
    {
        try{
            $product = Product::find($id);
            if( empty($product)) throw new \Exception('Sản phẩm không tồn tại');
            DB::beginTransaction();
            if( isset($request->media)) {
                $media_id = [];
                foreach($product->media_id as $image) {
                    $media = Media::find($image);
                    Storage::delete('public/images/'.$media->title);
                }
                $product->media_id  = ($request->media !== null) ? $media_id : [];
            }
            if( isset($request->avatar))  {
                $avatar = Media::find($product->avatar_id);
                Storage::delete('public/images/'.$avatar->title);
                $request->avatar->storeAs('public\images', date("Y-m-d").date("h-i-sa").$request->avatar->getClientOriginalName());
                $avatar->title = date("Y-m-d").date("h-i-sa").$request->avatar->getClientOriginalName();
                $avatar->save();
                $product->avatar_id     = $avatar->id;
            }
            if($request->media !== null) {
                foreach($request->media as $item) {
                    $item->storeAs('public\images', date("Y-m-d").date("h-i-sa").$item->getClientOriginalName());
                    $media = new Media();
                    $media->title = date("Y-m-d").date("h-i-sa").$item->getClientOriginalName();
                    $media->save();
                    $media_id[] = $media->id;
                }
            }
            $product->title         = $request->title;
            $product->slug          = \Str::slug($product->title);
            $product->sku           = $request->sku;
            $product->price         = $request->price;
            $product->price_sale    = $request->price_sale;
            $product->content       = $request->editor;
            $product->qty           = $request->qty;
            $product->weight        = $request->weight;
            $product->width         = $request->width;
            $product->height        = $request->height;
            $product->category_id   = $request->childrent;
            $product->option        = ProductController::Option($request);
            $product->description   = $request->description;
            $product->save();
            DB::commit();
            return redirect()->back()->with([      
                "messages" => 'Thay đổi thành công', 
                'color' => 'alert-success'
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages" => $e->getMessage(), 
                'color' => 'alert-danger'
            ]);
        }
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
            DB::beginTransaction();
            $product = Product::find($id);
            if(empty($product)) throw new \Exception('Sản phẩm không tồn tại!');
            $avatar_id = Media::find($product->avatar_id);
            if(empty($avatar_id)) throw new \Exception('Hình ảnh không tồn tại!');
            Storage::delete('public/images/'.$avatar_id->title);
            $product->delete();
            foreach($product->media_id as $img) {
                $media = Media::find($img);
                $media->delete();
                Storage::delete('public/images/'.$media->title);
            }
            DB::commit();
            return redirect()->route('productall');
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }

    public function interfaceCreate() 
    {
        try{    
            $manufacturer       = Manufacturer::all();
            $size               = Size::all();
            $weight             = Weight::all();
            $ram                = Ram::all();
            $internalmemory     = Internalmemory::all();
            $sim                = Sim::all();
            $screen             = screen::all();
            $screensize         = Screensize::all();
            $screenresolution   = Screenresolution::all();
            $operatingsystem    = Operatingsystem::all();
            $pin = Pin::all();
            $parent = Categories::where('parent_id',0)
            ->with(['childrent'])
            ->get();
            $record = Categories::where('parent_id', 0)
            ->with(['childrent'])
            ->first();
            return view('backend.product.create')->with([
                'parent'             => $parent,
                'record'             => $record,
                'manufacturers'      => $manufacturer,
                'sizes'              => $size,
                'rams'               => $ram,
                'internalmemorys'    => $internalmemory,
                'weights'            => $weight,
                'sims'               => $sim,
                'screensizes'        => $screensize,
                'screenresolutions'  => $screenresolution,
                'screens'            => $screen,
                'operatingsystems'   => $operatingsystem,
                'pins'               => $pin,
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }

    public static function Option($request) {
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'title'             => 'required',
                'sku'               => 'required',
                'price'             => 'required',
                'price_sale'        => 'required',
                'status'            => 'required',
                'category'          => 'required',
                'qty'               => 'required',
                'editor'            => 'required',
                'weight'            => 'required',
                'width'             => 'required',
                'weight_option'     => 'required',
                'height'            => 'required',
                'manufacturers'     => 'required',
                'size'              => 'required',
                'internalmemory'    => 'required',
                'ram'               => 'required',
                'sim'               => 'required',
                'screen'            => 'required',
                'screensize'        => 'required',
                'screenresolution'  => 'required',
                'operatingsystem'   => 'required',
                'pin'               => 'required',
                'childrent'         => 'required'
            ]);
            if( $validator->fails()) throw new \Exception('nhập đầy đủ thông tin (*)!');
            $manufacturer       = Manufacturer::find($request->manufacturers);
            if( empty($manufacturer)) throw new \Exception('manufacturer không tồn tại!');
            $size               = Size::find($request->size);
            if( empty($size)) throw new \Exception('mansizeufacturer không tồn tại!');
            $weight_option      = Weight::find($request->weight_option);
            if( empty($size)) throw new \Exception('mansizeufacturer không tồn tại!');
            $ram                = Ram::find($request->ram);
            if( empty($ram)) throw new \Exception('ram không tồn tại!');
            $internalmemory     = Internalmemory::find($request->internalmemory);
            if( empty($internalmemory)) throw new \Exception('internalmemory không tồn tại!');
            $screen             = screen::find($request->screen);
            if( empty($screen)) throw new \Exception('screen không tồn tại!');
            $screensize         = Screensize::find($request->screensize);
            if( empty($screensize)) throw new \Exception('screensize không tồn tại!');
            $screenresolution   = Screenresolution::find($request->screenresolution);
            if( empty($screenresolution)) throw new \Exception('screenresolution không tồn tại!');
            $operatingsystem    = Operatingsystem::find($request->operatingsystem);
            if( empty($operatingsystem)) throw new \Exception('operatingsystem không tồn tại!');
            $pin                = Pin::find($request->pin);
            if( empty($pin)) throw new \Exception('pin không tồn tại!');
            $sim                = SIM::find($request->sim);
            if( empty($sim)) throw new \Exception('sim không tồn tại!');
            DB::commit();
            return $option = [
                'manufacturer' => (object)[
                    'value'    => $manufacturer->title,
                    'name'     => 'Hãng sản xuất'
                ],
                'size'       => (object)[
                    'value'  => $size->title,
                    'name'   => 'kích cỡ'
                ],
                'internalmemory' => (object)[
                    'value'  => $internalmemory->title,
                    'name'   => 'Bộ nhớ trong'
                ],
                'ram'        => (object)[
                    'value'  => $ram->title,
                    'name'   => 'Ram'
                ],
                'weight'     => (object)[
                    'value'  => $weight_option->title,
                    'name'   => 'Khối lượng'
                ],
                'sim'        => (object)[
                    'value'  => $sim->title,
                    'name'   => 'Sim'
                ],
                'screen'     => (object)[
                    'value'  => $screen->title,
                    'name'   => 'Màn hình'
                ],
                'screensize'        => (object)[
                    'value'  => $screensize->title,
                    'name'   => 'Kích cỡ màn hình'
                ],
                'screenresolution'  => (object)[
                    'value'  => $screenresolution->title,
                    'name'   => 'Độ phân giải'
                ],
                'operatingsystem'   => (object)[
                    'value' => $operatingsystem->title,
                    'name'  => 'Hệ điều hành'
                ],
                'pin'       => (object)[
                    'value' => $pin->title,
                    'name'  => 'pin'
                ],
            ];
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }
    
    public function search( Request $request) {
        try{
            $records = Product::where('title', 'like', '%'.$request->name.'%')->paginate(10);
            return view('backend.product.product')->with([
                'records' => $records
            ]);
        }catch(\Exception $e) {
            return redirect()->back()->with([      
                "messages"  => $e->getMessage(), 
                'color'     => 'alert-danger'
            ]);
        }
    }
}
