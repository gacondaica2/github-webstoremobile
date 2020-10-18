<?php 
use App\Model\Categories;
class Helper {
    public static function Category() {
        return Categories::with([
            'product' => function($query) {}
        ])->get();
    }
}
?>