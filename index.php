<?php
require __DIR__ . '/vendor/autoload.php';
include('MockBatchAPI.php');
include('BinarySearch.php');

$mockAPI = new MockBatchAPI();
$search =  new BinarySearch();
// generate a batch
//
$batch = $mockAPI->generateBatch(100, [9, 66, 87]);

// search for failures
//
$search->findFailuresInBatch($batch);
dd($search);











?>