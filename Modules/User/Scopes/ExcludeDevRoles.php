<?php

namespace Modules\User\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExcludeDevRoles implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereNotIn('name', $model::$PRO_ADMIN_ROLES);
    }
}
