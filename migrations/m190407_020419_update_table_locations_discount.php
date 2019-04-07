<?php

use yii\db\Migration;

/**
 * Class m190407_020419_update_table_locations_discount
 */
class m190407_020419_update_table_locations_discount extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('locations', 'discount', $this->integer())   ;

        $this->createIndex(
            'idx-post-discount' ,
            'locations' ,
            'discount'
        );

        $this->addForeignKey(
            'fk-post-discount' ,
            'locations' ,
            'discount' ,
            'discounts' ,
            'id' ,
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190407_020419_update_table_locations_discount cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190407_020419_update_table_locations_discount cannot be reverted.\n";

        return false;
    }
    */
}
