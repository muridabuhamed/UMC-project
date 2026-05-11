<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FeePayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeePaymentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FeePayment');
    }

    public function view(AuthUser $authUser, FeePayment $feePayment): bool
    {
        return $authUser->can('View:FeePayment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FeePayment');
    }

    public function update(AuthUser $authUser, FeePayment $feePayment): bool
    {
        return $authUser->can('Update:FeePayment');
    }

    public function delete(AuthUser $authUser, FeePayment $feePayment): bool
    {
        return $authUser->can('Delete:FeePayment');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:FeePayment');
    }

    public function restore(AuthUser $authUser, FeePayment $feePayment): bool
    {
        return $authUser->can('Restore:FeePayment');
    }

    public function forceDelete(AuthUser $authUser, FeePayment $feePayment): bool
    {
        return $authUser->can('ForceDelete:FeePayment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FeePayment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FeePayment');
    }

    public function replicate(AuthUser $authUser, FeePayment $feePayment): bool
    {
        return $authUser->can('Replicate:FeePayment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FeePayment');
    }

}