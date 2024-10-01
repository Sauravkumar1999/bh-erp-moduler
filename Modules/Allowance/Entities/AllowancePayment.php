<?php

namespace Modules\Allowance\Entities;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;
use Plank\Mediable\Mediable;

class AllowancePayment extends Model
{
    use Mediable;
    protected $guarded = ['id'];
    protected $fillable = ['title','detail','user_id'];

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id')->withoutGlobalScopes();
    }
    public function attachment()
    {
        return $this->hasMedia('allowance-payment') ? route('media.image.display', $this->firstMedia('allowance-payment')) :
            asset('images/no-image.png');
    }
}
