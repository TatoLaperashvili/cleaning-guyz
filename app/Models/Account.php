<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       
        'author_id',
        'form_id',
        'account_type',
       
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

    /**
     * Get the account_type associated with the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dictionarie_account_type(): HasOne
    {
        return $this->hasOne(Dictionarie::class, 'id', 'account_type');
    }

    /**
     * Get the account_type associated with the Account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
  

    /**
     * Get all of the accountAnswers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountAnswers(): HasMany
    {
        return $this->hasMany(AccountAnswer::class, 'account_id', 'id');
    }

}
