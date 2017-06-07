<?php namespace Bugotech\Migration;

class Migrator extends \Illuminate\Database\Migrations\Migrator
{
    public function resolve($file)
    {
        //$file = implode('_', array_slice(explode('_', $file), 4));

        //$class = Str::studly($file);
        $class = $file;

        return new $class;
    }
}