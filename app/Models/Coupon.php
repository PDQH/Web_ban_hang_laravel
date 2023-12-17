<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = ['coupon_name', 'coupon_code', 'coupon_number', 'coupon_feature', 'coupon_discount'];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
    use HasFactory;
}
