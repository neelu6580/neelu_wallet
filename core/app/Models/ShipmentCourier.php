<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentCourier extends Model
{
    protected $table = 'shipment_couriers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'object', 'type', 'readable', 'logo', 'access_key_id', 'secret_key', 'merchant_id', 'status', 'margin'
    ];
}
