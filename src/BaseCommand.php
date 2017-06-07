<?php namespace Bugotech\Migration;

trait BaseCommand
{
    /**
     * Get the path to the migration directory.
     *
     * @return string
     */
    protected function getMigrationPath()
    {
        return $this->laravel->path('migrations');
    }
}