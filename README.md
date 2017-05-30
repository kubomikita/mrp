# MRP
[![Build Status](https://travis-ci.org/pavolbiely/mrp.svg?branch=master)](https://travis-ci.org/pavolbiely/mrp)
[![Coverage Status](https://coveralls.io/repos/github/pavolbiely/mrp/badge.svg?branch=master)](https://coveralls.io/github/pavolbiely/mrp?branch=master)

MRP invoices XML export.

## Usage

Use composer to install this package.

```php
$invoice = new Mrp\Invoice();
$invoice->addRow(['idfak' => 1, 'cislo' => '1201700001', 'ico' => '12345678', ...]);

$invoiceItem = new Mrp\InvoiceItem();
$invoiceItem->addRow(['idr' => 1, 'idfak' => 1, 'cenamj' => 50, ...]);
$invoiceItem->addRow(['idr' => 2, 'idfak' => 1, 'cenamj' => 200, ...]);

$address = new Mrp\Address();
$address->addRow(['idradr' => 1, 'firma' => 'Company', 'ico' => '11112222', ...]);

$zip = new ZipArchive();
if ($zip->open('export.zip', ZipArchive::CREATE) === true) {
	$zip->addFromString('mrp/FAKVY.XML', $invoice->getXml());
	$zip->addFromString('mrp/FAKVYPOL.XML', $invoiceItem->getXml());
	$zip->addFromString('mrp/ADRES.XML', $address->getXml());
	$zip->close();
}
```

You can find input fields for `addRow()` method on [MRP website](http://faq.mrp.cz/faqcz/obrazky/jkimage/MRPKS_FAKTURY_IMPORT_5_53_001.TXT). Please use all array keys as lowercase. 

## How to run tests?
Tests are build with [Nette Tester](https://tester.nette.org/). You can run it like this:
```bash
tester.bat -c php.ini-win --coverage coverage.html --coverage-src ../src
```

## Minimum requirements
- PHP 5.4+
- ext-zip
- ext-mbstring

## License
MIT License (c) Pavol Biely

Read the provided LICENSE file for details.
