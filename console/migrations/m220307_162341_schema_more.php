<?php

use yii\db\Migration;

/**
 * Class m220307_162341_schema_more
 */
class m220307_162341_schema_more extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            
        ALTER TABLE `refugee` 
            ADD `assigned_house_id` INT NULL AFTER `lang`, 
            ADD `assigned_trip_id` INT NULL AFTER `assigned_house_id`, 
            ADD INDEX (`assigned_house_id`), 
            ADD INDEX (`assigned_trip_id`); 
            
        ALTER TABLE `refugee` 
            ADD FOREIGN KEY (`assigned_house_id`) REFERENCES `house`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION; 
        ALTER TABLE `refugee` 
            ADD FOREIGN KEY (`assigned_trip_id`) REFERENCES `trip`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;
                
        ALTER TABLE `trip` 
            ADD `vehicle_id` INT NULL AFTER `leaving_from`, ADD INDEX (`vehicle_id`);
            
        ALTER TABLE `trip` 
            ADD FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;




        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220307_162341_schema_more cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220307_162341_schema_more cannot be reverted.\n";

        return false;
    }
    */
}
