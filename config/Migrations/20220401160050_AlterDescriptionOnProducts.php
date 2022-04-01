<?php
use Migrations\AbstractMigration;

class AlterDescriptionOnProducts extends AbstractMigration
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
        $table = $this->table('products');
        $table->changeColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
