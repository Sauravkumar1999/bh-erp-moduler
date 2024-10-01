<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyNews extends Model
{
        use SoftDeletes;
        protected $table = 'monthly_news';


        /**
         * Attributes that should be mass-assignable.
         *
         * @var array
         */
        protected $fillable = ['detail', 'form', 'posting_date'];
}
