<?php

namespace Mrp;

class InvoiceItem extends Xml
{
	/**
	 * @param array
	 * @return \DOMNode
	 */
	public function addRow(array $data): \DOMNode
	{
		foreach (['idr', 'idfak', 'cenamj'] as $key) {
			if (!isset($data[$key])) {
				throw new InvoiceItemException("Missing field '$key'");
			}
		}

		foreach ($data as $key => $value) {
			switch ($key) {
				case 'idr':
				case 'idfak':
				case 'typ_radku':
				case 'typ_sum':
				case 'riadok':
					$data[$key] = (int)$value;
					break;
				case 'sadzbadph':
				case 'zlava':
				case 'cislokar':
					$data[$key] = round((float)str_replace([' ', ','], ['', '.'], (string)$value), 2);
					break;
				case 'pocetmj':
				case 'cenamj':
				case 'slevamj':
				case 'dph':
				case 'hmotnost':
					$data[$key] = round((float)str_replace([' ', ','], ['', '.'], (string)$value), 6);
					break;
				case 'text':
					$data[$key] = $this->truncate($value, 100);
					break;
				case 'mj':
					$data[$key] = $this->truncate($value, 3);
					break;
				case 'stredisko':
					$data[$key] = $this->truncate($value, 6);
					break;
				case 'cislo_zak':
					$data[$key] = $this->truncate($value, 15);
					break;
				case 'typ_pol':
					$data[$key] = $this->truncate($value, 2);
					break;
				case 'datumod':
				case 'datumdo':
					$data[$key] = preg_match('~^([0-9]{4})-[0-9]{2}-[0-9]{2}$~', $value) ? $value : NULL;
					break;
				default:
					throw new InvoiceItemException("Unknown field '$key'");
			}
		}

		return parent::addRow($data);
	}
}



class InvoiceItemException extends XmlException
{
}
