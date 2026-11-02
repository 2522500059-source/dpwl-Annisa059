
<?php
class Controller
{
    public function __construct()
    {
        $this->session = new Session();

        $this->load = new class {

            public function view($viewName, $data = [])
            {
                if (!empty($data)) {
                    extract($data);
                }

                $file = dirname(__DIR__) . '/view/' . $viewName . '.php';

                if (!file_exists($file)) {
                    die("File view tidak ditemukan: " . $file);
                }

                include $file;
            }

            public function model($modelName)
            {
                $modelFile = dirname(__DIR__) . '/model/' . $modelName . '.php';

                if (!file_exists($modelFile)) {
                    die("File model tidak ditemukan: " . $modelFile);
                }

                require_once $modelFile;

                $namaModel = basename($modelName);

                if (!class_exists($namaModel)) {
                    die("Class model tidak ditemukan: " . $namaModel);
                }

                return new $namaModel();
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
