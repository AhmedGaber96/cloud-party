<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\IfsoMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class IfsoMemberPolicy
{
    use HandlesAuthorization;


   
    public function Checkuser():bool
    {
        dd('check user');
        return false;

    }


    
    public function viewAny(AuthUser $authUser): bool
    {
       
        return $authUser->can('ViewAny:IfsoMember');
    }

    public function view(AuthUser $authUser, IfsoMember $ifsoMember): bool
    {
        return $authUser->can('View:IfsoMember');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:IfsoMember');
    }

    public function update(AuthUser $authUser, IfsoMember $ifsoMember): bool
    {
        return $authUser->can('Update:IfsoMember');
    }

    public function delete(AuthUser $authUser, IfsoMember $ifsoMember): bool
    {
        return $authUser->can('Delete:IfsoMember');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:IfsoMember');
    }

    public function restore(AuthUser $authUser, IfsoMember $ifsoMember): bool
    {
        return $authUser->can('Restore:IfsoMember');
    }

    public function forceDelete(AuthUser $authUser, IfsoMember $ifsoMember): bool
    {
        return $authUser->can('ForceDelete:IfsoMember');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:IfsoMember');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:IfsoMember');
    }

    public function replicate(AuthUser $authUser, IfsoMember $ifsoMember): bool
    {
        return $authUser->can('Replicate:IfsoMember');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:IfsoMember');
    }

}