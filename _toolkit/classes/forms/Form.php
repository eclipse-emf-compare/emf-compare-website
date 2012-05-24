<?php

class Form
{
	private $name;
	private $action;
	private $method;
	private $target;
	private $fields = array();
	private $fieldsByName = array();
	private $submitted = false;
	private $finished = false;

	function __construct($name = NULL, $action = NULL, $method = "POST")
	{
		$this->name = $name;
		$this->action = $action;
		$this->method = $method;
	}

	function getName()
	{
		return $this->name;
	}

	function getAction()
	{
		return $this->action;
	}

	function getMethod()
	{
		return $this->method;
	}

	function getTarget()
	{
		return $this->target;
	}

	function setTarget($target)
	{
		$this->target = $target;
		return $this;
	}

	function addField($field)
	{
		$field->setForm($this);
		$this->fields[count($this->fields)] = $field;
		$this->fieldsByName[$field->getName()] = $field;
		return $field;
	}

	function getFields()
	{
		return $this->fields;
	}

	function getField($name)
	{
		return $this->fieldsByName[$name];
	}

	function getValue($name)
	{
		return $this->getField($name)->getValue();
	}

	function getValues($skipButtons = true)
	{
		$result = array();
		foreach ($this->fields as $field)
		{
			if (!($skipButtons && $field instanceof Button))
			{
				$result[count($result)] = $field->getValue();
			}
		}

		return $result;
	}

	function getNames($skipButtons = true)
	{
		$result = array();
		foreach ($this->fields as $field)
		{
			if (!($skipButtons && $field instanceof Button))
			{
				$result[count($result)] = $field->getName();
			}
		}

		return $result;
	}

	function render()
	{
		foreach ($this->fields as $field)
		{
			if ($field->load())
			{
				$this->submitted = true;
			}
		}

		$name = $this->name == NULL ? "" : " name=\"$this->name\"";
		$action = $this->action == NULL ? "" : " action=\"$this->action\"";
		$method = $this->method == NULL ? "" : " method=\"$this->method\"";
		$target = $this->target == NULL ? "" : " target=\"$this->target\"";

		print "<form$name$action$method$target>\n";
		print "<table>\n";
		foreach ($this->fields as $field)
		{
			$this->renderField($field);
		}

		print "</table>\n";
		print "</form>\n";

		if ($this->submitted)
		{
			$this->finished = true;
			foreach ($this->fields as $field)
			{
				if ($field->getError() != NULL)
				{
					$this->finished = false;
				}
			}
		}
	}

	function isSubmitted()
	{
		return $this->submitted;
	}

	function isFinished()
	{
		return $this->finished && $this->isSubmitted();
	}

	protected function renderField(Field $field)
	{
		print "<tr>";
		$field->render();
		print "</tr>\n";
	}
}

?>
