<?php

namespace Mrp;

class Invoice extends Xml
{
	public function addRow(array $data): \DOMNode
	{
		foreach (['idfak', 'cislo', 'ico'] as $key) {
			if (!isset($data[$key])) {
				throw new InvoiceException("Missing field '$key'");
			}
		}

		foreach ($data as $key => $value) {
			switch ($key) {
				case 'idfak':
				case 'typdph':
				case 'rezim_dph':
				case 'prikazuhr':
				case 'platkar':
				case 'skontodny':
				case 'pdsyntet':
				case 'pdanalyt':
				case 'spotrdand':
				case 'ekodand':
				case 'ekokom':
					$data[$key] = (int)$value;
					break;
				case 'zakl0':
				case 'zakl1':
				case 'zakl2':
				case 'mimodph':
				case 'dph1':
				case 'dph2':
				case 'celk_zahr':
				case 'zlava':
				case 'skonto':
				case 'skontoproc':
					$data[$key] = round((float)str_replace([' ', ','], ['', '.'], (string)$value), 2);
					break;
				case 'kurz_zahr':
				case 'kurz_sk':
				case 'kurz_eur':
				case 'kurz_eur_p':
				case 'hmotnost':
					$data[$key] = round((float)str_replace([' ', ','], ['', '.'], (string)$value), 6);
					break;
				case 'druh':
				case 'kh_leasing':
					$data[$key] = $this->truncate($value, 1);
					break;
				case 'cislo':
				case 'varsymb':
				case 'zaplaccislo':
				case 'cislododli':
				case 'storno_fa':
				case 'storno_pro':
				case 'dobropis_pro':
				case 'vrubopis_pro':
				case 'cis_predf':
				case 'specisymb':
				case 'formauhrad':
				case 'sposobdopr':
					$data[$key] = $this->truncate($value, 10);
					break;
				case 'konstsymb':
					$data[$key] = $this->truncate($value, 8);
					break;
				case 'stredisko':
					$data[$key] = $this->truncate($value, 6);
					break;
				case 'origcisdok':
				case 'origcis2':
				case 'origcislo':
					$data[$key] = $this->truncate($value, 50);
					break;
				case 'mena':
					$data[$key] = $this->truncate($value, 3);
					break;
				case 'cenysdph':
				case 'kodplneni':
					$data[$key] = $this->truncate($value, 1);
					break;
				case 'stat_dph':
				case 'typ_dokl':
				case 'typ_pol':
					$data[$key] = $this->truncate($value, 2);
					break;
				case 'ico':
				case 'icoprij':
					$data[$key] = $this->truncate($value, 12);
					break;
				case 'cislo_zak':
					$data[$key] = $this->truncate($value, 15);
					break;
				case 'vatnumber':
					$data[$key] = $this->truncate($value, 17);
					break;
				case 'cisloobjed':
				case 'cisplatkar':
					$data[$key] = $this->truncate($value, 20);
					break;
				case 'poznamka':
					$data[$key] = $this->truncate($value, 255);
					break;
				case 'datvystave':
				case 'datzdanpln':
				case 'datsplatno':
				case 'datdodani':
				case 'datobjed':
					$data[$key] = preg_match('~^([0-9]{4})-[0-9]{2}-[0-9]{2}$~', $value) ? $value : NULL;
					break;
				case 'usrfld1':
				case 'usrfld2':
				case 'usrfld3':
				case 'usrfld4':
				case 'usrfld5':
					$data[$key] = $this->truncate($value, 40);
					break;
				default:
					throw new InvoiceException("Unknown field '$key'");
			}
		}

		return parent::addRow($data);
	}
}


class InvoiceException extends XmlException
{
}
