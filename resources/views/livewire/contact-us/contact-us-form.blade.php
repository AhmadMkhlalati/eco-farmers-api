@section('title', 'Show Leads')
<x-card>

    <x-slot name="body">
        <div>

            <div id="input" class="p-5">
                <div class="preview">
                    <div>
                        <label for="regular-form-1" class="form-label">Name</label>
                        <input wire:model="name" disabled id="regular-form-1" type="text" style="border-radius: 4px"
                            class="form-control" />

                    </div>
                    <br>

                    <div>
                        <label for="regular-form-1" class="form-label">Email</label>
                        <input wire:model="email" disabled id="regular-form-1" type="text" style="border-radius: 4px"
                            class="form-control" />

                    </div>

                    <br>
                    @if ($phone)
                        <div>
                            <label for="regular-form-1" class="form-label">Phone</label>
                            <input wire:model="phone" disabled id="regular-form-1" type="text"
                                style="border-radius: 4px" class="form-control" />

                        </div>

                        <br>
                    @endif
                    @if ($subject)
                        <div>
                            <label for="regular-form-1" class="form-label">Subject</label>
                            <input wire:model="subject" disabled id="regular-form-1" type="text"
                                style="border-radius: 4px" class="form-control" />

                        </div>

                        <br>
                    @endif

                    <div class="input-form mt-3">
                        <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row"> Message
                        </label>
                        <textarea style="height:200px" id="validation-form-6" class="form-control" wire:model="message"></textarea>

                    </div>

                </div>

            </div>
        </div>
    </x-slot>
</x-card>
