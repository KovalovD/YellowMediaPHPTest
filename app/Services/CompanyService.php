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

    public function createAndAssign(User $user, array $input): Company
    {
        $company = $this->create($input);

        $this->assign($user, $company);

        return $company;
    }

    public function create(array $input): Company
    {
        return Company::create($input);
    }

    public function assign(User $user, Company $company): bool
    {
        $user->companies()->attach($company->id);

        return true;
    }
}
