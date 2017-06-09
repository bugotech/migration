<?php namespace Bugotech\Migration;

use Bugotech\Migration\Console\StatusCommand;
use Bugotech\Migration\Console\MigrateCommand;

class MigrationServiceProvider extends \Illuminate\Database\MigrationServiceProvider
{
    /**
     * Register all of the migration commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        //$commands = ['Migrate', 'Rollback', 'Reset', 'Refresh', 'Install', 'Make', 'Status'];
        $commands = ['Migrate', 'Status'];

        // We'll simply spin through the list of commands that are migration related
        // and register each one of them with an application container. They will
        // be resolved in the Artisan start file and registered on the console.
        foreach ($commands as $command) {
            $this->{'register' . $command . 'Command'}();
        }

        // Once the commands are registered in the application IoC container we will
        // register them with the Artisan start event so that these are available
        // when the Artisan application actually starts up and is getting used.
        $this->commands(
            'command.migrate', /*'command.migrate.make',
            'command.migrate.install', 'command.migrate.rollback',
            'command.migrate.reset', 'command.migrate.refresh', */
            'command.migrate.status'
        );
    }

    /**
     * Register the "migrate" migration command.
     *
     * @return void
     */
    protected function registerMigrateCommand()
    {
        $this->app->singleton('command.migrate', function ($app) {
            return new MigrateCommand($app['migrator']);
        });
    }

    /**
     * Register the "status" migration command.
     *
     * @return void
     */
    protected function registerStatusCommand()
    {
        $this->app->singleton('command.migrate.status', function ($app) {
            return new StatusCommand($app['migrator']);
        });
    }
}
