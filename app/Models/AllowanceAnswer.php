<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AllowanceAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['answers', 'allowance_id', 'message', 'status', 'user_id', 'organization_id', 'tender_id', 'purchase_object', 'user_comment'];

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
    public function allowance(): HasOne
    {
        return $this->hasOne(Allowance::class, 'id', 'allowance_id');
    }


 
}
