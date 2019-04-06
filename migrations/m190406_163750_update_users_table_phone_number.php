<?php

use yii\db\Migration;

/**
 * Class m190406_163750_update_users_table_phone_number
 */
class m190406_163750_update_users_table_phone_number extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'phoneNumber', $this->string())   ;
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190406_163750_update_users_table_phone_number cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_163750_update_users_table_phone_number cannot be reverted.\n";

        return false;
    }
    */
}
