<?php namespace App;
use Illuminate\Database\Eloquent\Model as Model;
class Elegant extends Model
{
    protected $rules = array();
    protected $errors;

    public function validate($data)
    {
        // สร้างตัวตรวจสอบใหม่
        $v = Validator::make($data, $this->rules);

        // ตรวจว่ามีข้อผิดพลาดไหม
        if ($v->fails()) {
          
            $this->errors = $v->errors();
            return false;
        }

        
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
    
    public function validationRules($id = '0')
    {
        return str_replace("{id}", $id, $this->rules);
    } 
}
