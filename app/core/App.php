<?php
/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 17/08/2016
 * Time: 6:50 AM
 */

// diagnostic
require_once('../app/Console.php');

/**
 * Main class for processing client commands.
 */
class App
{
    // default values for first visit of the website
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = ['intro'];

    /**
     *  Class constructor
     */
    public function App()
    {
        ECL\WebDiagnostics\Console::Log('BASE_URL: '.BASE_URL);
        ECL\WebDiagnostics\Console::Log('DB_STAGE: '.DB_STAGE);

        // parse command and its parameters (URL representation)
        $urlParams = $this->parseUrlPath();
        $urlText = ''.implode(',', $urlParams);
        ECL\WebDiagnostics\Console::Log('Request url: '.$urlText);

        // Getting controller name
        if (isset($urlParams[0])) {
            if (file_exists('../app/controllers/' . $urlParams[0] . '.php')) {
                $this->controller = $urlParams[0];
                unset($urlParams[0]);
            } else {
                $error = "There is no such controller with name: " . $urlParams[0];
                ECL\WebDiagnostics\Console::Error($error);
                throw new ErrorException($error);
            }
        }

        // Getting controller method name to call
        require_once '../app/controllers/'.$this->controller.'.php';
        $ctrInstance = new $this->controller;

        if (isset($urlParams[1])) {
            if (method_exists($ctrInstance, $urlParams[1])) {
                $this->method = $urlParams[1];
                unset($urlParams[1]);
            } else {
                $error = "There is no such method of controller: " . $urlParams[1];
                ECL\WebDiagnostics\Console::Error($error);
                throw new Exception($error);
            }
        }

        if (isset($urlParams[2])) {
            // Getting controller method parameters
            $this->params = $urlParams ? array_values($urlParams) : [];
            $paramsText = ''.implode(',', $urlParams);

            ECL\WebDiagnostics\Console::Log('controller method params: '.$paramsText);
        }

        // Call controller's method and pass parameters
        call_user_func_array([$ctrInstance, $this->method], $this->params);
    }

    /**
     * Parse requested URL, find original path and returns array of values separated by delimiter.
     * @return array If value of original request path is an empty string,
     * will return empty array.
     * For any other limit, an array containing
     * separate values of compound path will be returned.
     */
    protected function parseUrlPath()
    {
        return isset($_GET['path']) ?
            explode('/', filter_var(rtrim($_GET['path'], '/'), FILTER_SANITIZE_URL)) :
            [];
    }
}