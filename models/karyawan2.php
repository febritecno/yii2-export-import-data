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
class karyawan2 extends \yii\db\ActiveRecord
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
            [['status'], 'integer'],
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
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'telpon' => 'Telpon',
            'status' => 'Status',
        ];
    }
}
