<?php
class Controller
{
    public function __construct()
    {
        $this->session = new session();
        $this->load = new class {
            public function view($viewName, $data = [])
            {
                if (!empty($data)) extract($data);
                include './view/' . $viewName . '.php';
            }
            public function model($modelName)
            {
                require_once './model/' . $modelName . '.php';
                return new $modelName();
            }

            public function post($key = null)
            {
                if ($key === null) {
                    return $_POST;
                }
                return $_POST[$key] ?? null;
            }

            public function get($key = null)
            {
                if ($key === null) {
                    return $_GET;
                }
                return $_GET[$key] ?? null;
            }
        };
    }
}