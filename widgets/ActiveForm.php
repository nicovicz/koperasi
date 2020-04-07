<?php
namespace app\widgets;

use yii\helpers\Html;
use yii\base\InvalidCallException;
use yii\widgets\ActiveForm as BaseActiveForm;

class ActiveForm extends BaseActiveForm
{
    public $options = [
        'class'=>'form-horizontal'
    ];

    public $fieldConfig =[
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-2'],
    ];
    
    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }

        $content = ob_get_clean();
        $wrapper = '<div class="panel panel-blur light-text with-scroll animated zoomIn"
        ><div class="panel-heading"><h3><i class="fa fa-sticky-note"></i> '.$this->getView()->title.'</h3>
        </div><div class="panel-body">';
        $html = $wrapper.Html::beginForm($this->action, $this->method, $this->options);
        $html .= $content;

        if ($this->enableClientScript) {
            $this->registerClientScript();
        }

        $html .= '<div>'.$this->getView()->render('@app/widgets/buttons').'</div>'.Html::endForm();
        return $html;
    }
}