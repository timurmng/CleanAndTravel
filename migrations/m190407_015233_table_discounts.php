<?php

use yii\db\Migration;

/**
 * Class m190407_015233_table_discounts
 */
class m190407_015233_table_discounts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%discounts}}', [
            'id' => $this->primaryKey(),
            'idCompany' => $this->integer()->notNull(),
            'discount' => $this->string()->notNull()
        ]);

        $this->createIndex(
            'idx-post-idCompany' ,
            'discounts' ,
            'idCompany'
        );

        $this->addForeignKey(
            'fk-post-idCompany' ,
            'discounts' ,
            'idCompany' ,
            'users' ,
            'id' ,
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190407_015233_table_discounts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190407_015233_table_discounts cannot be reverted.\n";

        return false;
    }
    */
}
