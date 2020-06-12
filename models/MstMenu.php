<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mst_menu}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $parent
 * @property int|null $order
 * @property string|null $icon
 * @property string|null $route
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 */
class MstMenu extends \yii\db\ActiveRecord
{
    use \app\helpers\AuditTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mst_menu}}';
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if (empty($this->parent)){
            $this->parent = '#';
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'parent', 'icon', 'route'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent' => Yii::t('app', 'Parent'),
            'order' => Yii::t('app', 'Order'),
            'icon' => Yii::t('app', 'Icon'),
            'route' => Yii::t('app', 'Route'),
            'created_at' => Yii::t('app', 'Dibuat Pada'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Diubah Pada'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getLabelIcon()
    {
        return sprintf('<i class="%s"></i>',$this->icon);
    }

    public function getParentMenu()
    {
        return $this->hasOne(MstMenu::class,['id'=>'parent'])
            ->from('mst_menu menu_parent');
    }

   
}
