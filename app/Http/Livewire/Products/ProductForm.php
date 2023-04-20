<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\LiveWire;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductForm extends LiveWire
{
    use LivewireAlert, WithFileUploads;

    public $productId;
    public $name;
    public $description;
    public $image;
    public $newImage;
    public $status;
    public $summary;
    public $price;
    public $categories;
    public $selectedCategories;
    public $selected_categories;
    public $slug;
    public $multiImages = [];
    public $newMultiImages = [];
    public $previouslyAddedNewImages = [];

    protected $listeners = ['productAdded', 'deleteImage', 'deleteImageFromMultiIMage'];
    public $galleryId;
    public $galleryKey;


    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updatedNewMultiImages()
    {
//        dd($this->previouslyAddedNewImages,$this->newMultiImages);
        $this->previouslyAddedNewImages = array_merge($this->previouslyAddedNewImages, $this->newMultiImages);
        $this->newMultiImages = $this->previouslyAddedNewImages;
//        $this->previouslyAddedNewImages = [];
    }

    public function mount()
    {
        $this->productId = request()->productId;
        $product = Product::query()->find($this->productId);
        if ($product) {
            $this->name = $product->name;
            $this->slug = $product->slug;
            $this->description = $product->description;
            $this->status = $product->status == 'active';
            $this->price = $product->price;
            $this->summary = $product->summary;
            if (count($product->getMedia('products_collection')) > 0) {
                $this->multiImages = $product->getMedia('products_collection');
            }
            if (count($product->getMedia('products')) > 0) {
                $this->image = $product->getMedia('products')[0]->getFullUrl();
            }

            $this->selectedCategories = ProductCategory::where('product_id', $this->productId)->get(['category_id']);
            $this->selected_categories = ProductCategory::where('product_id', $this->productId)->pluck('category_id');

        }
        $this->categories = Category::whereStatus('active')->get();
    }

    public function save()
    {
        $count = Product::query()->whereHas('media', function ($query) {
                $query->where('collection_name', 'products_collection');
            })->count() + count($this->newMultiImages);
        if ($count >= 15) {
            $this->alert('error', 'The number of images exceeded 15!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }

        $this->validate([
            'name' => 'required|unique:products,name,' . $this->productId,
            'description' => 'required',
            'status' => 'nullable|boolean',
            'price' => 'required|numeric|gte:0',
            'summary' => 'required|min:10',
            'selected_categories' => 'required',
            'selected_categories.*' => 'exists:categories,id',
            'slug' => 'required|unique:products,slug,' . $this->productId,

        ],
            [
                'name.required' => 'The Name is required',
                'name.unique' => 'The Name is already exists!',
                'description.required' => 'The Description is required',
                'summary.required' => 'The Summary is required',
                'summary.min' => 'The minimum characters is 10',
                'price.required' => 'The Price is required',
                'price.numeric' => 'The Price should be a number',
                'price.gte' => 'The Price should be greate than or equal 0',
                'selected_categories.required' => 'The Categories is required',
                'selected_categories.exists' => 'The Categories is Invalid',
                'slug.required' => 'The Slug is required',
                'slug.unique' => 'The Slug already exists',
            ],
            [],
            //if validation fails run this function
            fn() => $this->alert('error','The Validation Failed Please Check Your Inputs')
        );


        $product = Product::query()->updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'status' => $this->status ? 'active' : 'inactive',
                'summary' => $this->summary,
                'description' => $this->description,
                'price' => $this->price,
            ]
        );
        if ($product) {
            if ($this->productId) {
                $message = 'The Product was updated !';
                if (is_null($this->image)) {
                    if ($product->media->where('collection_name' , 'products')->count() > 0) {
                        $product->media->where('collection_name' , 'products')[0]?->delete();
                    }
                }
                if ($this->newImage) {
                    if ($product->media->where('collection_name' , 'products')->count() > 0) {
                        $product->media->where('collection_name' , 'products')[0]?->delete();
                    }
                    $product->addMedia($this->newImage)
                        ->toMediaCollection('products');
                }
            } else {
                $message = 'The Product was created !';
                if ($this->image) {
                    $product->addMedia($this->image)->toMediaCollection('products');
                }
            }

            if (count($this->newMultiImages) > 0) {
                foreach ($this->newMultiImages as $newMultiImage) {
                    $product->addMedia($newMultiImage)->toMediaCollection('products_collection');
                }

            }

            $categories = Category::findMany($this->selected_categories);
            $data = [];
            foreach ($categories as $category) {
                $data[] = [
                    'product_id' => $product->id,
                    'category_id' => $category->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            ProductCategory::where('product_id', $this->productId)->delete();
            ProductCategory::insert($data);
            $this->alert('success', $message, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);

            if ($this->productId) {
                return redirect()->route('admin.product');
            }
            $this->dispatchBrowserEvent('productAdded');
            $this->reset(['name', 'summary', 'slug', 'price', 'selected_categories', 'status', 'image', 'newImage', 'productId', 'multiImages', 'newMultiImages', 'previouslyAddedNewImages']);
            return back();
        }

        $this->alert('error', 'The Product was not created please try again later', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function removeFromNewMultiImage($key)
    {
        $file = $this->newMultiImages[$key];
        if (($key2 = array_search($file, $this->previouslyAddedNewImages)) !== false) {
            unset($this->previouslyAddedNewImages[$key2]);
        }
        unset($this->newMultiImages[$key]);
    }

    public function removeFromMultiImage($key, $id)
    {
        $this->galleryId = $id;
        $this->galleryKey = $key;

        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Product',
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'onConfirmed' => 'deleteImageFromMultiIMage',
            'onDismissed' => '',
            'cancelButtonText' => 'Cancel ',
            'confirmButtonText' => 'Delete',
        ]);

    }

    public function deleteImageFromMultiIMage()
    {
        unset($this->multiImages[$this->galleryKey]);
        Media::query()->find($this->galleryId)->delete();
    }

    public function removeImage()
    {
        $this->reset('image');
    }

    public function removeImageForUpdate()
    {
        $this->reset('newImage');
    }

    public function render()
    {
        return view('livewire.products.product-form');
    }
}
