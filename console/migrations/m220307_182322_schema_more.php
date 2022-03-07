<?php

use yii\db\Migration;

/**
 * Class m220307_182322_schema_more
 */
class m220307_182322_schema_more extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `refugee` 
            ADD `user_id` INT NULL AFTER `id`, 
                ADD INDEX (`user_id`);
        ALTER TABLE `refugee` 
            ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) 
                ON DELETE SET NULL ON UPDATE NO ACTION;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220307_182322_schema_more cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220307_182322_schema_more cannot be reverted.\n";

        return false;
    }
    */
}
