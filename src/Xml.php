<?php

namespace Mrp;

abstract class Xml
{
	/** @var \DOMDocument */
	protected $document;

	/** @var \DOMNode */
	protected $rows;


	public function __construct()
	{
		$doc = $this->document = new \DOMDocument('1.0', 'windows-1250');
		$doc->formatOutput = true;

		$root = $doc->createElement('document');
		$root = $doc->appendChild($root);

		$datasets = $doc->createElement('datasets');
		$datasets = $root->appendChild($datasets);

		$dataset0 = $doc->createElement('dataset0');
		$dataset0 = $datasets->appendChild($dataset0);

		$rows = $doc->createElement('rows');
		$this->rows = $dataset0->appendChild($rows);
	}


	/**
	 * @param array
	 * @return \DOMNode
	 */
	public function addRow(array $data)
	{
		$row = $this->document->createElement('row');
		$row = $this->rows->appendChild($row);

		$fields = $this->document->createElement('fields');
		$fields = $row->appendChild($fields);

		foreach ($data as $key => $value) {
			$fields->appendChild($this->document->createElement((string) $key, (string) $value));
		}

		return $fields;
	}


	/**
	 * @return string
	 */
	public function getXml()
	{
		return $this->document->saveXml();
	}



	/**
	 * @param string
	 * @param int
	 * @return string
	 */
	protected function truncate($data, $length)
	{
		return mb_substr($data, 0, $length, 'UTF-8');
	}
}



class XmlException extends \Exception
{
}
