<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 18/08/2016
 * Time: 12:20 PM
 */

require_once('../app/Console.php');
require_once('../app/core/Controller.php');

/**
 * Controller for processing Carving basis page commands
 */
class Article extends Controller
{
    /** Methods parameters use
     * <controller>/<method>/[params:/section/action/action_param]
     * /

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
        ECL\WebDiagnostics\Console::Log('article/index(name='.$section.', action='.$action.', actionParam='.$actionParam.')');

        ECL\WebDiagnostics\Console::Log('Creating model for section: '.$section);
        $sectionInfo = $this->CreateModel('SectionInfo');
        $sectionInfo->id = $section;
        $sectionInfo->title = isset($data['title']) ? $data['title'] : $section;

        // navigate to selected of page
        ECL\WebDiagnostics\Console::Log('Creating view for section: ' . $sectionInfo->title);
        $this->CreateView('article/index', ['sectionInfo' => $sectionInfo, 'action' => $action, 'actionParam' => $actionParam]);
    }
}