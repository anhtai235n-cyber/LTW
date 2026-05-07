<?php

class CsrfToken {
    const TOKEN_NAME = '_csrf_token';
    const TOKEN_TTL = 3600; // 1 hour

    /**
     * Generate a new CSRF token
     */
    public static function generate() {
        if (empty($_SESSION[self::TOKEN_NAME])) {
            $_SESSION[self::TOKEN_NAME] = bin2hex(random_bytes(32));
            $_SESSION[self::TOKEN_NAME . '_time'] = time();
        }
        return $_SESSION[self::TOKEN_NAME];
    }

    /**
     * Get current CSRF token
     */
    public static function getToken() {
        return $_SESSION[self::TOKEN_NAME] ?? null;
    }

    /**
     * Verify CSRF token
     */
    public static function verify($token) {
        if (empty($_SESSION[self::TOKEN_NAME])) {
            return false;
        }

        // Check token value
        if ($token !== $_SESSION[self::TOKEN_NAME]) {
            return false;
        }

        // Check token expiration
        $tokenTime = $_SESSION[self::TOKEN_NAME . '_time'] ?? 0;
        if (time() - $tokenTime > self::TOKEN_TTL) {
            self::destroy();
            return false;
        }

        return true;
    }

    /**
     * Verify POST request CSRF token
     */
    public static function verifyPost() {
        $token = $_POST[self::TOKEN_NAME] ?? null;
        return self::verify($token);
    }

    /**
     * Destroy CSRF token
     */
    public static function destroy() {
        unset($_SESSION[self::TOKEN_NAME]);
        unset($_SESSION[self::TOKEN_NAME . '_time']);
    }

    /**
     * Get token input field HTML
     */
    public static function field() {
        $token = self::generate();
        return sprintf(
            '<input type="hidden" name="%s" value="%s">',
            self::TOKEN_NAME,
            htmlspecialchars($token, ENT_QUOTES, 'UTF-8')
        );
    }
}
?>
