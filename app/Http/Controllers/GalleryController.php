<?php

namespace App\Http\Controllers;

use App\Http\Resources\GalleryResource;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryController extends Controller
{
    public function index(){
        return GalleryResource::collection(Media::query()->where('collection_name','gallery')->paginate());
    }
}
