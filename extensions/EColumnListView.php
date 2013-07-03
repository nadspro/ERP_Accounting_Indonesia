<?php

/**
 * EColumnListView class file.
 *
 * @author Tasos Bekos <tbekos@gmail.com>
 * @copyright Copyright &copy; 2012 Tasos Bekos
 */
/**
 * EColumnListView represents a list view in multiple columns.
 *
 * @author Tasos Bekos <tbekos@gmail.com>
 */
Yii::import('zii.widgets.CListView');

class EColumnListView extends CListView {

	/**
	 *
	 * @var mixed integer the number of columns
	 */
	public $span = 2;
	public $columns=2;

	/**
	 * Renders the item view.
	 * This is the main entry of the whole view rendering.
	 *
	 * This is override function that supports multiple span
	 */
	public function renderItems() {
		$numSpan = (int) $this->span; // Number of span

		if ($numSpan < 2) {
			parent::renderItems();
			return;
		}

		echo CHtml::openTag($this->itemsTagName, array('class' => $this->itemsCssClass)) . "\n";
		$data = $this->dataProvider->getData();

		$counter = 1;

		if (($n = count($data)) > 0) {

			$owner = $this->getOwner();
			$render = $owner instanceof CController ? 'renderPartial' : 'render';
			//$j = 0;
			foreach ($data as $i => $item) {

				if ($counter ==1) 
					echo CHtml::openTag('div',array('class'=>'row'));

				// Open cell
				echo CHtml::openTag('div', array('class' => 'span'.$numSpan));

				$data = $this->viewData;
				$data['index'] = $i;
				$data['data'] = $item;
				$data['widget'] = $this;
				$owner->$render($this->itemView, $data);

				// Close cell
				echo CHtml::closeTag('div');

				// Change row
				//if (($i + 1) % $numSpan == 0) {
				//	echo CHtml::closeTag('tr') . CHtml::openTag('tr');
				//}
				$counter++;
				if ($counter == $this->columns+1)
					echo CHtml::closeTag('div');

				if ($counter == $this->columns+1)
					$counter=1;
			}
			
		} else {
			$this->renderEmptyText();
		}
		echo CHtml::closeTag($this->itemsTagName);
	}

}
