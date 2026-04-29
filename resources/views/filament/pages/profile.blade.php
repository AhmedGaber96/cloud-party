<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6">
        <x-filament::section>
            <x-slot name="heading">
                User Information
            </x-slot>

            <div class="space-y-4">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Full Name</span>
                    <span class="text-lg">{{ $user->name }}</span>
                </div>

                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Email Address</span>
                    <span class="text-lg">{{ $user->email }}</span>
                </div>

                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Account Created</span>
                    <span class="text-lg">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
