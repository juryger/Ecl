<?php

/**
 * Created by PhpStorm.
 * User: juryger
 * Date: 17/08/2016
 * Time: 7:01 AM
 */

require_once('../app/Console.php');
require_once('../app/core/Controller.php');

/**
 * Controller for processing Home page commands
 */
class Home extends Controller
{
    /**
     * Perform navigation on selected section at local navigation list of Home page
     * @param string $section <p>
     * Name of the section to navigate
     * </p>
     * @param array $data <p>
     * Optional data for navigation
     * </p>
     * @return void
     */
    public function Index($section = '', $data = [])
    {
        ECL\WebDiagnostics\Console::Log('home/index(name='.$section.')');

        ECL\WebDiagnostics\Console::Log('Creating model for selected section: '.$section);
        $sectionInfo = $this->CreateModel('SectionInfo');
        $sectionInfo->id = $section;
        $sectionInfo->title = isset($data['title']) ? $data['title'] : $section;

        ECL\WebDiagnostics\Console::Log('Creating view for selected section: '.$sectionInfo->title);
        $this->CreateView('home/index', ['sectionInfo' => $sectionInfo]);
    }
}