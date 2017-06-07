<?php namespace Bugotech\Migration\Schema;

use Illuminate\Support\Fluent;
use Bugotech\Migration\Schema\Table;

class FieldFluent extends Fluent
{
    /**
     * @var Table
     */
    protected $table;

    /**
     * @param Table $table
     * @param array $attributes
     */
    public function __construct(Table $table, $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = $table;
    }

    /**
     * Executar alterações.
     */
    public function compile()
    {
        $this->table->compile();
    }
}