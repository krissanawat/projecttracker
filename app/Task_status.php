<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Task_status extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'task_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = ['status', 'task_id'];

    public function task(){
            return $this->hasMany('App\Task','task_id');
    }
   
}
