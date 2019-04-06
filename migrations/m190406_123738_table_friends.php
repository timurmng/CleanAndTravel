<?php

use yii\db\Migration;

/**
 * Class m190406_123738_table_friends
 */
class m190406_123738_table_friends extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%friends}}', [
            'id' => $this->primaryKey(),
            'idUser1' => $this->integer()->notNull(),
            'idUser2' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-post-idUser1' ,
            'friends' ,
            'idUser1'
        );

        $this->addForeignKey(
            'fk-post-idUser1' ,
            'friends' ,
            'idUser1' ,
            'users' ,
            'id' ,
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-idUser2' ,
            'friends' ,
            'idUser2'
        );

        $this->addForeignKey(
            'fk-post-idUser2' ,
            'friends' ,
            'idUser2' ,
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
        $this->dropTable('{{%friends}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_123738_table_friends cannot be reverted.\n";

        return false;
    }
    */
}
