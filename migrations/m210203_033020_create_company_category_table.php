<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_category}}`.
 */
class m210203_033020_create_company_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_category}}', [
            'id' => $this->primaryKey(),
            'category'=>$this->integer(),
            'company'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_category}}');
    }
}
