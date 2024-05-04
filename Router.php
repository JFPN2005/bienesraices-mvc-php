<?php
namespace MVC;
    class Router {
        public $rutasGET = [];
        public $rutasPOST = [];
        public function get($url, $fn) {
            $this->rutasGET[$url] = $fn;
        }
        public function post($url, $fn) {
            $this->rutasPOST[$url] = $fn;
        }

        public function comprobarRutas() {

            session_start();
            
            $auth = $_SESSION['login'] ?? null;

            // Arreglo de rutas protegidas
            $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

            $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
            $metodo = $_SERVER['REQUEST_METHOD'];

            if($metodo === 'GET') {
                $fn = $this->rutasGET[$urlActual] ?? NULL;
            } else {
                $fn = $this->rutasPOST[$urlActual] ?? NULL;
            }

            // Proteger las rutas
            if(in_array($urlActual, $rutas_protegidas) && !$auth) {
                header('Location: /');
            }

            if($fn) {
                // La URL existe y hay una funcion asociada
                call_user_func($fn, $this);
            } else {
                echo "Pagina no encontrada";
            }
            
        }

        // Muestra una vista
        public function render($view, $datos = []) {
            foreach($datos as $key => $value) {
                $$key = $value;
            }
            // Almacenar em memoria
            ob_start();
            include __DIR__ . "/views/$view.php";

            // Lo limpiamos para que no se quede en memoria y el servidor no colapse
            $contenido = ob_get_clean();

            include __DIR__ . "/views/layout.php";
        }
    }