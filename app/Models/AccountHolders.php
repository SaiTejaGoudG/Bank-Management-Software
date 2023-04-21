<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class AccountHolders extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'contact_number',
        'email',
        'address',
        'pin_code',
        'state_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate account number
            $accountNumber = '';
            for ($i = 0; $i < 12; $i++) {
                $accountNumber .= rand(0, 9);
            }
            $model->account_number = $accountNumber;
            // dd($accountNumber);
            $model->amount_balance = 0;
        });
        
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
