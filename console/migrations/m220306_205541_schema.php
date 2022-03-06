<?php

use yii\db\Migration;

/**
 * Class m220306_205541_schema
 */
class m220306_205541_schema extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->execute("
        
        CREATE TABLE `vehicle` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `driver_name` VARCHAR(128) NOT NULL , 
            `driver_phone` VARCHAR(32) NOT NULL , 
            `driver_document_number` VARCHAR(64) NOT NULL , 
            `brand_model` VARCHAR(64) NOT NULL , 
            `plate_number` VARCHAR(32) NOT NULL , 
            `capacity` INT NOT NULL , 
            `im_available` TINYINT(1) NOT NULL DEFAULT '1' , 
            `current_trip_id` INT NULL , 
            `current_location` INT NULL , 
            `created_at` INT NULL , 
            `updated_at` INT NULL , 
            PRIMARY KEY (`id`), 
            INDEX (`im_available`), 
            INDEX (`current_trip_id`)) 
        ENGINE = InnoDB;
        
        ALTER TABLE `vehicle` 
            CHANGE `current_location` `current_location` VARCHAR(128) NULL DEFAULT NULL;

        CREATE TABLE `house` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `host_name` VARCHAR(128) NOT NULL , 
            `host_phone` VARCHAR(32) NOT NULL , 
            `host_document_number` VARCHAR(64) NOT NULL , 
            `address` VARCHAR(128) NOT NULL , 
            `city` VARCHAR(128) NOT NULL , 
            `postal_code` VARCHAR(32) NOT NULL , 
            `capacity` INT NOT NULL , 
            `rooms` INT NOT NULL , 
            `availability_date` DATE NULL , 
            `created_at` INT NULL , 
            `updated_at` INT NULL , 
            PRIMARY KEY (`id`)) 
        ENGINE = InnoDB;
        
        ALTER TABLE `house` ADD `user_id` INT NULL AFTER `id`, ADD INDEX (`user_id`);
        ALTER TABLE `vehicle` ADD `user_id` INT NULL AFTER `id`, ADD INDEX (`user_id`);
        
        ALTER TABLE `vehicle` 
            ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;
        ALTER TABLE `house` 
            ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;

        CREATE TABLE `refugee` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `name` VARCHAR(128) NOT NULL , 
            `phone` VARCHAR(32) NOT NULL , 
            `document_number` VARCHAR(64) NOT NULL , 
            `age` TINYINT(1) NOT NULL , 
            `gender` TINYINT(1) NOT NULL , 
            `pickup_location` VARCHAR(128) NOT NULL , 
            `destination_location` VARCHAR(128) NOT NULL , 
            `special_needs` TEXT NULL , 
            `created_at` INT NULL , 
            `updated_at` INT NULL , 
            PRIMARY KEY (`id`)) 
        ENGINE = InnoDB;
        

        CREATE TABLE `house_guest` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `house_id` INT NOT NULL , 
            `refugee_id` INT NOT NULL , 
            `created_at` INT NULL , 
            `updated_at` INT NULL , 
            PRIMARY KEY (`id`), 
            INDEX (`house_id`), 
            INDEX (`refugee_id`)) 
        ENGINE = InnoDB;
        

        ALTER TABLE `house_guest` 
            ADD FOREIGN KEY (`house_id`) REFERENCES `house`(`id`) 
                ON DELETE CASCADE ON UPDATE NO ACTION; 
        ALTER TABLE `house_guest` 
            ADD FOREIGN KEY (`refugee_id`) REFERENCES `refugee`(`id`) 
                ON DELETE CASCADE ON UPDATE NO ACTION;
                
        CREATE TABLE `trip` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `coordinator_id` INT NOT NULL , 
            `leaving_from` VARCHAR(128) NOT NULL , 
            `current_location` VARCHAR(128) NULL , 
            `pickup_arrival_date` DATE NULL , 
            `destination_arrival_date` DATE NULL , 
            `created_at` INT NULL , 
            `updated_at` INT NULL , 
            PRIMARY KEY (`id`), 
            INDEX (`coordinator_id`)) 
        ENGINE = InnoDB;
        
        ALTER TABLE `trip` 
            CHANGE `coordinator_id` `coordinator_id` INT(11) NULL;
        
        CREATE TABLE `trip_passenger` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `trip_id` INT NOT NULL , 
            `refugee_id` INT NOT NULL , 
            `created_at` INT NULL , 
            `updated_at` INT NULL , 
            PRIMARY KEY (`id`), 
            INDEX (`trip_id`), 
            INDEX (`refugee_id`)) 
        ENGINE = InnoDB;

        ALTER TABLE `trip_passenger` 
            ADD FOREIGN KEY (`trip_id`) REFERENCES `trip`(`id`) 
                ON DELETE CASCADE ON UPDATE NO ACTION; 
        ALTER TABLE `trip_passenger` 
            ADD FOREIGN KEY (`refugee_id`) REFERENCES `refugee`(`id`) 
                ON DELETE CASCADE ON UPDATE NO ACTION;

        ALTER TABLE `trip` 
            ADD FOREIGN KEY (`coordinator_id`) REFERENCES `user`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;
                
        ALTER TABLE `vehicle` 
            ADD FOREIGN KEY (`current_trip_id`) REFERENCES `trip`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;

        ALTER TABLE `user` ADD `lang` VARCHAR(5) NULL DEFAULT NULL AFTER `verification_token`;
        ALTER TABLE `house` ADD `lang` VARCHAR(5) NULL AFTER `availability_date`;
        ALTER TABLE `refugee` ADD `lang` VARCHAR(5) NULL AFTER `special_needs`;
        ALTER TABLE `vehicle` ADD `lang` VARCHAR(5) NULL AFTER `current_location`;
        

        CREATE TABLE `source_message`
        (
           `id`          integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
           `category`    varchar(255),
           `message`     text
        );

        CREATE TABLE `message`
        (
           `id`          integer NOT NULL,
           `language`    varchar(16) NOT NULL,
           `translation` text
        );

        ALTER TABLE `message` ADD CONSTRAINT `pk_message_id_language` PRIMARY KEY (`id`, `language`);
        ALTER TABLE `message` ADD CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON UPDATE RESTRICT ON DELETE CASCADE;

        CREATE INDEX idx_message_language ON message (language);
        CREATE INDEX idx_source_message_category ON source_message (category);

        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220306_205541_schema cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220306_205541_schema cannot be reverted.\n";

        return false;
    }
    */
}
