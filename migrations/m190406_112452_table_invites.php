<?php

use yii\db\Migration;

/**
 * Class m190406_112452_table_invites
 */
class m190406_112452_table_invites extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invites}}', [
            'id' => $this->primaryKey(),
            'idSender' => $this->integer()->notNull(),
            'idReceiver' => $this->integer()->notNull(),
            'location' => $this->integer()->notNull()
        ]);

        $this->createIndex(
          'inx-post-idSender',
          'invites',
          'idSender'
        );

        $this->addForeignKey(
          'fk-post-idSender',
          'invites',
          'idSender',
          'users',
          'id',
          'CASCADE'
        );

        $this->createIndex(
            'inx-post-idReceiver',
            'invites',
            'idReceiver'
        );

        $this->addForeignKey(
            'fk-post-idReceiver',
            'invites',
            'idReceiver',
            'users',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'inx-post-location',
            'invites',
            'location'
        );

        $this->addForeignKey(
            'fk-post-location',
            'invites',
            'location',
            'locations',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190406_112452_table_invites cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_112452_table_invites cannot be reverted.\n";

        return false;
    }
    */
}
