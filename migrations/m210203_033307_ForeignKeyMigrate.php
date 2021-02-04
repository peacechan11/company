<?php

use yii\db\Migration;

/**
 * Class m210203_033307_ForeignKeyMigrate
 */
class m210203_033307_ForeignKeyMigrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-company_category',
            'company_category',
            'company',
            'company',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210203_033307_ForeignKeyMigrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_033307_ForeignKeyMigrate cannot be reverted.\n";

        return false;
    }
    */
}
