<?php

use yii\db\Migration;

/**
 * Handles the creation of table `data`.
 */
class m200610_114821_create_data_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('data', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'data' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('data');
    }
}
