<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kalnoy\Nestedset\NodeTrait;
use Laratrust\Traits\LaratrustUserTrait;
use Modules\Allowance\Entities\Allowance;
use Modules\Bulletin\Entities\Bulletin;
use Modules\Company\Entities\Company;
use Modules\Product\Entities\Product;
use Modules\PushNotification\Entities\PushNotification;
use Modules\User\Scopes\ExcludeDevUsers;
use Plank\Mediable\Mediable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class User extends Authenticatable
{
    use LaratrustUserTrait, HasApiTokens, Notifiable, Mediable, NodeTrait, SoftDeletes, LogsActivity {
        Mediable::newCollection insteadof NodeTrait;
    }

    protected static function booted()
    {
        // global scope to exclude dev users
        if (auth()->check() && !auth()->user()->isProAdmin()) {
            static::addGlobalScope(new ExcludeDevUsers);
        }
        static::deleting(function ($user) {
            if ($user->isForceDeleting()) {
                // Force delete all related contacts
                $user->contacts()->forceDelete();
            } else {
                // Soft delete all related contacts
                $user->contacts()->delete();
            }
        });
    }

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'first_name', 'last_name', 'username', 'email', 'dob', 'gender', 'password', 'status', 'last_login', 'final_confirmation', 'company_id', 'parent_id', 'user_type', 'submitted_date', 'deposit_date', 'start_date', 'end_date'
    ];


    protected $dates = ['deleted_at', 'final_confirmation'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function adminlte_profile_url()
    {
        return '/profile';
    }

    public function avatar()
    {
        return $this->hasMedia('avatar') ? route('media.image.display', $this->firstMedia('avatar')) :
            asset('images/no-image.png');
    }

    public function idCard()
    {
        return $this->hasMedia('idCard') ? route('media.image.display', $this->firstMedia('idCard')) :
            asset('images/no-image.png');
    }


    public function salesPersonImage()
    {
        return $this->hasMedia('sales-person') ? route('media.image.display', $this->firstMedia('sales-person')) :
            asset('images/no-image.png');
    }

    public function bankbook()
    {
        return $this->hasMedia('bankbook') ? route('media.image.display', $this->firstMedia('bankbook')) :
            asset('images/no-image.png');
    }

    public function isProAdmin()
    {
        return $this->hasRole('admin|developer');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin|developer|chief');
    }

    // ===== Relations section ======

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }

    public function productRights()
    {
        return $this->morphToMany(Product::class, 'rightable')
            ->withPivot(['type', 'odr_app', 'product_expose']);
    }

    public function userSetting()
    {
        return $this->hasOne(UserSetting::class);
    }
    public function allowance()
    {
        return $this->hasMany(Allowance::class, 'member_id');
    }

    public function adminProductSettings()
    {
        return $this->belongsToMany(Product::class, 'prod_user_settings', 'user_id', 'product_id')
            ->withPivot('url', 'status');
    }

    public function scopeWhereEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeWhereCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function notifications()
    {
        return $this->morphToMany(PushNotification::class, 'notifiable');
    }

    public function userWhereRole($role)
    {
        return $this->hasRole($role);
    }

    // Log model changes
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(
                [
                    'first_name',
                    'dob',
                    'gender',
                    'password',
                    'company_id',
                    'user_type',
                    'submitted_date',
                    'deposit_date',
                    'start_date',
                    'end_date'
                ])->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

}
