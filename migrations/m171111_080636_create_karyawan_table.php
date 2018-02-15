<?php

use yii\db\Migration;

/**
 * Handles the creation of table `karyawan`.
 */
class m171111_080636_create_karyawan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('karyawan', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(20),
            'alamat' => $this->string(50),
            'telpon' => $this->integer(15),
            'status' => $this->integer(10)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('karyawan');
    }
}
