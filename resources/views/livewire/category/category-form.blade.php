@if ($categoryId)
    @section('title', 'Update Category')
@else
    @section('title', 'Create Category')
@endif

<x-card>
    {{-- <x-slot name="title">
        {{ __('Create category') }}
    </x-slot> --}}
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">
        <div class="flex items-center justify-between">
            <button wire:click="save" style="background-color:#AA6949;color:white" class="btn btn-primary"> Save
                category</button>
        </div>
    </x-slot>
    <x-slot name="body">
        <div class="">
            <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    @if ($categoryId)
                        Update category
                    @else
                        Create category
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

                    <div>
                        <label for="regular-form-1" class="form-label">Title</label>
                        <input wire:model="name" id="regular-form-1" type="text" style="border-radius: 4px"
                            class="form-control @error('name') border-danger @enderror"
                            placeholder="Name of category" />
                        @error('name')
                            <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="regular-form-1" class="form-label">Slug</label>
                        <input wire:model="slug" id="" type="text" style="border-radius: 4px" readonly
                               class="form-control @error('slug') border-danger @enderror"
                               placeholder="Slug of category" />
                        @error('slug')
                        <div class="text-danger mt-2">{{ $errors->first('slug') }}</div>
                        @enderror
                    </div>

                    @if (!is_null($categoryId))
                        @if (!is_null($newImage))
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Choose Image</label>
                                <input wire:model="newImage" type="file" class="form-control"
                                    placeholder="Input text" />
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
                                    placeholder="Input text" />
                            </div>
                            <div class="mt-3">
                                <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                    @if ($image) src="{{ (bool) filter_var($image, FILTER_VALIDATE_URL) ? $image : $image->temporaryUrl() }}" @endif>
                                <button wire:click="removeImage" class="btn btn-success  mb-2 mt-5"> Remove
                                    Image</button>
                            </div>
                        @endif
                    @else
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Choose Image</label>
                            <input wire:model="image" type="file" class="form-control" placeholder="Input text" />
                        </div>
                        <div class="mt-3">
                            <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                @if ($image) src="{{ $image->temporaryUrl() }}" @endif>
                            <button wire:click="removeImage" class="btn btn-success  mb-2 mt-5"> Remove Image</button>

                        </div>
                    @endif
                    @error('image')
                        <div class="text-danger mt-2">{{ $errors->first('image') }}</div>
                    @enderror
                </div>

            </div>
        </div>


    </x-slot>
</x-card>
