<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    protected $table = "ipaddresses";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'ip_address',
        'description',
        'created_by',
        'created_dt',
        'updated_by',
        'updated_dt',
    ];
}
