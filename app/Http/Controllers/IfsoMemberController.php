<?php

namespace App\Http\Controllers;

use App\GenderEnum;
use App\HcpDeclarationEnum;
use App\Jobs\SendFilamentResetPassword;
use App\Jobs\SendMemberWelcomeEmail;
use App\Models\IfsoMember;
use App\Models\User;
use App\PrescriberEnum;
use App\ProfessionalRoleEnum;
use App\TitleEnum;
use App\WorkplaceEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class IfsoMemberController extends Controller
{
    public function create()
    {
        return view('ifso-members.create', [
            'titles' => TitleEnum::options(),
            'genders' => GenderEnum::options(),
            'workplaces' => WorkplaceEnum::options(),
            'roles' => ProfessionalRoleEnum::options(),
            'prescribers' => PrescriberEnum::options(),
            'hcpDeclarations' => HcpDeclarationEnum::options(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:ifso_members,email|unique:users,email',
            'additional_emails' => 'nullable|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'mobile_phone' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'consent' => 'required|accepted',

            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',

            'abstract_no' => 'required|string',
            'year_of_birth' => 'required|integer|min:1900|max:' . date('Y'),

            'gender' => 'required|string',
            'main_workplace' => 'required|string',
            'professional_role' => 'required|string',
            'prescriber' => 'required|string',
            'hcp_declaration' => 'required|string',

            'emergency_contact_name' => 'required|string',
            'emergency_contact_relationship' => 'required|string',
            'emergency_contact_phone' => 'required|string',
            'emergency_contact_email' => 'required|email',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);
        
        return DB::transaction(function () use ($request, $data) {

            // 1. Upload photo
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('members', 'public');
            }
            if ($request->hasFile('document')) {
    $data['document'] = $request->file('document')->store('documents', 'public');
}

            // 2. Convert additional emails to array
            if (!empty($data['additional_emails'])) {
                $data['additional_emails'] = array_map('trim', explode(',', $data['additional_emails']));
            }

            // 3. Consent checkbox
            $data['consent'] = $request->has('consent');

            // 4. Create user
            $user = User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make(Str::random(32)),
            ]);

            // 5. Assign role
            //$user->assignRole('member');

            // add user id 
            $data['user_id'] = $user->id;

            // 6. Create member
            IfsoMember::create($data);

            // 7. Generate reset token (clean way)
            $token = app('auth.password.broker')->createToken($user);

            // 8. Dispatch Job (async email)
            SendMemberWelcomeEmail::dispatch($user, $token);

            return redirect()->back()->with(
                'success',
                'Registration successful! Please check your email to set your password. ✅'
            );
        });
    }
}