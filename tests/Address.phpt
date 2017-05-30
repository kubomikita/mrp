<?php

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$mrp = new \Mrp\Address();
$mrp->addRow([
    'idradr' => 'AAAAAAAAAAAAAAAAAAA',
    'firma' => 'AAAAAAAAAAAAAAAAAAA',
    'ico' => 'AAAAAAAAAAAAAAAAAAA',
    'meno' => 'AAAAAAAAAAAAAAAAAAA',
    'ulica' => 'AAAAAAAAAAAAAAAAAAA',
    'mesto' => 'AAAAAAAAAAAAAAAAAAA',
    'stat' => 'AAAAAAAAAAAAAAAAAAA',
    'ine' => 'AAAAAAAAAAAAAAAAAAA',
    'psc' => 'AAAAAAAAAAAAAAAAAAA',
    'cisob' => 'AAAAAAAAAAAAAAAAAAA',
    'cisorp' => 'AAAAAAAAAAAAAAAAAAA',
    'dic' => 'AAAAAAAAAAAAAAAAAAA',
    'telefon' => 'AAAAAAAAAAAAAAAAAAA',
    'telefon2' => 'AAAAAAAAAAAAAAAAAAA',
    'telefon3' => 'AAAAAAAAAAAAAAAAAAA',
    'fax' => 'AAAAAAAAAAAAAAAAAAA',
    'email' => 'AAAAAAAAAAAAAAAAAAA',
	'poznamka' => 'AAAAAAAAAAAAAAAAAAA',
    'fyzosob' => 'AAAAAAAAAAAAAAAAAAA',
    'firma2' => 'AAAAAAAAAAAAAAAAAAA',
    'id' => 'AAAAAAAAAAAAAAAAAAA',
    'datnaroz' => '1990-05-26',
    'dan_urad' => 'AAAAAAAAAAAAAAAAAAA',
    'splatnost' => 'AAAAAAAAAAAAAAAAAAA',
    'icoprij' => 'AAAAAAAAAAAAAAAAAAA',
    'eankod' => 'AAAAAAAAAAAAAAAAAAA',
    'eansys' => 'AAAAAAAAAAAAAAAAAAA',
    'formauhrad' => 'AAAAAAAAAAAAAAAAAAA',
    'sposobdopr' => 'AAAAAAAAAAAAAAAAAAA',
    'varsymbfv' => 'AAAAAAAAAAAAAAAAAAA',
    'varsymbfp' => 'AAAAAAAAAAAAAAAAAAA',
    'specsymbfv' => 'AAAAAAAAAAAAAAAAAAA',
    'specsymbfp' => 'AAAAAAAAAAAAAAAAAAA',
    'na_platno' => 'AAAAAAAAAAAAAAAAAAA',
    'objemail' => 'AAAAAAAAAAAAAAAAAAA',
    'fakemail' => 'AAAAAAAAAAAAAAAAAAA',
    'skontoproc' => 'AAAAAAAAAAAAAAAAAAA',
    'skontodny' => 'AAAAAAAAAAAAAAAAAAA',
    'faksleva' => 'AAAAAAAAAAAAAAAAAAA',
    'cispovol' => 'AAAAAAAAAAAAAAAAAAA',
    'typpovol' => 'AAAAAAAAAAAAAAAAAAA',
    'velobch' => 'AAAAAAAAAAAAAAAAAAA',
    'kodstat' => 'AAAAAAAAAAAAAAAAAAA',
    'ic_dph' => 'AAAAAAAAAAAAAAAAAAA',
    'usrfld1' => 'AAAAAAAAAAAAAAAAAAA',
    'usrfld2' => 'AAAAAAAAAAAAAAAAAAA',
    'usrfld3' => 'AAAAAAAAAAAAAAAAAAA',
    'usrfld4' => 'AAAAAAAAAAAAAAAAAAA',
    'usrfld5' => 'AAAAAAAAAAAAAAAAAAA',
]);

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idradr' => '1', 'firma' => '2']);
}, 'Mrp\AddressException', "Missing field 'ico'");

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idradr' => '1', 'firma' => '2', 'ico' => '3', 'unknown' => 'unknown']);
}, 'Mrp\AddressException', "Unknown field 'unknown'");

Assert::matchFile(__DIR__ . '/Address.getXml().expected', $mrp->getXml());
