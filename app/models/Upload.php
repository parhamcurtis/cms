<?php 
namespace App\Models;
use Core\H;

class Upload {
    public $file, $field, $errors = [];
    public $size, $tmp, $ext;
    public $maxSize = 2000000;
    public $allowedFileTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
    public $required = true;

    public function __construct($field) {
        $this->field = $field;
        $this->checkInitialError();
        $this->file = $_FILES[$field];
        $this->size = $this->file['size'];
        $this->tmp = $this->file['tmp_name'];
        $this->ext = pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }

    public function validate() {
        $this->errors = [];
        if(empty($this->tmp) && $this->required) {
            $this->errors[$this->field] =  "File is required";
        }
        //check size 
        if(!empty($this->tmp) && $this->size > $this->maxSize) {
            $this->errors[$this->field] = "Exceeded file size limit of " . $this->formatBytes($this->maxSize);
        }

        //check if allowed type
        if(!empty($this->tmp) && empty($this->errors)) {
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $type = $finfo->file($this->tmp);
            if(array_search($type, $this->allowedFileTypes) === false) {
                $this->errors[$this->field] = "Not an allowed file type. Must be " . implode(', ', array_keys($this->allowedFileTypes));
            }
        }
        
        return $this->errors;
    }

    public function upload($fileName) {
        $test = move_uploaded_file($this->tmp, $fileName);
        return $test;
    }

    public function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes, $precision) . $units[$pow];
    }

    private function checkInitialError() {
        if(!isset($_FILES[$this->field]) || is_array($_FILES[$this->field]['error'])) {
            throw new \RuntimeException("Something is wrong with the file.");
        }
    }
}