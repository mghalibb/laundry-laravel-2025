<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransOrder extends Model
{
    use HasFactory;
    protected $table = 'trans_order';
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details()
    {
        return $this->hasMany(TransOrderDetail::class, 'id_order');
    }

    public function getTotalPriceAttribute()
    {
        $subtotal = $this->details->sum('subtotal');
        return $subtotal + $this->tax + $this->admin_fee;
    }

    public function pickup()
    {
        return $this->hasOne(TransLaundryPickup::class, 'id_order');
    }
}
