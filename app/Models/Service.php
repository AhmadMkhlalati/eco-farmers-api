<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'services';
    protected $fillable = ['name', 'status', 'summary', 'description', 'image', 'slug'];
    protected $appends = ['media_url'];

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
            if (count($this->getMedia('services')) > 0) {
                return $this->getMedia('services')[0]->getFullUrl();
            }
            return null;
        }
    }
}
