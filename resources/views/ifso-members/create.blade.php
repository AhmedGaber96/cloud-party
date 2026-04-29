<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>IFSO Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4"> <div class="max-w-4xl mx-auto p-6 bg-white mt-4 md:mt-10 rounded-2xl shadow">

    <h2 class="text-2xl font-bold mb-6 text-center md:text-left">IFSO Registration</h2>

    {{-- Success --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ifso-members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <select name="title" class="w-full border p-2 rounded @error('title') border-red-500 @enderror">
                <option value="">Select Title</option>
                @foreach($titles as $key => $value)
                    <option value="{{ $key }}" {{ old('title') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="text" name="first_name" placeholder="First Name"
                       value="{{ old('first_name') }}"
                       class="border p-2 rounded w-full @error('first_name') border-red-500 @enderror">
                @error('first_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="text" name="last_name" placeholder="Last Name"
                       value="{{ old('last_name') }}"
                       class="border p-2 rounded w-full @error('last_name') border-red-500 @enderror">
                @error('last_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <input type="email" name="email" placeholder="Email"
                   value="{{ old('email') }}"
                   class="border p-2 rounded w-full @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="additional_emails" placeholder="Additional Emails (comma separated)"
                   value="{{ old('additional_emails') }}"
                   class="border p-2 rounded w-full @error('additional_emails') border-red-500 @enderror">
            @error('additional_emails')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="text" name="city" placeholder="City"
                       value="{{ old('city') }}"
                       class="border p-2 rounded w-full @error('city') border-red-500 @enderror">
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="text" name="country" placeholder="Country"
                       value="{{ old('country') }}"
                       class="border p-2 rounded w-full @error('country') border-red-500 @enderror">
                @error('country')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <input type="text" name="mobile_phone" placeholder="Mobile Phone"
                   value="{{ old('mobile_phone') }}"
                   class="border p-2 rounded w-full @error('mobile_phone') border-red-500 @enderror">
            @error('mobile_phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-gray-50 p-3 border border-dashed rounded">
            <label class="block text-sm text-gray-600 mb-1">Profile Photo</label>
            <input type="file" name="photo"
                   class="w-full text-sm @error('photo') border-red-500 @enderror">
            @error('photo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-gray-50 p-3 border border-dashed rounded">
    <label class="block text-sm text-gray-600 mb-1">
        Upload Document (PDF or Word)
    </label>

    <input type="file" name="document"
           accept=".pdf,.doc,.docx"
           class="w-full text-sm @error('document') border-red-500 @enderror">

    <p class="text-xs text-gray-500 mt-1">
        Allowed formats: PDF, DOC, DOCX (Max: 5MB)
    </p>

    @error('document')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

        <div class="py-2">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="consent" class="w-5 h-5" value="1" {{ old('consent') ? 'checked' : '' }}>
                <span class="text-gray-700">I agree to data processing</span>
            </label>
            @error('consent')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach(['facebook_url','instagram_url','linkedin_url','twitter_url'] as $social)
                <div>
                    <input type="text" name="{{ $social }}" placeholder="{{ ucfirst(str_replace('_',' ',$social)) }}"
                           value="{{ old($social) }}"
                           class="border p-2 rounded w-full @error($social) border-red-500 @enderror">
                    @error($social)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
        </div>

        <hr class="my-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="number" name="year_of_birth" placeholder="Year of Birth"
                       value="{{ old('year_of_birth') }}"
                       class="border p-2 rounded w-full @error('year_of_birth') border-red-500 @enderror">
                @error('year_of_birth')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input type="text" name="abstract_no" placeholder="Abstract No"
                       value="{{ old('abstract_no') }}"
                       class="border p-2 rounded w-full @error('abstract_no') border-red-500 @enderror">
                @error('abstract_no')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach([
                'gender' => $genders,
                'main_workplace' => $workplaces,
                'professional_role' => $roles,
                'prescriber' => $prescribers,
                'hcp_declaration' => $hcpDeclarations
            ] as $name => $options)
                <div>
                    <select name="{{ $name }}" class="w-full border p-2 rounded @error($name) border-red-500 @enderror">
                        <option value="">Select {{ ucfirst(str_replace('_',' ',$name)) }}</option>
                        @foreach($options as $key => $value)
                            <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error($name)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
        </div>

        <h3 class="font-bold mt-8 border-b pb-2">Emergency Contact</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach([
                'emergency_contact_name' => 'Name',
                'emergency_contact_relationship' => 'Relationship',
                'emergency_contact_phone' => 'Phone',
                'emergency_contact_email' => 'Email'
            ] as $name => $label)
                <div>
                    <input type="{{ str_contains($name,'email') ? 'email' : 'text' }}"
                           name="{{ $name }}"
                           placeholder="{{ $label }}"
                           value="{{ old($name) }}"
                           class="border p-2 rounded w-full @error($name) border-red-500 @enderror">
                    @error($name)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl w-full transition duration-200 mt-6">
            Complete Registration
        </button>

    </form>
</div>

</body>
</html>