<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'category_id', 'description', 'transaction_date','user_id'];


    protected $dates = ['transaction_date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        if(auth()->check())
        {
            static::addGlobalScope('user_id', function (Builder $builder) {
                $builder->where('user_id', auth()->id());
            });
        }
    }
}
