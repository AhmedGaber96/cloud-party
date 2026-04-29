<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\IfsoMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Jobs\SendMemberWelcomeEmail;

class IfsoMemberForm extends Component
{
    use WithFileUploads;

    public $step = 1;

    // Step 1
    public $title, $first_name, $last_name, $email, $mobile_phone, $photo;

    // Step 2
    public $city, $country, $facebook_url, $instagram_url, $linkedin_url, $twitter_url;

    // Step 3
    public $abstract_no, $year_of_birth, $gender, $main_workplace, $professional_role, $prescriber, $hcp_declaration;

    // Step 4
    public $emergency_contact_name, $emergency_contact_relationship;
    public $emergency_contact_phone, $emergency_contact_email, $document, $consent;

    // ---------------- STEP VALIDATION ----------------

    public function nextStep1()
    {
        $this->validate([
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'required',
        ]);

        $this->step = 2;
    }

    public function nextStep2()
    {
        $this->validate([
            'city' => 'required',
            'country' => 'required',
        ]);

        $this->step = 3;
    }

    public function nextStep3()
    {
        $this->validate([
            'abstract_no' => 'required',
            'year_of_birth' => 'required|integer',
            'gender' => 'required',
        ]);

        $this->step = 4;
    }

    // ---------------- FINAL SUBMIT ----------------

    public function submit()
    {
        $this->validate([
            'emergency_contact_name' => 'required',
            'emergency_contact_phone' => 'required',
            'emergency_contact_email' => 'required|email',
            'consent' => 'accepted',
        ]);

        DB::transaction(function () {

            $photoPath = $this->photo ? $this->photo->store('members', 'public') : null;
            $docPath = $this->document ? $this->document->store('documents', 'public') : null;

            $user = User::create([
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'password' => Hash::make(Str::random(32)),
            ]);

            $user->assignRole('member');

            IfsoMember::create([
                'user_id' => $user->id,
                'title' => $this->title,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'city' => $this->city,
                'country' => $this->country,
                'mobile_phone' => $this->mobile_phone,
                'photo' => $photoPath,
                'document' => $docPath,
                'abstract_no' => $this->abstract_no,
                'year_of_birth' => $this->year_of_birth,
                'gender' => $this->gender,
                'main_workplace' => $this->main_workplace,
                'professional_role' => $this->professional_role,
                'prescriber' => $this->prescriber,
                'hcp_declaration' => $this->hcp_declaration,
                'emergency_contact_name' => $this->emergency_contact_name,
                'emergency_contact_phone' => $this->emergency_contact_phone,
                'emergency_contact_email' => $this->emergency_contact_email,
                'consent' => $this->consent,
            ]);

            $token = app('auth.password.broker')->createToken($user);
            SendMemberWelcomeEmail::dispatch($user, $token);
        });

        session()->flash('success', 'Registered successfully ✅');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.ifso-member-form');
    }
}