<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Elegant extends Model {

    protected $rules = array();
    protected $errors;

    public function validate($data) {
        // สร้างตัวตรวจสอบใหม่
        $v = Validator::make($data, $this->rules);

        // ตรวจว่ามีข้อผิดพลาดไหม
        if ($v->fails()) {

            $this->errors = $v->errors();
            return false;
        }


        return true;
    }

    public function errors() {
        return $this->errors;
    }

    public function validationRules($id = '0') {
        return str_replace("{id}", $id, $this->rules);
    }

    public function datethai($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

}
