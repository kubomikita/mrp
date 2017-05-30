<?php

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$mrp = new \Mrp\BankAccount();
$mrp->addRow([
	'idr' => '1',
    'idradr' => '1',
    'banka' => 'AAAAAAAAAAAAAAAAAAA',
    'pobocka' => 'AAAAAAAAAAAAAAAAAAA',
    'ucet' => 'AAAAAAAAAAAAAAAAAAA',
    'kodbanky' => 'AAAAAAAAAAAAAAAAAAA',
    'charkod' => 'AAAAAAAAAAAAAAAAAAA',
    'mena' => 'AAAAAAAAAAAAAAAAAAA',
    'specisymb' => 'AAAAAAAAAAAAAAAAAAA',
    'swiftcode' => 'AAAAAAAAAAAAAAAAAAA',
    'adresa2' => 'AAAAAAAAAAAAAAAAAAA',
	'adresa3' => 'AAAAAAAAAAAAAAAAAAA',
	'adresa4' => 'AAAAAAAAAAAAAAAAAAA',
    'iban' => 'AAAAAAAAAAAAAAAAAAA',
]);

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idr' => '1']);
}, 'Mrp\BankAccountException', "Missing field 'idradr'");

Assert::exception(function () use ($mrp) {
	$mrp->addRow(['idr' => '1', 'idradr' => '2', 'unknown' => 'unknown']);
}, 'Mrp\BankAccountException', "Unknown field 'unknown'");

Assert::matchFile(__DIR__ . '/BankAccount.getXml().expected', $mrp->getXml());
