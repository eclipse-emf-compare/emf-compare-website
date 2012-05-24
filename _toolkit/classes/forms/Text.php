<?php

class Text extends Field
{
	private $size;
	private $maxlen;

	function __construct($name, $label = NULL, $defaultValue = NULL)
	{
		parent::__construct($name, $label, $defaultValue);
	}

	function getSize()
	{
		return $this->size;
	}

	function setSize($size)
	{
		$this->size = $size;
		return $this;
	}

	function getMaxLen()
	{
		return $this->maxlen;
	}

	function setMaxLen($maxlen)
	{
		$this->maxlen = $maxlen;
		if (!isset($this->size))
		{
			$this->size = ($maxlen > 100 ? 100 : $maxlen);
		}

		return $this;
	}

	function validate($value)
	{
		if ($value == "Eike")
		{
			return "'Eike' is not allowed";
		}
			
		return parent::validate($value);
	}

	function renderValue()
	{
		print '<input type="text" value="' . $this->getValue() . '" name="' . $this->getName() . '" size="/' . $this->getSize() . '"';
		$this->renderHandlers();
		print '/>';
	}
}

?>
