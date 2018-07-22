<?php
/**
 * Created by PhpStorm.
 * User: danielschultz
 * Date: 7/22/18
 * Time: 10:22 AM
 */


class BinarySearch
{
    public $mockAPI;

    public $failures;

    public $successes;

    public function __construct()
    {
        $this->mockAPI = new MockBatchAPI();
        $this->failures = [];
        $this->successes = [];
    }

    public function findFailuresInBatch(array $batch)
    {
        $status = $this->mockAPI->processBatch($batch);
        if (count($batch) == 1 && $status == false) {
            $this->failures += $batch;
            return;
        }

        if ($status == true) {
            $this->successes += $batch;
            return;
        } else {
            $halfway = floor(count($batch) / 2);
            $firstHalf = array_slice($batch, 0, $halfway, true);
            $secondHalf = array_slice($batch, $halfway, count($batch), true);

            if (!empty($firstHalf)) {
                $this->findFailuresInBatch($firstHalf);
            }

            if (!empty($secondHalf)) {
                $this->findFailuresInBatch($secondHalf);
            }
        }
    }
}