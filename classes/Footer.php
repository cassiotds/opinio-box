<?php

class Footer
{
    private static $instance;

    private function __construct()
    {
        // O construtor é privado para evitar a criação direta de instâncias
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function render()
    {
        include 'includes/footer.php';
    }
}