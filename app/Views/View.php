<?php

namespace App\Views;

class View {
    public function render($template, $data = []) {
        extract($data);
        include 'Views/' . $template . '.php';
    }
}
