<?php namespace Bugotech\Migration\Schema;

trait MigrationCommands
{
    /**
     * Criar tabela.
     * @param string $tableName
     */
    public function createTable($tableName)
    {
        $this->create($tableName, function(Table $table) {
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

    public function createFieldString($tableName, $nome, $len)
    {
        $this->table($tableName, function(Table $table) use($nome, $len) {
            $table->string($nome, $len);
        });
    }
}