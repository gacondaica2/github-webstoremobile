<?php 
use App\Model\Categories;
class Helper {
    public static function Category() {
        return Categories::with([
            'childrent' => function($query) {}
        ])->where('parent_id', 0)->get();
    }
}
?>