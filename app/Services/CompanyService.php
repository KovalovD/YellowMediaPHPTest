<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Collection;

class CompanyService
{
    public function getByUser(User $user): Collection
    {
        return $user->companies()->get();
    }

    public function createAndAssignCompany(User $user, array $input): Company
    {
        $company = $this->createCompany($input);

        $this->assignCompany($user, $company);

        return $company;
    }

    public function createCompany(array $input): Company
    {
        return Company::create($input);
    }

    public function assignCompany(User $user, Company $company): bool
    {
        $user->companies()->attach($company->id);

        return true;
    }
}
