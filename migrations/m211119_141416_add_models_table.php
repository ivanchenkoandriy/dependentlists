<?php

use yii\db\Migration;

/**
 * Class m211119_141416_add_models_table
 */
class m211119_141416_add_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%models}}', [
            'id' => $this->primaryKey()->unsigned(),
            'brand_id' => $this->integer()->unsigned(),
            'name' => $this->string(156)->notNull(),
        ]);

        $this->addForeignKey('models_brand_id_fk', '{{%models}}', 'brand_id', '{{%brands}}', 'id', 'cascade', 'cascade');

        $this->batchInsert('{{%models}}', ['name', 'brand_id'], [
            ['name' => 'X1', 'brand_id' => 1],
            ['name' => 'X2', 'brand_id' => 1],
            ['name' => 'X3', 'brand_id' => 2],
            ['name' => 'B4', 'brand_id' => 2],
            ['name' => 'X5', 'brand_id' => 3],
            ['name' => 'M6', 'brand_id' => 3],
            ['name' => 'X7', 'brand_id' => 3],
            ['name' => 'D8', 'brand_id' => 4],
            ['name' => 'X9', 'brand_id' => 4],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('models_brand_id_fk', '{{%models}}');
        $this->dropTable('{{%models}}');
    }
}
