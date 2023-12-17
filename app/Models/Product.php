<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['category_id', 'brand_id', 'product_name', 'product_desc', 'product_content', 'product_price', 'product_image', 'product_status'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
    use HasFactory;
}
