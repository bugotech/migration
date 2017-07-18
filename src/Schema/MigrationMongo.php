<?php namespace Bugotech\Migration\Schema;

class MigrationMongo extends \Illuminate\Database\Migrations\Migration
{
    /**
     * Nome da conexão.
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @param $tableName
     * @param string $extend
     */
    public function createTable($tableName, $extend = '')
    {
        schema($this->getConnection())->create($tableName, function () {
            //..
        });
    }

    /**
     * @param $table
     */
    public function dropTable($table)
    {
        schema($this->getConnection())->dropIfExists($table);
    }

    /**
     * Executar seed.
     *
     * @param $class
     */
    protected function seed($class)
    {
        \Artisan::call('db:seed', ['--class' => $class]);
    }

    /**
     * Executar migracao para atualizar versao.
     */
    public function up()
    {
        //...
    }

    /**
     * Executar migracao para desinstalar versao.
     */
    public function down()
    {
        //...
    }
}