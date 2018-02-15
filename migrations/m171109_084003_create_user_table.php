<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m171109_084003_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(20),
            'password' => $this->string(100),
            'auth_key' => $this->string(100)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
