<?php

use yii\db\Migration;

/**
 * Class m210203_032332_ForeignKeyMigrate
 */
class m210203_032332_ForeignKeyMigrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-company_created_by',
            'company',
            'created_by',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-log_user',
            'logs',
            'user',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210203_032332_ForeignKeyMigrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_032332_ForeignKeyMigrate cannot be reverted.\n";

        return false;
    }
    */
}
