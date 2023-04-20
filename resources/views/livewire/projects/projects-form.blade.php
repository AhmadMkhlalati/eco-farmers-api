@if ($projectId)
    @section('title', 'Update Project')
@else
    @section('title', 'Create Project')
@endif

<x-card>
    {{-- <x-slot name="title">
        {{ __('Create Project') }}
    </x-slot> --}}
    <x-slot name="subtitle">
        {{--            {{__('System Users')}} --}}
    </x-slot>
    <x-slot name="actions">
        <div class="flex items-center justify-between">
            <button wire:click="save" style="background-color:#AA6949;color:white" class="btn btn-primary"> Save
                Project
            </button>
        </div>
    </x-slot>
    <x-slot name="body">
        <div class="">
            <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    @if ($projectId)
                        Update Project
                    @else
                        Create Project
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
                               placeholder="Name of project"/>
                        @error('name')
                        <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <input wire:model="slug" disabled id="regular-form-1" type="text" class="form-control"
                               style="border-radius: 4px" placeholder="Slug of Project"/>
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
                        <textarea wire:model="description" rows="10" id="textarea_editor" type="text"
                                  class="form-control"
                                  placeholder="Input text"> </textarea>
                        @error('description')
                        <div class="text-danger mt-2">{{ $errors->first('description') }}</div>
                        @enderror
                    </div>
                    @if (!is_null($projectId))
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
                            <input wire:model="image" type="file" class="form-control" placeholder="Input text"/>
                        </div>
                        <div class="mt-3">
                            <img class="object-cover border-2 w-48 h-48 mt-2.5 "
                                 @if ($image) src="{{ $image->temporaryUrl() }}" @endif>
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
                window.addEventListener('projectAdded', event => {
                    globalEditor.setContent('');
                });
            </script>


    </x-slot>
</x-card>
