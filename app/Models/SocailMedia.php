<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocailMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';
    protected $fillable = [
        'linkedIn',
        'whatsapp',
        'facebook',
        'instagram',
        'email',
        'phone_number',
        'twitter',
        'youtube',
        'tiktok',
    ];


}
