<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'blogs';
    protected $perPage = 3;

    protected $fillable = ['title', 'description', 'image', 'summary', 'status', 'slug'];
    protected $appends = ['media_url'];

    protected function createdAt(): Attribute
    {
        $getFunction = fn($value) => !is_null($value) ? Carbon::make($value)->toFormattedDateString() : null;
        return Attribute::make(
            get:$getFunction
        );
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blogs');

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
            if (count($this->getMedia('blogs')) > 0) {
                return $this->getMedia('blogs')[0]->getFullUrl();
            }
            return null;
        }
    }

}
