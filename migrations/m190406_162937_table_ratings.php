<?php

use yii\db\Migration;

/**
 * Class m190406_162937_table_ratings
 */
class m190406_162937_table_ratings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ratings}}', [
            'id' => $this->primaryKey(),
            'idUserRatings' => $this->integer()->notNull(),
            'locationIdRatings' => $this->integer()->notNull(),
            'rate' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-post-idUserRatings' ,
            'ratings' ,
            'idUserRatings'
        );

        $this->addForeignKey(
            'fk-post-idUserRatings' ,
            'ratings' ,
            'idUserRatings' ,
            'users' ,
            'id' ,
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-locationIdRatings' ,
            'ratings' ,
            'locationIdRatings'
        );

        $this->addForeignKey(
            'fk-post-locationIdRatings' ,
            'ratings' ,
            'locationIdRatings' ,
            'locations' ,
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ratings}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_162937_table_ratings cannot be reverted.\n";

        return false;
    }
    */
}
