<?php 
use App\Model\Categories;
use App\Model\Product;

class Helper {
    public static function Category() {
        return Categories::with([
            'childrent' => function($query) {}
        ])->where('parent_id', 0)->get();
    }

    public static function BestSale() {
        return Product::orderBy('price', 'desc')->limit(10)->get();
    }
}
?>