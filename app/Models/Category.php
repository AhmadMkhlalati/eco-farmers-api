<?php

namespace App\Models;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'categories';
    protected $fillable = ['name', 'status','slug'];
    protected $appends = ['media_url'];

    public function products()
    {
        return $this->hasManyThrough(Product::class, ProductCategory::class, 'category_id', 'id', 'id', 'product_id');
    }

    protected function createdAt(): Attribute
    {
        $getFunction = fn($value) => !is_null($value) ? Carbon::make($value)->toFormattedDateString() : null;
        return Attribute::make(
            get:$getFunction
        );
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 'active');
    }
    public function getMediaUrlAttribute()
    {
        if ($this->getFirstMediaUrl()) {
            return ($this->getFirstMediaUrl());
        } else {
            if (count($this->getMedia('categories')) > 0) {
                return $this->getMedia('categories')[0]->getFullUrl();
            }
            return null;
        }
    }
}
