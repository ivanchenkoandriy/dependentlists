<?php

use yii\db\Migration;

/**
 * Class m211119_141629_add_cars_table
 */
class m211119_141629_add_cars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cars}}', [
            'id' => $this->primaryKey()->unsigned(),
            'brand_id' => $this->integer()->unsigned()->notNull(),
            'model_id' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->addForeignKey('cars_brand_id_idx', '{{%cars}}', 'brand_id', '{{%brands}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('cars_model_id_idx', '{{%cars}}', 'model_id', '{{%models}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('cars_brand_id_idx', '{{%cars}}');
        $this->dropForeignKey('cars_model_id_idx', '{{%cars}}');
        $this->dropTable('{{%cars}}');
    }
}
