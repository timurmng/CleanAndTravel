<?php

use yii\db\Migration;

/**
 * Class m190406_213511_table_photos
 */
class m190406_213511_table_photos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey(),
            'locationId' => $this->integer()->notNull(),
            'photoPath' => $this->string()->notNull(),
            'type' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-post-locationId' ,
            'photos' ,
            'locationId'
        );

        $this->addForeignKey(
            'fk-post-locationIdPhoto' ,
            'photos' ,
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
        echo "m190406_213511_table_photos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_213511_table_photos cannot be reverted.\n";

        return false;
    }
    */
}
