<?php 
namespace Core;

class FH {
    public static function inputBlock($label, $id, $value, $inputAttrs =[], $wrapperAttrs = [], $errors = []) {
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttrs($inputAttrs);
        $errorMsg = array_key_exists($id, $errors)? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<input id='{$id}' name='{$id}' value='{$value}' {$inputAttrs} />";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function selectBlock($label, $id, $value, $options, $inputAttrs=[], $wrapperAttrs=[], $errors=[]) {
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttrs($inputAttrs);
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $errorMsg = array_key_exists($id, $errors)? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<select id='{$id}' name='{$id}' {$inputAttrs}>";
        foreach($options as $val => $display) {
            $selected = $val == $value? ' selected ' : "";
            $html .= "<option value='{$val}'{$selected}>{$display}</option>"; 
        }
        $html .= "</select>";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function check($label, $id, $checked = '', $inputAttrs=[], $wrapperAttrs=[], $errors=[]) {
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $inputStr = self::processAttrs($inputAttrs);
        $checkedStr = $checked == 'on'? "checked" : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<input type=\"checkbox\" id=\"{$id}\" name=\"{$id}\" {$inputStr} {$checkedStr}>";
        $html .= "<label class=\"form-check-label\" for=\"{$id}\">{$label}</label></div>";
        return $html;
    }

    public static function textarea($label, $id, $value, $inputAttrs =[], $wrapperAttrs = [], $errors = []) {
        $wrapperStr = self::processAttrs($wrapperAttrs);
        $inputAttrs = self::appendErrors($id, $inputAttrs, $errors);
        $inputAttrs = self::processAttrs($inputAttrs);
        $errorMsg = array_key_exists($id, $errors)? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for='{$id}'>{$label}</label>";
        $html .= "<textarea id='{$id}' name='{$id}' value='{$value}' {$inputAttrs}>{$value}</textarea>";
        $html .= "<div class='invalid-feedback'>{$errorMsg}</div></div>";
        return $html;
    }

    public static function fileUpload($label, $id, $input = [], $wrapper = [], $errors=[]) {
        $inputAttrs = self::appendErrors($id, $input, $errors);
        $wrapperStr = self::processAttrs($wrapper);
        $inputStr = self::processAttrs($inputAttrs);
        $errorMsg = array_key_exists($id, $errors)? $errors[$id] : "";
        $html = "<div {$wrapperStr}>";
        $html .= "<label for=\"{$id}\">{$label}</label>";
        $html .= "<input type=\"file\" id=\"{$id}\" name=\"{$id}\" {$inputStr}/>";
        $html .= "<div class=\"invalid-feedback\">{$errorMsg}</div></div>";
        return $html;
    }

    public static function appendErrors($key, $inputAttrs, $errors) {
        if(array_key_exists($key, $errors)) {
            if(array_key_exists('class', $inputAttrs)) {
                $inputAttrs['class'] .= ' is-invalid';
            } else {
                $inputAttrs['class'] = 'is-invalid';
            }
        }
        return $inputAttrs;
    }

    public static function processAttrs($attrs) {
        $html = "";
        foreach($attrs as $key => $value) {
            $html .= " {$key}='{$value}'";
        }
        return $html;
    }

    public static function csrfField(){
        $token = Session::createCsrfToken();
        $html = "<input type='hidden' value='{$token}' name='csrfToken' />";
        return $html;
    }
}