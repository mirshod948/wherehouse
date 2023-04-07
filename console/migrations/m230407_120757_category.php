<?php

use yii\db\Migration;

/**
 * Class m230407_120757_category
 */
class m230407_120757_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'description' => 'LONGTEXT',
            'name' => $this->string(2000),
            'keywords' => $this->string(2000),
        ]);

        $this->createIndex(
            '{{%idx-category-parent_id}}',
            '{{%category}}',
            'parent_id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230407_120757_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230407_120757_category cannot be reverted.\n";

        return false;
    }
    */
}
