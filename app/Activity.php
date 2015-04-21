<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_time', 'end_time', 'status','approve','task_id','completed_at'];

    public function task(){
            return $this->hasMany('App\Task','activity_id');
    }
   
}
