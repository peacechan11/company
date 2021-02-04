<?php

use yii\db\Migration;

/**
 * Class m210203_033126_ForeignKeyMigrate
 */
class m210203_033126_ForeignKeyMigrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-category_parent_id',
            'category',
            'parent_id',
            'category',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-company_category_category',
            'company_category',
            'category',
            'category',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210203_033126_ForeignKeyMigrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_033126_ForeignKeyMigrate cannot be reverted.\n";

        return false;
    }
    */
}
