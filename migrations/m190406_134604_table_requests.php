<?php

use yii\db\Migration;

/**
 * Class m190406_134604_table_requests
 */
class m190406_134604_table_requests extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%requests}}', [
            'id' => $this->primaryKey(),
            'idUser' => $this->integer()->notNull(),
            'locationId' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-post-idUser' ,
            'requests' ,
            'idUser'
        );

        $this->addForeignKey(
            'fk-post-idUserRequests' ,
            'requests' ,
            'idUser' ,
            'users' ,
            'id' ,
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-locationId' ,
            'requests' ,
            'locationId'
        );

        $this->addForeignKey(
            'fk-post-locationIdRequests' ,
            'requests' ,
            'locationId' ,
            'locations' ,
            'id' ,
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190406_134604_table_requests cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_134604_table_requests cannot be reverted.\n";

        return false;
    }
    */
}
