<?php

use yii\db\Migration;

class m171020_204247_init extends Migration
{
    const TABLE_NAME = '{{%queue_manager}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'sender' => $this->string(),
            'ttr' => $this->integer(),
            'delay' => $this->integer(),
            'priority' => $this->integer(),
            'status' => $this->integer(),
            'class' => $this->string(),
            'properties' => $this->text(),
            'data' => $this->text(),
            'result_id' => $this->integer(),
            'result' => $this->text(),
            'created_at' => $this->bigInteger(),
            'updated_at' => $this->bigInteger(),
            'start_execute' => $this->bigInteger(),
            'end_execute' => $this->bigInteger(),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171020_204247_init cannot be reverted.\n";

        return false;
    }
    */
}
