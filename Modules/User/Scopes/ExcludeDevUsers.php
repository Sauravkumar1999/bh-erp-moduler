<?php

namespace Modules\User\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\User\Entities\Role;

class ExcludeDevUsers implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereDoesntHave('roles', function ($q) {
            $q->withoutGlobalScopes()
                ->whereIn('roles.name', Role::$PRO_ADMIN_ROLES);
        });
    }
}
