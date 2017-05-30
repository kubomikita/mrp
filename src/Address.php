<?php

namespace Mrp;

class Address extends Xml
{
	/**
	 * @param array
	 * @return \DOMNode
	 */
	public function addRow(array $data)
	{
		foreach (['idradr', 'firma', 'ico'] as $key) {
			if (!isset($data[$key])) {
				throw new AddressException("Missing field '$key'");
			}
		}

		foreach ($data as $key => $value) {
			switch ($key) {
				case 'idradr':
				case 'splatnost':
				case 'na_platno':
				case 'skontodny':
				case 'typpovol':
					$data[$key] = (int)$value;
					break;
				case 'skontoproc':
				case 'faksleva':
					$data[$key] = round((float)str_replace([' ', ','], ['', '.'], (string)$value), 2);
					break;
				case 'firma':
				case 'firma2':
					$data[$key] = $this->truncate($value, 50);
					break;
				case 'ico':
					$data[$key] = $this->truncate($value, 12);
					break;
				case 'meno':
				case 'ulica':
				case 'mesto':
				case 'stat':
				case 'ine':
				case 'telefon':
				case 'telefon2':
				case 'telefon3':
				case 'fax':
					$data[$key] = $this->truncate($value, 30);
					break;
				case 'psc':
					$data[$key] = $this->truncate($value, 15);
					break;
				case 'cisob':
				case 'cisorp':
					$data[$key] = $this->truncate($value, 6);
					break;
				case 'dic':
					$data[$key] = $this->truncate($value, 17);
					break;
				case 'email':
				case 'objemail':
				case 'fakemail':
					$data[$key] = $this->truncate($value, 256);
					break;
				case 'poznamka':
					$data[$key] = $this->truncate($value, 255);
					break;
				case 'fyzosob':
				case 'velobch':
					$data[$key] = $value && $value != 'F' ? 'T' : 'F';
					break;
				case 'id':
				case 'formauhrad':
				case 'sposobdopr':
				case 'varsymbfv':
				case 'varsymbfp':
				case 'specsymbfv':
				case 'specsymbfp':
					$data[$key] = $this->truncate($value, 10);
					break;
				case 'datnaroz':
					$data[$key] = preg_match('~^([0-9]{4})-[0-9]{2}-[0-9]{2}$~', $value) ? $value : NULL;
					break;
				case 'dan_urad':
					$data[$key] = $this->truncate($value, 5);
					break;
				case 'icoprij':
					$data[$key] = $this->truncate($value, 12);
					break;
				case 'eankod':
					$data[$key] = $this->truncate($value, 18);
					break;
				case 'eansys':
					$data[$key] = $this->truncate($value, 17);
					break;
				case 'cispovol':
					$data[$key] = $this->truncate($value, 13);
					break;
				case 'kodstat':
					$data[$key] = $this->truncate($value, 2);
					break;
				case 'ic_dph':
					$data[$key] = $this->truncate($value, 14);
					break;
				case 'usrfld1':
				case 'usrfld2':
				case 'usrfld3':
				case 'usrfld4':
				case 'usrfld5':
					$data[$key] = $this->truncate($value, 40);
					break;
				default:
					throw new AddressException("Unknown field '$key'");
			}
		}

		return parent::addRow($data);
	}
}



class AddressException extends XmlException
{
}
