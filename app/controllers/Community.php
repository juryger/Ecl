<?php

require_once('../app/Console.php');
require_once('../app/core/Controller.php');

/**
* Controller for processing Community page commands
*/
class Community extends Controller
{
    /** Methods parameters use
     * <controller>/<method>/[params:/section/action/action_param]
     */

    /**
    * Perform navigation on selected section at local navigation list of 'Carving basis' page
    * @param string $section <p>
    * Name of the section to navigate
    * </p>
    * @param string $action <p>
    * Action to be executed on section
    * </p>
    * @param string $actionParam <p>
    * Parameters of action to be executed on section
    * </p>
    * @param array $data <p>
    * Data for page to complete required navigation
    * </p>
    * @return void
    */
    public function Index($section = '', $action = '',  $actionParam = '', $data = [])
    {
        ECL\WebDiagnostics\Console::Log('community/index(name=' . $section . ', action=' . $action . ', actionParam=' . $actionParam . ')');

        // Create model
        ECL\WebDiagnostics\Console::Log('Creating model for section: ' . $section);
        $sectionInfo = $this->CreateModel('SectionInfo');
        $sectionInfo->id = $section;
        $sectionInfo->title = isset($data['title']) ? $data['title'] : $section;

        // Create view
        ECL\WebDiagnostics\Console::Log('Creating view for section: ' . $sectionInfo->title);
        $this->CreateView('community/index', ['sectionInfo' => $sectionInfo, 'action' => $action, 'actionParam' => $actionParam]);
    }
}