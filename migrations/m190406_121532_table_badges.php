<?php

use yii\db\Migration;

/**
 * Class m190406_121532_table_badges
 */
class m190406_121532_table_badges extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%badges}}', [
            'id' => $this->primaryKey(),
            'badgesName' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%badges}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_121532_table_badges cannot be reverted.\n";

        return false;
    }
    */
}
