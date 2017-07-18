<?php namespace Bugotech\Migration\Schema;

use Jenssegers\Mongodb\Schema\Blueprint;

class MigrationMongo extends \Illuminate\Database\Migrations\Migration
{
    use MigrationCommands;

    /**
     * @var \Illuminate\Database\Connection
     */
    protected $con;

    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $builder;

    /**
     * @var \Illuminate\Database\Schema\Grammars\Grammar
     */
    protected $grammar;

    /**
     * Preparar Migration.
     */
    public function __construct()
    {
        $this->con = db()->connection($this->getConnection());
        $this->builder = $this->con->getSchemaBuilder();
        $this->grammar = $this->con->getSchemaGrammar();
    }

    public function createTable($tableName, $extend = '')
    {
        $tb = new Blueprint($this->con, $tableName);
        $tb->create();
        $tb->build($this->con, $this->grammar);
    }

    public function dropTable($table)
    {
        $this->builder->dropIfExists($table);
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