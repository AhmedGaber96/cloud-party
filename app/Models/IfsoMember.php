<?php

namespace App\Models;

use App\GenderEnum;
use App\HcpDeclarationEnum;
use App\PrescriberEnum;
use App\ProfessionalRoleEnum;
use App\TitleEnum;
use App\WorkplaceEnum;
use Illuminate\Database\Eloquent\Model;

class IfsoMember extends Model
{
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'additional_emails',
        'city',
        'country',
        'mobile_phone',
        'photo',
        'consent',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'abstract_no',
        'year_of_birth',
        'gender',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'emergency_contact_email',
        'main_workplace',
        'professional_role',
        'prescriber',
        'hcp_declaration',
        'user_id',
        'document',
        'rating',
        'edit_due_date',
        'notes'
        
    ];
    protected $casts = [
        'title' => TitleEnum::class,
        'gender' => GenderEnum::class,
        'main_workplace' => WorkplaceEnum::class,
        'professional_role' => ProfessionalRoleEnum::class,
        'prescriber' => PrescriberEnum::class,
        'hcp_declaration' => HcpDeclarationEnum::class,
        'additional_emails' => 'array',
        'consent' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviewer()
{
    return $this->belongsTo(User::class, 'reviewer_id');
}
// protected static function booted()
// {
//     static::saving(function ($model) {
//         if ($model->edit_due_date) {
//               $model->city = 'alex';
//         } else {
//              $model->city =  $model->city;
//         }
//     });
// }
}
