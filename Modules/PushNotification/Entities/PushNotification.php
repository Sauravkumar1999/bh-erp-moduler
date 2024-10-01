<?php

namespace Modules\PushNotification\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\Role;

class PushNotification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'contents', 'receiver', 'created_user_id', 'device_token'];
    protected $table = 'push_notifications';

    public function users()
    {
        return $this->morphedByMany(User::class, 'notifiable');
    }

    public function roles()
    {
        return $this->morphedByMany(Role::class, 'notifiable');
    }
}
