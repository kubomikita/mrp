<?php

namespace Mrp;

class BankAccount extends Xml
{
	/**
	 * @param array
	 * @return \DOMNode
	 */
	public function addRow(array $data)
	{
		foreach (['idr', 'idradr'] as $key) {
			if (!isset($data[$key])) {
				throw new BankAccountException("Missing field '$key'");
			}
		}

		foreach ($data as $key => $value) {
			switch ($key) {
				case 'idr':
				case 'idradr':
					$data[$key] = (int)$value;
					break;
				case 'banka':
				case 'pobocka':
					$data[$key] = $this->truncate($value, 100);
					break;
				case 'ucet':
					$data[$key] = $this->truncate($value, 18);
					break;
				case 'charkod':
					$data[$key] = $this->truncate($value, 7);
					break;
				case 'mena':
					$data[$key] = $this->truncate($value, 3);
					break;
				case 'specisymb':
					$data[$key] = $this->truncate($value, 10);
					break;
				case 'kodbanky':
				case 'swiftcode':
					$data[$key] = $this->truncate($value, 12);
					break;
				case 'adresa2':
				case 'adresa3':
				case 'adresa4':
					$data[$key] = $this->truncate($value, 35);
					break;
				case 'iban':
					$data[$key] = $this->truncate($value, 34);
					break;
				default:
					throw new BankAccountException("Unknown field '$key'");
			}
		}

		return parent::addRow($data);
	}
}



class BankAccountException extends XmlException
{
}
