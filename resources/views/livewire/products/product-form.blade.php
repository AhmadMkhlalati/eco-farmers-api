@if ($productId)
    @section('title', 'Update Product')
@else
    @section('title', 'Create Product')
@endif

<x-card>
    {{-- <x-slot name="title">
        {{ __('Create Products') }}
    </x-slot> --}}
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">
        <div class="flex items-center justify-between">
            <button wire:click="save" style="background-color:#AA6949;color:white" class="btn btn-primary"> Save
                Products
            </button>
        </div>
    </x-slot>
    <x-slot name="body">
        <div class="">
            <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    @if ($productId)
                        Update Product
                    @else
                        Create Product
                    @endif
                </h2>
            </div>
            <div id="input" class="p-5">
                <div class="preview">
                    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                        <label class="form-check-label ml-0" for="">Active?</label>
                        <input wire:model="status" style="box-shadow:3px 1px 13px 0px #767676bf"
                               class=" form-check-input mr-0 ml-3" type="checkbox">
                        @error('status')
                        <div class="text-danger mt-2">{{ $errors->first('status') }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="regular-form-1" class="form-label">Name</label>
                        <input wire:model="name" id="regular-form-1" type="text" style="border-radius: 4px"
                               class="form-control" placeholder="Name of Product"/>
                        @error('name')
                        <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <input wire:model="slug" disabled id="regular-form-1" type="text" class="form-control"
                               style="border-radius: 4px" placeholder="Slug of Service"/>
                        @error('slug')
                        <div class="text-danger mt-2">{{ $errors->first('slug') }}</div>
                        @enderror
                    </div>
                    <br>
                    <div class="input-form mt-3">
                        <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row"> Summary
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 10
                                characters</span> </label>
                        <textarea id="validation-form-6" class="form-control" wire:model="summary"
                                  placeholder="Enter Summary" minlength="10"
                                  required=""></textarea>
                        @error('summary')
                        <div class="text-danger mt-2">{{ $errors->first('summary') }}</div>
                        @enderror
                    </div>

                    <div class="mt-3" wire:ignore>
                        <label for="textarea_editor" class="form-label">Enter Description</label>
                        <textarea id="textarea_editor" wire:model="description" rows="10" type="text"
                                  class="form-control mceEditor"
                                  placeholder="Input text"> </textarea>

                    </div>
                    @error('description')
                    <div class="text-danger mt-2">{{ $errors->first('description') }}</div>
                    @enderror
                    <br>
                    <div style="background-color: white">
                        <!-- BEGIN: Multiple Select -->
                        <div wire:ignore class="intro-y box mt-5">
                            <div
                                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">
                                    Categories
                                </h2>

                            </div>
                            <div id="multiple-select" class="p-5">
                                <div class="preview">
                                    <select id="categories_select" wire:model="selected_categories"
                                            data-placeholder="Select Category" class="tom-select w-full" multiple>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $category->id }}"
                                                    @if (!is_null($selectedCategories) &&
                                                        !is_string($selectedCategories) &&
                                                        $selectedCategories->isNotEmpty() &&
                                                        in_array($category->id, $selectedCategories->pluck('category_id')->toArray())) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('selected_categories')
                        <div class="text-danger mt-2">{{ $errors->first('selected_categories') }}</div>
                        @enderror
                        <!-- END: Multiple Select -->
                    </div>
                    <div class="input-form mt-3">
                        <label for="validation-form-4" class="form-label w-full flex flex-col sm:flex-row"> Price <span
                                class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, integer only & maximum
                                3 characters</span> </label>
                        <input style="border-radius: 4px" wire:model="price" id="validation-form-4" min="0"
                               type="number" class="form-control" placeholder="Enter Price" required>
                        @error('price')
                        <div class="text-danger mt-2">{{ $errors->first('price') }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mt-3">
                        <label for="regular-form-1" class="form-label">Price</label>
                        <input wire:model="price" id="regular-form-1" type="text" style="border-radius: 4px"
                            class="form-control" placeholder="Price" />
                        @error('price')
                            <div class="text-danger mt-2">{{ $errors->first('price') }}</div>
                        @enderror
                    </div> --}}


                    @if (!is_null($productId))
                        @if (!is_null($newImage))
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Choose Image</label>
                                <input wire:model="newImage" type="file" class="form-control"
                                       placeholder="Input text"/>
                            </div>
                            <div class="mt-3">
                                <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                     @if ($newImage) src="{{ $newImage->temporaryUrl() }}" @endif>
                                <button wire:click="removeImageForUpdate" class="btn btn-success  mb-2 mt-5"> Remove
                                    Image
                                </button>
                            </div>
                        @else
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Choose Image</label>
                                <input wire:model="newImage" type="file" class="form-control"
                                       placeholder="Input text"/>
                            </div>
                            <div class="mt-3">
                                <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                     @if ($image) src="{{ (bool) filter_var($image, FILTER_VALIDATE_URL) ? $image : $image->temporaryUrl() }}" @endif>
                                <button wire:click="removeImage" class="btn btn-success  mb-2 mt-5"> Remove
                                    Image
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Choose Image</label>
                            <input wire:model="image" type="file" class="form-control"
                                   placeholder="Input text"/>
                        </div>
                        <div class="mt-3">
                            <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                 @if ($image) src="{{ $image->temporaryUrl() }}" @endif>
                            <button wire:click="removeImage" class="btn btn-success  mb-2 mt-5"> Remove Image</button>

                        </div>
                    @endif
                    <div class="mt-3 flex-wrap"  style="display:flex;">
                        @foreach($multiImages as $key => $image)
                            <div class="px-2">
                                <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                     @if ($image) src="{{ $image->getFullUrl() }}" @endif>
                                <button wire:click="removeFromMultiImage({{$key}} , {{$image->id}})"
                                        class="btn btn-success  mb-2 mt-5 " style="background-color: red; color: white">
                                    Remove Image
                                </button>
                            </div>

                        @endforeach

                        @foreach($newMultiImages as $key => $image)
                            <div class="px-2">
                                <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                     @if ($image) src="{{ $image->temporaryUrl() }}" @endif>
                                <button wire:click="removeFromNewMultiImage({{$key}})"
                                        class="btn btn-success  mb-2 mt-5 " style="background-color: red; color: white">
                                    Remove Image
                                </button>
                            </div>

                        @endforeach
                            <div style="width: 192px;height: 268px">
                                <label>
                                    <div class="object-cover w-50 h-50 mt-2.5 text-center text-5xl text-secondary"
                                         style="border-style: dotted; border-radius: 10px; border-width: thick;width: 100%;height: 71%;display: flex;justify-content: center;align-items: center;cursor: pointer;">
                                        +
                                    </div>
                                    <input name="newMultiImages" wire:model="newMultiImages" type="file" multiple
                                           style="display: none">
                                </label>
                            </div>

                    </div>

                </div>

            </div>
        </div>
        @push('scripts')
            <script>
                let globalEditor = '';
                tinymce.init({
                    selector: '#textarea_editor',
                    forced_root_block: false,
                    setup: function (editor) {
                        editor.on('init change', function () {
                            editor.save();
                        });
                        editor.on('change', function (e) {
                        @this.set('description', editor.getContent());
                        });
                        globalEditor = editor;
                    }
                });

                window.addEventListener('productAdded', event => {
                    globalEditor.setContent('');
                    $(".tom-select").each(function () {
                        if ($(this).attr('id') != undefined) {
                            let select = document.getElementById($(this).attr('id'));
                            let control = select.tomselect;
                            control.clear();
                        }
                    })
                });
            </script>

        @endpush

    </x-slot>
</x-card>

</div>

</div>

</div>


