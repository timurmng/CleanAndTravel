<?php

use yii\db\Migration;

/**
 * Class m190406_121812_table_badges_users
 */
class m190406_121812_table_badges_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%badgesUsers}}', [
            'id' => $this->primaryKey(),
            'idUser' => $this->integer()->notNull(),
            'idBadges' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-post-idUserBadges' ,
            'badgesUsers' ,
            'idUser'
        );

        $this->addForeignKey(
            'fk-post-idUserBadges' ,
            'badgesUsers' ,
            'idUser' ,
            'users' ,
            'id' ,
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-idBadges' ,
            'badgesUsers' ,
            'idBadges'
        );

        $this->addForeignKey(
            'fk-post-idBadges' ,
            'badgesUsers' ,
            'idBadges' ,
            'badges' ,
            'id' ,
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%badgesUsers}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_121812_table_badges_users cannot be reverted.\n";

        return false;
    }
    */
}
