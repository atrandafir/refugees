<?php

use yii\db\Migration;

/**
 * Class m220307_184530_schema_more
 */
class m220307_184530_schema_more extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->execute("
            ALTER TABLE `trip` 
                ADD `pickup_location` VARCHAR(128) NULL AFTER `current_location`, 
                    ADD `destination_location` VARCHAR(128) NULL AFTER `pickup_location`;
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220307_184530_schema_more cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220307_184530_schema_more cannot be reverted.\n";

        return false;
    }
    */
}
