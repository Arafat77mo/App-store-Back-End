<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateways extends Model
{
    use HasFactory;
    protected $table = "Payment Gateways";
    protected $fillable = ["name","active"];
}
