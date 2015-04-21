<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Postponse extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'postponse';
    protected $fillable = ['reason','location','timetogo','appointment_id','user_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function appointment(){
            return $this->belongsTo('App\Appointment','appointment_id');
    }
}
