<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Geographical;

use Laravolt\Indonesia\Models\Kecamatan;

class Room extends Model 
{
    use Geographical;
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    protected static $kilometers = true;
    const LATITUDE  = 'lat';
    const LONGITUDE = 'lon';

    protected $hidden = [
        'created_at', 'updated_at', 'distance'
    ];

    public function district()
    {
        return $this->belongsTo('Kecamatan', 'foreign_key');
    }

}
