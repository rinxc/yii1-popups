<?php

/**
 * This is the model class for table "popups".
 *
 * The followings are the available columns in table 'popups':
 * @property integer $id_users
 * @property string $title
 * @property string $content
 * @property integer $show
 * @property string $date_reg
 */
class Popups extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'popups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, animation', 'required'),
			array('show, count, allow_count', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('animation', 'in', 'range' => array_keys(Popups::getAnimation())),
			array('show', 'in', 'range' => array_keys(Popups::GetShow())),
			array('allow_count', 'in', 'range' => array_keys(Popups::GetAllowCount())),
			array('content, date_reg, animation, count', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('title, show, animation, count, allow_count', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_popups'		=> Yii::t('popups','ID'),
			'title'    		=> Yii::t('popups','Заголовок'),
			'content'  		=> Yii::t('popups','Содержание'),
			'show'     		=> Yii::t('popups','Отображение'),
			'animation'		=> Yii::t('popups','Анимация'),
			'allow_count'	=> Yii::t('popups','Считать показы'),
			'count'    		=> Yii::t('popups','Количество показов'),
			'date_reg'		=> Yii::t('popups','Дата добавления'),
		);
	}

    protected function beforeSave()
    {
        parent::beforeSave();
        
        $this->title = Yii::app()->format->html($this->title);
		$this->content = Yii::app()->format->html($this->content);

        return true;
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 'p';
		$criteria->compare('p.id', trim($this->title), true);
        $criteria->compare('p.title', trim($this->title), true);
        $criteria->compare('p.show', $this->show);
        $criteria->compare('p.animation', $this->animation);
		$criteria->compare('p.allow_count', $this->allow_count);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'p.date_reg DESC',
            ),
        ));

	}

    public function GetShow($id=null)
    {
        $arr = Array(
			0 =>  Yii::t('popups', 'Скрывать'),
            1 =>  Yii::t('popups', 'Показывать')
        );
        return ($id != null) ? $arr[$id] : $arr;
    }

    public function GetAllowCount($id=null)
    {
        $arr = Array(
            0 =>  Yii::t('popups', 'Запретить'),
            1 =>  Yii::t('popups', 'Разрешить')
        );
        return ($id != null) ? $arr[$id] : $arr;
    }


    public function GetAnimation($id=null)
    {
        $arr = Array(
			'blowup'     =>  Yii::t('popups', 'BlowUp'),
            'meepmeep'   =>  Yii::t('popups', 'MeepMeep'),
			'uncovering' =>  Yii::t('popups', 'Uncovering'),
			'unfolding'  =>  Yii::t('popups', 'Unfolding'),
        );
        return ($id != null) ? $arr[$id] : $arr;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Popups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
