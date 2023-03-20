<?php

class m230320_130420_popups_insert extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->insert('popups',array(
			'id_popups' => 1,
            'title' => 'Тестовое окно 1',
            'content' =>'Содержание тестового окна 1',
            'animation' => 'unfolding',
            'show' => 1,
            'allow_count' => 1
        ));
        $this->insert('popups',array(
			'id_popups' => 2,
            'title' => 'Тестовое окно 2',
            'content' =>'Содержание тестового окна 2',
            'animation' => 'meepmeep',
            'show' => 0,
            'allow_count' => 0
        ));
        $this->insert('popups',array(
			'id_popups' => 3,
            'title' => 'Тестовое окно 3',
            'content' =>'Содержание тестового окна 3',
            'animation' => 'blowup',
            'show' => 0,
            'allow_count' => 0
        ));
        $this->insert('popups',array(
			'id_popups' => 4,
            'title' => 'Тестовое окно 4',
            'content' =>'Содержание тестового окна 4',
            'animation' => 'uncovering',
            'show' => 0,
            'allow_count' => 1
        ));
    }

    public function safeDown()
    {
        $this->delete('popups', 'id_popups IN (1,2,3,4)');
    }
}