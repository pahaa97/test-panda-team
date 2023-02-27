<?php

namespace App\Controllers;

class Controller {
    protected function renderView($viewName, $data = []) {
        extract($data);
        return require __DIR__ . '/../Views/settings/' . $viewName . '.php';
    }
}
