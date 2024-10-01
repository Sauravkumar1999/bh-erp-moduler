<?php

namespace Modules\Bulletin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Entities\User;
use Plank\Mediable\Mediable;
use Laratrust\Traits\LaratrustUserTrait;

class Bulletin extends Model
{
    use Mediable, LaratrustUserTrait;
    use HasFactory, SoftDeletes;
    protected $table = 'bulletins';
    protected $fillable = ['title', 'distinguish', 'attachment', 'permission', 'content', 'user_id', 'deleted_at'];
  /**
     * The roles that belong to the Bulletin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bulletin()
    {
        return $this->hasMedia('attachment') ? route('media.image.display', $this->firstMedia('attachment')) :
            asset('images/no-image.png');
    }

}
