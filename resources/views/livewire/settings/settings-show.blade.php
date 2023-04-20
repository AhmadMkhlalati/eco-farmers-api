@section('title', 'Socail Media')

<div>
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Social Media Links
            </h2>
            <div class="mt-3">
                <button  wire:click="save" style="background-color:#AA6949;color:white"  class="btn btn-primary"> Save </button>

            </div>
        </div>

        <div id="input" class="p-5">

            <div class="preview">

                {{-- <div class="mt-5">
                    <label for="regular-form-1" class="form-label">LinkedIn</label>
                    <input wire:model="linkedIn" id="regular-form-1" style="border-radius:4px" type="text" class="form-control" placeholder="Name of project"/>
                </div> --}}

                <div class="mt-5">
                    <label for="regular-form-1" class="form-label">Facebook</label>
                    <input wire:model="facebook" id="regular-form-1" style="border-radius:4px" type="text"
                        class="form-control" placeholder="Facebook Link" />
                </div>

                <div class="mt-5">
                    <label for="regular-form-1" class="form-label">Instagram</label>
                    <input wire:model="instagram" id="regular-form-1" style="border-radius:4px" type="text"
                        class="form-control" placeholder="Instagram Link" />
                </div>

                {{-- <div class="mt-5">
                    <label for="regular-form-1" class="form-label">youtube</label>
                    <input wire:model="youtube" id="regular-form-1" style="border-radius:4px" type="text" class="form-control" placeholder="Name of project"/>
                </div> --}}

                {{-- <div class="mt-5">
                    <label for="regular-form-1" class="form-label">tiktok</label>
                    <input wire:model="tiktok" id="regular-form-1" style="border-radius:4px" type="text" class="form-control" placeholder="Name of project"/>
                </div> --}}

                <div class="mt-5">
                    <label for="regular-form-1" class="form-label">Whatsapp</label>
                    <input wire:model="whatsapp" id="regular-form-1" style="border-radius:4px" type="text"
                        class="form-control" placeholder="Whatsapp Link" />
                </div>

                {{-- <div class="mt-5">
                    <label for="regular-form-1" class="form-label">twitter</label>
                    <input wire:model="twitter" id="regular-form-1" style="border-radius:4px" type="text" class="form-control" placeholder="Name of project"/>
                </div> --}}

                <div class="mt-5">
                    <label for="regular-form-1" class="form-label">Email</label>
                    <input wire:model="email" id="regular-form-1" style="border-radius:4px" type="text"
                        class="form-control" placeholder="Email" />
                </div>

                <div class="mt-5">
                    <label for="regular-form-1" class="form-label">Phone Number</label>
                    <input wire:model="phoneNumber" id="regular-form-1" style="border-radius:4px" type="text"
                        class="form-control" placeholder="Phone Number" />
                </div>



            </div>

        </div>
    </div>
</div>
