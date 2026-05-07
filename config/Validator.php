<?php

class Validator {
    private static $errors = [];

    /**
     * Validate email format
     */
    public static function email($email, $fieldName = 'Email') {
        if (empty($email)) {
            self::addError("$fieldName không được để trống");
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::addError("$fieldName không hợp lệ");
            return false;
        }
        return true;
    }

    /**
     * Validate username (alphanumeric, 3-20 characters)
     */
    public static function username($username, $fieldName = 'Tên tài khoản') {
        if (empty($username)) {
            self::addError("$fieldName không được để trống");
            return false;
        }
        if (strlen($username) < 3 || strlen($username) > 20) {
            self::addError("$fieldName phải từ 3-20 ký tự");
            return false;
        }
        if (!preg_match('/^[a-zA-Z0-9_.-]+$/', $username)) {
            self::addError("$fieldName chỉ được chứa chữ, số, dấu gạch dưới, dấu chấm");
            return false;
        }
        return true;
    }

    /**
     * Validate password (minimum 8 characters)
     */
    public static function password($password, $fieldName = 'Mật khẩu') {
        if (empty($password)) {
            self::addError("$fieldName không được để trống");
            return false;
        }
        if (strlen($password) < 8) {
            self::addError("$fieldName phải có ít nhất 8 ký tự");
            return false;
        }
        return true;
    }

    /**
     * Validate password confirmation match
     */
    public static function passwordMatch($password, $confirmPassword, $fieldName = 'Mật khẩu') {
        if ($password !== $confirmPassword) {
            self::addError("$fieldName xác nhận không khớp");
            return false;
        }
        return true;
    }

    /**
     * Validate required field
     */
    public static function required($value, $fieldName = 'Trường') {
        if (empty(trim($value))) {
            self::addError("$fieldName không được để trống");
            return false;
        }
        return true;
    }

    /**
     * Validate minimum length
     */
    public static function minLength($value, $min, $fieldName = 'Trường') {
        if (strlen($value) < $min) {
            self::addError("$fieldName phải có ít nhất $min ký tự");
            return false;
        }
        return true;
    }

    /**
     * Validate maximum length
     */
    public static function maxLength($value, $max, $fieldName = 'Trường') {
        if (strlen($value) > $max) {
            self::addError("$fieldName không được vượt quá $max ký tự");
            return false;
        }
        return true;
    }

    /**
     * Validate phone number format
     */
    public static function phone($phone, $fieldName = 'Số điện thoại') {
        if (empty($phone)) {
            return true; // Optional field
        }
        if (!preg_match('/^[0-9]{10,11}$/', preg_replace('/[^0-9]/', '', $phone))) {
            self::addError("$fieldName không hợp lệ");
            return false;
        }
        return true;
    }

    /**
     * Validate URL format
     */
    public static function url($url, $fieldName = 'URL') {
        if (empty($url)) {
            return true; // Optional field
        }
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            self::addError("$fieldName không hợp lệ");
            return false;
        }
        return true;
    }

    /**
     * Validate number range
     */
    public static function between($value, $min, $max, $fieldName = 'Giá trị') {
        if ($value < $min || $value > $max) {
            self::addError("$fieldName phải nằm trong khoảng $min - $max");
            return false;
        }
        return true;
    }

    /**
     * Validate integer
     */
    public static function integer($value, $fieldName = 'Giá trị') {
        if (!is_numeric($value) || !ctype_digit((string)$value)) {
            self::addError("$fieldName phải là số nguyên");
            return false;
        }
        return true;
    }

    /**
     * Validate file upload
     */
    public static function file($file, $maxSize = 5242880, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
        if (empty($file) || $file['error'] == UPLOAD_ERR_NO_FILE) {
            return true; // Optional field
        }

        if ($file['error'] != UPLOAD_ERR_OK) {
            self::addError("Lỗi tải lên file");
            return false;
        }

        if ($file['size'] > $maxSize) {
            self::addError("File không được vượt quá " . round($maxSize / 1024 / 1024) . "MB");
            return false;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes)) {
            self::addError("Định dạng file không được hỗ trợ");
            return false;
        }

        return true;
    }

    /**
     * Add validation error
     */
    public static function addError($message) {
        self::$errors[] = $message;
    }

    /**
     * Get all validation errors
     */
    public static function getErrors() {
        return self::$errors;
    }

    /**
     * Check if validation passed
     */
    public static function passes() {
        return empty(self::$errors);
    }

    /**
     * Check if validation failed
     */
    public static function fails() {
        return !empty(self::$errors);
    }

    /**
     * Reset validation errors
     */
    public static function reset() {
        self::$errors = [];
    }

    /**
     * Sanitize string input
     */
    public static function sanitize($value) {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize array input
     */
    public static function sanitizeArray($array) {
        $sanitized = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $sanitized[$key] = self::sanitizeArray($value);
            } else {
                $sanitized[$key] = self::sanitize($value);
            }
        }
        return $sanitized;
    }
}
?>
