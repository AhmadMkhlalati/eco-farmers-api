@section('title', 'Shipping Details')

<x-card>

    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">
        <div class="flex items-center justify-between">
            <button wire:click="save" style="background-color:#AA6949;color:white" class="btn btn-primary">Save</button>
        </div>
    </x-slot>
    <x-slot name="body">
        <div class="">

            <div id="input" class="p-5">
                <div class="preview">

                    <div>
                        <label for="regular-form-1" class="form-label">Title</label>
                        <input wire:model="title" id="regular-form-1" type="text" style="color:black;border-radius: 4px"
                            class="form-control @error('title') border-danger @enderror"
                            placeholder="Title of Service" />
                        @error('title')
                            <div class="text-danger mt-2">{{ $errors->first('title') }}</div>
                        @enderror
                    </div>

                    <div class="mt-3" wire:ignore>
                        <label for="textarea_editor" class="form-label">Enter Description</label>
                        <textarea wire:model="description" rows="10" id="textarea_editor" type="text" class="form-control"
                            placeholder="Input text"> </textarea>
                        @error('description')
                            <div class="text-danger mt-2">{{ $errors->first('description') }}</div>
                        @enderror
                    </div>

                    @if (!is_null($shippingId))
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
                                @if ($image) src="{{ Str::contains($image, 'http') ? $image : $image->temporaryUrl() }}" @endif>
                            <button wire:click="removeImage" class="btn btn-success  mb-2 mt-5"> Remove Image</button>

                        </div>
                    @endif
                </div>

            </div>
        </div>
        @push('scripts')
            <script>
                let globalEditor = '';
                tinymce.init({
                    selector: '#textarea_editor',
                    forced_root_block: false,
                    setup: function(editor) {
                        editor.on('init change', function() {
                            editor.save();
                        });
                        editor.on('change', function(e) {
                            @this.set('description', editor.getContent());
                        });
                        globalEditor = editor;
                    }
                });
                window.addEventListener('shippingAdded', event => {
                    globalEditor.setContent('');
                });
            </script>
        @endpush

    </x-slot>
</x-card>
