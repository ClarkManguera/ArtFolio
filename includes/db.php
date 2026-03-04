<?php
// includes/db.php

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=localhost;dbname=artfolio_db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            die('<div style="padding:2rem;font-family:monospace;background:#1a0000;color:#ff6b6b;">
                <strong>Database Connection Failed:</strong><br>' . htmlspecialchars($e->getMessage()) . '
                </div>');
        }
    }
    return $pdo;
}
?>