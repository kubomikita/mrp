<?php

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$mrp = new \Mrp\Invoice();
$mrp->addRow([
	'idfak' => '1',
	'druh' => 'F',
	'cislo' => '2017100001',
	'varsymb' => '2017100001',
	'ico' => '45580090',
	'typdph' => 41,
	'rezim_dph' => 0,
	'stat_dph' => 'SK',
	'vatnumber' => 'SK12345678',
	'kh_leasing' => 'F',
	'zakl0' => '1500', // price without VAT
	'zakl1' => 'AAAAAAAAAAAAAAAAAAA',
	'zakl2' => 'AAAAAAAAAAAAAAAAAAA',
	'mimodph' => 'AAAAAAAAAAAAAAAAAAA',
	'dph1' => 'AAAAAAAAAAAAAAAAAAA',
	'dph2' => 'AAAAAAAAAAAAAAAAAAA',
	'zaplaccislo' => 'AAAAAAAAAAAAAAAAAAA',
	'cislododli' => '2017100001',
	'storno_fa' => 'AAAAAAAAAAAAAAAAAAA',
	'storno_pro' => 'AAAAAAAAAAAAAAAAAAA',
	'dobropis_pro' => 'AAAAAAAAAAAAAAAAAAA',
	'vrubopis_pro' => 'AAAAAAAAAAAAAAAAAAA',
	'cis_predf' => 'AAAAAAAAAAAAAAAAAAA',
	'datvystave' => '1990-05-26',
	'datzdanpln' => '1990-05-26',
	'datsplatno' => '1990-05-26',
	'datdodani' => '1990-05-26',
	'konstsymb' => '0008',
	'specisymb' => 'AAAAAAAAAAAAAAAAAAA',
	'stredisko' => 'AAAAAAAAAAAAAAAAAAA',
	'formauhrad' => 'prevodom',
	'sposobdopr' => 'kurier',
	'cisloobjed' => '2017200059',
	'datobjed' => '1990-05-26',
	'prikazuhr' => 'AAAAAAAAAAAAAAAAAAA',
	'mena' => 'EUR',
	'kurz_zahr' => '1',
	'kurz_sk' => '1',
	'kurz_eur' => '1',
	'kurz_eur_p' => '1',
	'platkar' => 'AAAAAAAAAAAAAAAAAAA',
	'cisplatkar' => 'AAAAAAAAAAAAAAAAAAA',
	'typ_dokl' => 'AAAAAAAAAAAAAAAAAAA',
	'origcislo' => 'AAAAAAAAAAAAAAAAAAA',
	'cislo_zak' => 'AAAAAAAAAAAAAAAAAAA',
	'celk_zahr' => 'AAAAAAAAAAAAAAAAAAA',
	'icoprij' => 'AAAAAAAAAAAAAAAAAAA',
	'cenysdph' => 'F',
	'zlava' => 'AAAAAAAAAAAAAAAAAAA',
	'skonto' => 'AAAAAAAAAAAAAAAAAAA',
	'skontoproc' => 'AAAAAAAAAAAAAAAAAAA',
	'skontodny' => 'AAAAAAAAAAAAAAAAAAA',
	'kodplneni' => 'AAAAAAAAAAAAAAAAAAA',
	'hmotnost' => '10',
	'typ_pol' => 'AAAAAAAAAAAAAAAAAAA',
	'pdsyntet' => 'AAAAAAAAAAAAAAAAAAA',
	'pdanalyt' => 'AAAAAAAAAAAAAAAAAAA',
	'poznamka' => 'Put your note here',
	'spotrdand' => 'AAAAAAAAAAAAAAAAAAA',
	'ekodand' => 'AAAAAAAAAAAAAAAAAAA',
	'ekokom' => 'AAAAAAAAAAAAAAAAAAA',
	'usrfld1' => 'AAAAAAAAAAAAAAAAAAA',
	'usrfld2' => 'AAAAAAAAAAAAAAAAAAA',
	'usrfld3' => 'AAAAAAAAAAAAAAAAAAA',
	'usrfld4' => 'AAAAAAAAAAAAAAAAAAA',
	'usrfld5' => 'AAAAAAAAAAAAAAAAAAA',
]);

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idfak' => '1', 'cislo' => '2']);
}, 'Mrp\InvoiceException', "Missing field 'ico'");

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idfak' => '1', 'cislo' => '2', 'ico' => '3', 'unknown' => 'unknown']);
}, 'Mrp\InvoiceException', "Unknown field 'unknown'");

Assert::matchFile(__DIR__ . '/Invoice.getXml().expected', $mrp->getXml());
