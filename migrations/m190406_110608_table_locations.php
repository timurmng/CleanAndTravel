<?php

use yii\db\Migration;

/**
 * Class m190406_110608_table_locations
 */
class m190406_110608_table_locations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'idUser' => $this->integer()->notNull(),
            'locationName' => $this->string(60)->notNull(),
            'latitude' => $this->decimal(9,6)->notNull(),
            'longitude' => $this->decimal(9,6)->notNull(),
            'details' => $this->string()->notNull()
        ]);

        $this->createIndex(
            'idx-post-idUser' ,
            'locations' ,
            'idUser'
        );

        $this->addForeignKey(
          'fk-post-idUser' ,
          'locations' ,
          'idUser' ,
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
        $this->dropTable('{{%locations}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_110608_table_locations cannot be reverted.\n";

        return false;
    }
    */
}
