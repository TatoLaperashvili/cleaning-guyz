<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allowance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'author_id',
        'form_id',
        'purchase_object',
    ];

    /**
     * Get the author associated with the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the form associated with the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function form(): HasOne
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }


}
