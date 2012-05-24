<?php

class Button extends Field
{
	function __construct($name, $label = NULL)
	{
		parent::__construct($name, $label);
	}

	function load()
	{
		parent::load();
		return $this->getName() == "submit" && $this->getValue() != NULL;
	}

	function renderLabel()
	{
		// Do nothing
	}

	function renderValue()
	{
		print '<input type="submit" value="' . $this->getLabel() . '" name="' . $this->getName() . '"';
		$this->renderHandlers();
		print '/>';
	}
}

?>
