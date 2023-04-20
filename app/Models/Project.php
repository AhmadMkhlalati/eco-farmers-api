<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['name', 'image', 'summary', 'description', 'status', 'slug'];
    protected $tableName = ['projects'];
    protected $perPage = 3;
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
            if (count($this->getMedia('projects')) > 0) {
                return $this->getMedia('projects')[0]->getFullUrl();
            }
            return null;
        }
    }
}
