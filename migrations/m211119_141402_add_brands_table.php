<?php

use yii\db\Migration;

/**
 * Class m211119_141402_add_brands_table
 */
class m211119_141402_add_brands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%brands}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(156)->notNull(),
        ]);

        $this->batchInsert('{{%brands}}', ['name'],  [
            ['name' => 'Tesla'],
            ['name' => 'BMW'],
            ['name' => 'Ferrari'],
            ['name' => 'Ford'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%brands}}');
    }
}
