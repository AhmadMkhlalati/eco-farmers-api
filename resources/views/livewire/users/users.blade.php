<div>
    @section('title', 'Users')
    <livewire:universal-component/>
    <x-card>
        <x-slot name="title">
            {{__('Users')}}
        </x-slot>
        <x-slot name="subtitle">
            {{__('System Users')}}
        </x-slot>
        <x-slot name="actions">

            <div class="flex items-center justify-between">

                <x-jet-button wire:click="createUserModal" >{{__('Create User')}}</x-jet-button>
                <x-jet-dialog-modal wire:model="modalFormVisible" maxWidth="4xl" >
                    <x-slot name="title">
                        {{ __('Create New User') }}

                    </x-slot>

                    <x-slot name="content">
                        <div>
                            <x-jet-label  for="name" value="{{ __('Name') }}" />
                            <x-jet-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus />
                            <x-jet-input-error for="name"></x-jet-input-error>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"  required  />
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>
                        <div class="mt-4">
                            <div
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <!-- File Input -->
                                <input type="file" wire:model="photo">

                                <!-- Progress Bar -->
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
{{--                            @if ($photo)--}}
{{--                                Photo Preview:--}}
{{--                                <img class="object-cover w-48 h-48  rounded-full" src="{{$photo->temporaryUrl()}}">--}}
{{--                            @endif--}}
                        </div>
                        <div class="mt-4 h-full">
                            <x-jet-label for="confirm_password" value="{{ __('Upload Image') }}" />

                            <select wire:model="role" required>
                                <option value="">{{__('please select a role')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"  required  />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="confirm_password" value="{{ __('Confirm Password') }}" />
                            <x-jet-input wire:model="confirm_password" id="confirm_password" class="block mt-1 w-full" type="password" name="confirm_password"  required  />

                        </div>

                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="stopModalFormVisible" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-button class="ml-3"  wire:click="createUser" wire:loading.attr="disabled">
                            {{ __('Create New User') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-dialog-modal>
            </div>
        </x-slot>
        <x-slot name="body">
                <livewire:users.user-table/>
        </x-slot>
    </x-card>

</div>


