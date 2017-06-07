<?php namespace Bugotech\Migration\Schema;

/**
 * Class Migration
 * @package Bugotech\Migration\Schema
 * @method createFieldString
 * @method createFieldInteger
 * @method createFieldNumber
 * @method createFieldBoolean
 * @method createFieldDateTime
 * @method createFieldDate
 * @method createFieldTime
 * @method createFieldText
 * @method createFieldAssociation
 */
class Migration extends \Illuminate\Database\Migrations\Migration
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

    public function create($table, \Closure $callback)
    {
        $tb = new Table($this->builder, $table);

        $tb->create();
        $tb->engine = 'InnoDB';

        $callback($tb);

        $tb->build($this->con, $this->grammar);
    }

    public function table($table, \Closure $callback)
    {
        $tb = new Table($this->builder, $table);

        $callback($tb);

        $tb->build($this->con, $this->grammar);
    }

    /**
     * Create e retorna um Table.
     * @param $table
     * @param bool $create
     * @return Table
     */
    protected function getTable($table, $create = false)
    {
        $tb = new Table($this->builder, $table);

        if ($create) {
            $tb->create();
            $tb->engine = 'InnoDB';
        }

        $tb->setToBuild($this->con, $this->grammar);

        return $tb;
    }

    public function drop($table)
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