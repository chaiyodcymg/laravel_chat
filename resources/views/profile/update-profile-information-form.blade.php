<x-jet-form-section submit="updateProfileInformation">


    <x-slot name="form">
        <!-- Profile Photo -->

        <b style="font-size: 1rem;" class="text-center">Edit Profile</b>
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4" style="width: 50vw; max-width:600px; min-width:400px;">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <div class="d-flex align-items-center justify-content-center flex-column mt-2">
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <a href="{{ $this->user->profile_photo_url }}">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" style="width: 150px;height: 150px; border-radius: 50%;object-fit: cover;">
                    </a>
                </div>

                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');width: 150px;height: 150px; border-radius: 50%;object-fit: cover;'">
                    </span>
                </div>
            </div>


            <!-- New Profile Photo Preview -->


            <div class="d-flex align-items-center justify-content-center">
                <x-jet-secondary-button class="m-2 " type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>
            </div>


            <x-jet-input-error for="photo" class="mt-2" />
        </div>
        @endif



        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 m-2">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" maxlength="20"/>
            <p style="color: red;">*จำกัดตัวอักษร 20 ตัว</p>
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4 m-2">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <button class="btn bg-success text-white" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </button>
    </x-slot>
</x-jet-form-section>