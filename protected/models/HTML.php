<?php

class HTML {

    public static function dropdownFieldStatus($eleData, $eleName) {
        $status = array(
            'active' => 'เปิด',
            'inactive' => 'ปิด',
        );
        $default = 'active';
        if (!empty($eleData)) {
            $default = '';
        }
        $html = '<div class="field">
                    <label>สถานะ</label>
                    <select required="required" name="' . $eleName . '" class="fluid selection ui dropdown">
                        <option value="">--เลือก--</option> ';
        foreach ($status as $index => $data) {
            if ($eleData == $index || $default == $index) {
                $html .= '<option value="' . $index . '" selected>' . $data . '</option> ';
            } else {
                $html .= '<option value="' . $index . '">' . $data . '</option>';
            }
        }
        $html .='  </select> </div>  ';
        return $html;
    }

}
