<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $reports
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list'));
    }

    public function viewID(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-id'));
    }

    public function viewWebsiteID(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-website_id'));
    }

    public function viewUserID(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-user_id'));
    }

    public function viewZoneWebsiteID(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-zone_website_id'));
    }

    public function viewDemandID(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-demand_id'));
    }

    public function viewDate(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-date'));
    }

    public function viewDRequest(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-d_request'));
    }

    public function viewDRequestsEmpty(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-d_requests_empty'));
    }

    public function viewDImpression(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-d_impression'));
    }

    public function viewDImpressionsUnique(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-d_impressions_unique'));
    }

    public function viewDEcpm(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-d_ecpm'));
    }

    public function viewDRevenue(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-d_revenue'));
    }
    public function viewCount(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-count'));
    }

    public function viewShare(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-share'));
    }

    public function viewPImpression(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-p_impression'));
    }

    public function viewTrafq(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-trafq'));
    }

    public function viewPEcpm(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-p_ecpm'));
    }

    public function viewPRevenue(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-p_revenue'));
    }

    public function viewProfit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-profit'));
    }

    public function viewSalePercent(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-sale_percent'));
    }

    public function viewSystemPercent(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-system_percent'));
    }

    public function viewTax(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-tax'));
    }

    public function viewFixCost(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-fix_cost'));
    }

    public function viewSalary(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-salary'));
    }

    public function viewDeduction(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-deduction'));
    }

    public function viewNetProfit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-list-net_profit'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-add'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $reports
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-edit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $reports
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.reports-delete'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $reports
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user,  $reports)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\  $reports
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user,  $reports)
    {
        //
    }
}
