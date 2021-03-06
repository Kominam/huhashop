<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table   = 'products';
    protected $guarded = ['id'];
    public $timestamp  = true;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function orders()
    {
        return $this->morphToMany('App\Order', 'orderable')->withPivot('quantity');
    }
    public function alone_sales()
    {
        return $this->hasMany('App\AloneSale');
    }
    public function combo_sales()
    {
        return $this->belongsToMany('App\ComboSale');
    }

    public function stock()
    {
        return $this->hasOne('App\Stock');
    }

    public function isAloneSaleNow()
    {
        $current_time = Carbon::now()->toDateString();
        foreach ($this->alone_sales as $alone_sale) {
            if ($alone_sale->began_at < $current_time &&
                $alone_sale->ended_at > $current_time) {
                return true;
                break;
            }
        }
        return false;
    }

    public function getRateAloneSaleNow()
    {
        if ($this->isAloneSaleNow()) {
            $current_time = Carbon::now()->toDateString();
            foreach ($this->alone_sales as $alone_sale) {
                if ($alone_sale->began_at < $current_time &&
                    $alone_sale->ended_at > $current_time) {
                    return $alone_sale;
                    break;
                }
            }
        }
    }

    public function getCurrentPrice()
    {
        $original_price = $this->price;
        if ($this->isAloneSaleNow()) {
            $discount_rate  = $this->getRateAloneSaleNow()->rate;
            $discount_price = ($original_price / 100) * $discount_rate;
            $cur_price      = $original_price - $discount_rate;
            return $cur_price;
        } else {
            return $original_price;
        }

    }

    public function getIsHotAttribute($value)
    {
        if ($value == 1) {
            return true;
        }

        return false;

    }

    public function getIsNewAttribute($value)
    {
        if ($value == 1) {
            return true;
        }

        return false;

    }

    public function getUrlImageAttribute($value)
    {
        return (config('upload.orgin_image_path') . $value);
    }

    public function getZoomImageAttribute($value)
    {
        return (config('upload.big_image_path') . $value);
    }
}
