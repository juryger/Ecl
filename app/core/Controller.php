<?php

require_once('../app/Console.php');

/**
 * Controller base class.
 */
class Controller
{
    /**
     * Create model instance by its class name
     * @param string $modelName <p>
     * Name of Model
     * </p>
     * @return object instance of requested Model
     */
    public function CreateModel($modelName)
    {
        ECL\WebDiagnostics\Console::Log('Creating model with name: '.$modelName);

        require_once '../app/models/'.$modelName.'.php';

        return new $modelName;
    }

    /**
     * Create view instance by its class name
     * @param string $viewName <p>
     * Name of View
     * </p>
     * @return object instance of requested View
     */
    public function CreateView($viewName, $data = [])
    {
        ECL\WebDiagnostics\Console::Log('Creating view with name: '.$viewName);

        require_once '../app/views/'.$viewName.'.php';
    }
}
?>