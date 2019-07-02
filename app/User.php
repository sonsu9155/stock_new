<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use DB;
use Cmgmyr\Messenger\Traits\Messagable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, Notifiable;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'phone', 'password', 'forgot_token', 'idcard', 'kh_bank', 'bank_name', 'bank_card', 'atmpwd', 'image_url', 'status', 'money_wallet_id', 'stock_wallet_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function valid_update_forgot() {
        return [
            'password' => 'required|min: 3|confirmed'
        ];
    }

    public static function valid($id='') {
        return [
        'name' => 'required',
        'username' => 'required|min:4|regex:/(^[A-Za-z][A-Za-z0-9!@#$%^&_*]*$)+/|unique:users,username'.($id ? ",$id" : ''),
        'email' => 'required|email|unique:users,email'.($id ? ",$id" : ''),
        'password' => 'required|min:3'
        ];
    }
    public static function valid_update($id='') {
        return [
        'name' => 'required',
        'username' => 'required|min:4|regex:/(^[A-Za-z][A-Za-z0-9!@#$%^&_*]*$)+/|unique:users,username'.($id ? ",$id" : ''),
        'email' => 'required|email|unique:users,email'.($id ? ",$id" : ''),
        'password' => 'min:3'
        ];
    }

    public function assigned() {
        if ($this->hasRole('super_admin')) {
            $this->hp = $this->phone;
            return $this;
        } else {
            $table = $this->table_name;
            $id = $this->table_id;
            return DB::table($table)->where('id', '=', $id)->first();
        }
    }

    public function buyHistories() {
        return $this->hasMany('App\BuyHistory', 'user_id');
    }

    public function sellHistories() {
        return $this->hasMany('App\SellHistory', 'user_id');
    }

    public function withdrawHistories() {
        return $this->hasMany('App\WithdrawHistory', 'user_id');
    }

    public function depositHistories() {
        return $this->hasMany('App\DepositHistory', 'user_id');
    }

}
