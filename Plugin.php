<?php namespace LukeTowers\EEImport;

use Config;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'luketowers.eeimport::lang.plugin.name',
            'description' => 'luketowers.eeimport::lang.plugin.description',
            'author'      => 'Luke Towers',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Register the ExpressionEngine DB connections
        $connections = Config::get('luketowers.eeimport::connections', []);
        foreach ($connections as $connection => $settings) {
            Config::set("database.connections.$connection", $settings);
        }

        $this->registerConsoleCommand('expressionengine.import', 'LukeTowers\EEImport\Console\Import');
    }
}
