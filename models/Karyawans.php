<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "karyawan".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $telpon
 * @property integer $status
 */
class Karyawans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'karyawan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telpon'], 'number'],
            [['status'], 'required'],
            [['nama', 'alamat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama Karyawan',
            'alamat' => 'Alamat Rumah',
            'telpon' => 'Telpon',
            'status' => 'Status',
        ];
    }
}
