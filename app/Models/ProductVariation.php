<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "product_variations";
    protected $guarded = [];
    protected $appends = ['is_sale' , 'percent_sale'];


    public function getIsSaleAttribute()
    {
        return($this->sale_price != null && $this->date_on_sale_from < Carbon::now() && $this->date_on_sale_to > Carbon::now()) ? true : false;
    }


    public function getPercentSaleAttribute()
    {
        return $this->is_sale ? round((($this->price - $this->sale_price) / $this->price) * 100) : null;
    }
}
