<?php namespace Bugotech\Migration\Schema;

use Illuminate\Support\Str;

trait MigrationCommands
{
    /**
     * Criar tabela.
     * @param string $tableName
     */
    public function createTable($tableName)
    {
        $this->create($tableName, function (Table $table) {
            $table->key();
        });
    }

    /**
     * Excluir tabela.
     * @param $tableName
     */
    public function dropTable($tableName)
    {
        $this->drop($tableName);
    }

    /**
     * Excluir campo.
     * @param $tableName
     * @param $fieldName
     */
    public function dropField($tableName, $fieldName)
    {
        $this->table($tableName, function (Table $table) use ($fieldName) {
            $table->dropColumn($fieldName);
        });
    }

    /**
     * @param $name
     * @param $arguments
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (Str::is('createField*', $name)) {
            $name = strtolower(str_replace('createField', '', $name));
            $tableName = $arguments[0];
            array_shift($arguments);

            $table = $this->getTable($tableName);
            $col = call_user_func_array([$table, $name], $arguments);

            return new FieldFluent($table, $col);
        }

        throw new \Exception(sprintf('Method "%s" not found in the class "%s"', $name, get_class($this)));
    }
}