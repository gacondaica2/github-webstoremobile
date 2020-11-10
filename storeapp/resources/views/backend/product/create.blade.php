@extends('backend.template')
@section('content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <h2 class="font-weight-normal">Thêm sản phẩm mới </h2>
    </div>
    @include('backend.messages.messages')
    <div class="container">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="tab-account" >
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm sản phẩm mới</h4>
                    </div>
                    <div class="card-body">
                        <hr class="m-v-25">
                        <form enctype="multipart/form-data" action="{{ route('create_product_post') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Tiêu đề:</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Tiêu đề">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Mã sản phẩm:</label>
                                    <input type="text" name="sku" class="form-control" id="sku" placeholder="Mã sản phẩm">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold">Giá:</label>
                                    <input type="number" name="price" class="form-control" id="title" placeholder="Giá sản phẩm">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Giá khuyến mãi(nếu có):</label>
                                    <input type="number" name="price_sale" class="form-control" id="title" placeholder="Giá khuyễn mãi">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="">Danh mục Chính</label>
                                    @if( isset($parent) )
                                    <select name="category" id="childrent" class="form-control parent-category">
                                        @foreach($parent as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="">Danh mục Phụ</label>
                                    @if( isset($record->childrent) )
                                    <select name="childrent" id="childrent" class="form-control childrent-category">
                                        @foreach($record->childrent as $childrent)
                                        <option value="{{ $childrent->id }}">{{ $childrent->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-weight-semibold" for="dob">Trạng thái(bật/tắt):</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-weight-semibold">Số lượng sản phẩm:</label>
                                    <input type="number" name="qty" class="form-control" id="title" placeholder="Số lượng">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Khối lượng:</label>
                                    <input type="number" name="weight" class="form-control" id="weight" placeholder="Khối lượng sản phẩm">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Chiều cao:</label>
                                    <input type="number" name="width" class="form-control" id="weight" placeholder="chiều cao sản phẩm">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Chiều rộng:</label>
                                    <input type="number" name="height" class="form-control" id="weight" placeholder="chiều rộng sản phẩm">
                                </div>
                                <div class="form-group col-md-3"> </div>
                                <div class="form-group col-md-12"><h2>Thông số cấu hình</h2> </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Hãng sản xuất(*):</label>
                                    @if( isset($manufacturers) )
                                    <select name="manufacturers" id="childrent" class="form-control">
                                        @foreach($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Kích thước(*):</label>
                                    @if( isset($sizes) )
                                    <select name="size" id="childrent" class="form-control">
                                        @foreach($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Trọng lượng(*):</label>
                                    @if( isset($weights) )
                                    <select name="weight_option" id="childrent" class="form-control">
                                        @foreach($weights as $weight)
                                        <option value="{{ $weight->id }}">{{ $weight->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Bộ nhớ đệm / Ram(*):</label>
                                    @if( isset($internalmemorys) )
                                    <select name="internalmemory" id="childrent" class="form-control">
                                        @foreach($internalmemorys as $internalmemory)
                                        <option value="{{ $internalmemory->id }}">{{ $internalmemory->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Bộ nhớ trong(*):</label>
                                    @if( isset($rams) )
                                    <select name="ram" id="childrent" class="form-control">
                                        @foreach($rams as $ram)
                                        <option value="{{ $ram->id }}">{{ $ram->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Loại SIM(*):</label>
                                    @if( isset($sims) )
                                    <select name="sim" id="childrent" class="form-control">
                                        @foreach($sims as $sim)
                                        <option value="{{ $sim->id }}">{{ $sim->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Loại màn hình(*):</label>
                                    @if( isset($screens) )
                                    <select name="screen" id="childrent" class="form-control">
                                        @foreach($screens as $screen)
                                        <option value="{{ $screen->id }}">{{ $screen->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Kích thước màn hình(*):</label>
                                    @if( isset($screensizes) )
                                    <select name="screensize" id="childrent" class="form-control">
                                        @foreach($screensizes as $screensize)
                                        <option value="{{ $screensize->id }}">{{ $screensize->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Độ phân giải màn hình(*):</label>
                                    @if( isset($screenresolutions) )
                                    <select name="screenresolution" id="childrent" class="form-control">
                                        @foreach($screenresolutions as $screenresolution)
                                        <option value="{{ $screenresolution->id }}">{{ $screenresolution->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Hệ điều hành(*):</label>
                                    @if( isset($operatingsystems) )
                                    <select name="operatingsystem" id="childrent" class="form-control">
                                        @foreach($operatingsystems as $operatingsystem)
                                        <option value="{{ $operatingsystem->id }}">{{ $operatingsystem->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Pin(*):</label>
                                    @if( isset($pins) )
                                    <select name="pin" id="childrent" class="form-control">
                                        @foreach($pins as $pin)
                                        <option value="{{ $pin->id }}">{{ $pin->title }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <textarea style="height: 300px;" name="editor" id="editor"></textarea>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Ảnh đại diện:</label>
                                    <input type="file" name="avatar">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Ảnh mô tả:</label>
                                    <input type="file" name="media[]" multiple="multiple">
                                </div>
                            </div>
                            <p>(*) bắt buộc phải có đầy đủ</p>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection