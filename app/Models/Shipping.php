<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Shipping extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'shipping_details';
    protected $fillable = ['title', 'description'];
}
