<?php
use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
     public function change()
    {
        // Adding this array is other way to create primary index ['id' => false, 'primary_key' => ['id']]
        $table = $this->table('products');
        $table->addColumn('productId', 'integer',[
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('sku', 'string',[
            'default' => null,
            'limit' => 60,
            'null' => true,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => true,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('inventory_quantity', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('price', 'float', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('status', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
