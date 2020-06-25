<?php

use Phinx\Migration\AbstractMigration;

class Url extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('url');
        $table->addColumn('hits', 'integer', ['default' => 0])
            ->addColumn('url', 'string')
            ->addColumn('shortUrl', 'string')
            ->addColumn('user', 'integer')
            ->addIndex(['user'])
            ->addForeignKey('user', 'user', 'id', ['constraint' => 'url_user_foreign_key'])
            ->create();
    }
}
