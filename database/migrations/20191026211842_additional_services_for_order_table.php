<?php

use Phinx\Migration\AbstractMigration;

class AdditionalServicesForOrderTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('additional_services_for_orders');
        $table->addColumn('order_id', 'integer', ['limit' => 11])
            ->addColumn('additional_service_id', 'integer', ['limit' => 11])
//            ->addForeignKey(['additional_service_id'],
//                'additional_services',
//                ['id'],
//                ['delete' => 'RESTRICT', 'update' => 'CASCADE', 'constraint' => 'fk_additional_services_for_orders_to_additional_services'])
//            ->addForeignKey(['order_id'],
//                'orders',
//                ['id'],
//                ['delete' => 'RESTRICT', 'update' => 'CASCADE', 'constraint' => 'fk_additional_services_for_orders_to_orders'])
            ->create();

    }

    public function down()
    {
        $table = $this->table('additional_services_for_orders');
        $table->dropForeignKey('fk_additional_services_for_orders_to_additional_services')->save();
        $table->drop('additional_services_for_orders')->save();
    }
}
