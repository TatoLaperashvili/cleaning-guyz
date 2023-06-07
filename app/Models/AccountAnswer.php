<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['answers', 'account_id', 'user_id', 'organization_id'];

    protected $casts = [
        'answers' => 'json'
    ];

    /**
     * Get the user associated with the AccountAnswer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

     /**
     * Get the account associated with the AccountAnswer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }


}
