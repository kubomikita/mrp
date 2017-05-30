<?php

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$mrp = new \Mrp\InvoiceItem();
$mrp->addRow([
	'idr' => 'AAAAAAAAAAAAAAAAAAA',
	'idfak' => 'AAAAAAAAAAAAAAAAAAA',
	'typ_radku' => 'AAAAAAAAAAAAAAAAAAA',
	'typ_sum' => 'AAAAAAAAAAAAAAAAAAA',
	'text' => 'AAAAAAAAAAAAAAAAAAA',
	'datumod' => '1990-05-26',
	'datumdo' => '1990-05-26',
	'mj' => 'AAAAAAAAAAAAAAAAAAA',
	'cenamj' => 'AAAAAAAAAAAAAAAAAAA',
	'slevamj' => 'AAAAAAAAAAAAAAAAAAA',
	'dph' => 'AAAAAAAAAAAAAAAAAAA',
	'sadzbadph' => 'AAAAAAAAAAAAAAAAAAA',
	'zlava' => 'AAAAAAAAAAAAAAAAAAA',
	'riadok' => 'AAAAAAAAAAAAAAAAAAA',
	'stredisko' => 'AAAAAAAAAAAAAAAAAAA',
	'cislo_zak' => 'AAAAAAAAAAAAAAAAAAA',
	'typ_pol' => 'AAAAAAAAAAAAAAAAAAA',
	'hmotnost' => 'AAAAAAAAAAAAAAAAAAA',
]);

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idr' => '1', 'idfak' => '2']);
}, 'Mrp\InvoiceItemException', "Missing field 'cenamj'");

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idr' => '1', 'idfak' => '2', 'cenamj' => '3', 'unknown' => 'unknown']);
}, 'Mrp\InvoiceItemException', "Unknown field 'unknown'");

Assert::matchFile(__DIR__ . '/InvoiceItem.getXml().expected', $mrp->getXml());
