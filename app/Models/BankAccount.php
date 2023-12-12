<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ['agency', 'account', 'bank', 'bank_id'];

    public function banks()
    {
        return $this->hasMany(Bank::class, 'id', 'bank_id');
    }
}
