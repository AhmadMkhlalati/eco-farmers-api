<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia;
    protected $table = 'products';
    protected $fillable = ['name', 'summary', 'status', 'slug', 'description', 'price'];
    protected $appends = ['media_url'];

    public function categories()
    {
        return $this->hasManyThrough(Category::class, ProductCategory::class, 'product_id', 'id', 'id', 'category_id');
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
            if (count($this->getMedia('products')) > 0) {
                return $this->getMedia('products')[0]->getFullUrl();
            }
            return null;
        }
    }
}
