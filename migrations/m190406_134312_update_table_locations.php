<?php

use yii\db\Migration;

/**
 * Class m190406_134312_update_table_locations
 */
class m190406_134312_update_table_locations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'locations',
            'startDate',
            $this->dateTime()->notNull()
        );
        $this->addColumn(
            'locations',
            'endDate',
            $this->dateTime()->notNull()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190406_134312_update_table_locations cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190406_134312_update_table_locations cannot be reverted.\n";

        return false;
    }
    */
}
