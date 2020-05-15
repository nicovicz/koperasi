<?php
namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Panel extends Widget
{
    public $title = '';
    public $icon = '';
	public $type  = self::TYPE_DEFAULT;
	public $header = true;

	CONST TYPE_DEFAULT = 'panel-default';
	CONST TYPE_SUCCESS = 'panel-success';
	CONST TYPE_WARNING = 'panel-warning';
	CONST TYPE_DANGER = 'panel-danger';
	

	public function init()
	{
		parent::init();
		ob_start();
	}

	public function run()
	{
		$start = '<div class="panel panel-blur light-text with-scroll animated zoomIn" >';
		if ($this->header){
			$start .= '<div class="panel-heading"><h3><i class="fa fa-'.$this->icon.'"></i> '.Html::encode($this->title).'</h3></div>';
		}
		$start .= '<div class="panel-body">';
		$ender = '</div></div>';
		$content = ob_get_clean();
		return $start.$content.$ender;

		
	}
}