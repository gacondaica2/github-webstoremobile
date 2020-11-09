<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    Protected $appends = ['img'];
    protected $casts = [
        'media_id'  => 'array',
        'option'    => 'array'
    ];
    public function media(){
        return $this->hasOne('App\Model\Media', 'id', 'avatar_id');
    }

    public function getImgAttribute(){
        try {
            return '/storage/images/'. Media::where('id', $this->attributes['avatar_id'])->first()->title;
        }catch(\Exception $e) {
            return null;
        }

    }
}
