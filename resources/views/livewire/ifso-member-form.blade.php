<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">

    <h2 class="text-xl font-bold mb-4 text-center">IFSO Registration</h2>

    {{-- Progress --}}
    <div class="flex justify-between mb-6 text-sm">
        @for ($i = 1; $i <= 4; $i++)
            <div class="flex-1 text-center">
                <div class="rounded-full w-8 h-8 mx-auto flex items-center justify-center
                    {{ $step >= $i ? 'bg-blue-600 text-white' : 'bg-gray-300' }}">
                    {{ $i }}
                </div>
            </div>
        @endfor
    </div>

    {{-- SUCCESS --}}
    @if(session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data">

        {{-- STEP 1 --}}
        @if($step == 1)
            <input type="text" wire:model.defer="first_name" placeholder="First Name" class="input">
            @error('first_name') <p class="text-red-500">{{ $message }}</p> @enderror

            <input type="text" wire:model.defer="last_name" placeholder="Last Name" class="input">

            <input type="email" wire:model.defer="email" placeholder="Email" class="input">

            <input type="text" wire:model.defer="mobile_phone" placeholder="Phone" class="input">

            <button type="button" wire:click="nextStep1" class="btn">Next</button>
        @endif

        {{-- STEP 2 --}}
        @if($step == 2)
            <input type="text" wire:model.defer="city" placeholder="City" class="input">
            <input type="text" wire:model.defer="country" placeholder="Country" class="input">

            <button type="button" wire:click="$set('step',1)" class="btn-gray">Back</button>
            <button type="button" wire:click="nextStep2" class="btn">Next</button>
        @endif

        {{-- STEP 3 --}}
        @if($step == 3)
            <input type="text" wire:model.defer="abstract_no" placeholder="Abstract No" class="input">

            <button type="button" wire:click="$set('step',2)" class="btn-gray">Back</button>
            <button type="button" wire:click="nextStep3" class="btn">Next</button>
        @endif

        {{-- STEP 4 --}}
        @if($step == 4)
            <input type="file" wire:model="photo" class="input">
            <input type="file" wire:model="document" class="input">

            <input type="text" wire:model.defer="emergency_contact_name" placeholder="Emergency Name" class="input">

            <label class="flex items-center gap-2">
                <input type="checkbox" wire:model="consent">
                <span>I agree</span>
            </label>

            <button type="button" wire:click="$set('step',3)" class="btn-gray">Back</button>
            <button type="submit" class="btn">Submit</button>
        @endif

    </form>
</div>

<style>
.input {
    @apply w-full border p-2 rounded mb-3;
}
.btn {
    @apply bg-blue-600 text-white px-4 py-2 rounded;
}
.btn-gray {
    @apply bg-gray-400 text-white px-4 py-2 rounded;
}
</style>