<?php

namespace App\Model;
use App\Model\DailyInput;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    protected $table = "staff_detail";
    public $timestamps = false;

    public function designation()
    {
        return $this->belongsTo('App\Model\Designation');
    }

    public function dailyInput(){
        return $this->hasMany(DailyInput::class);
    }

}
