<?php
/**
 * Created by PhpStorm.
 * User: danielschultz
 * Date: 7/22/18
 * Time: 10:22 AM
 */

/**
 * Class BinarySearch
 */
class BinarySearch
{
    /**
     * @var MockBatchAPI $mockAPI
     */
    public $mockAPI;

    /**
     * @var array $failures
     */
    public $failures;

    /**
     * @var array $successes
     */
    public $successes;

    /**
     * BinarySearch constructor.
     */
    public function __construct()
    {
        $this->mockAPI = new MockBatchAPI();
        $this->failures = [];
        $this->successes = [];
    }

    /**
     * @param array $batch
     */
    public function findFailuresInBatch(array $batch)
    {
        // make mock API call with batch of elements
        //
        $status = $this->mockAPI->processBatch($batch);

        // if it's only one element and it fails,
        // we've found an offending element
        //
        if (count($batch) == 1 && $status == false) {
            $this->failures += $batch;
            return;
        }

        // if status == true, the batch was good
        //
        if ($status == true) {
            $this->successes += $batch;
            return;
        } else {
            $halfway = floor(count($batch) / 2);
            $firstHalf = array_slice($batch, 0, $halfway, true);
            $secondHalf = array_slice($batch, $halfway, count($batch), true);

            // check first half
            //
            if (!empty($firstHalf)) {
                $this->findFailuresInBatch($firstHalf);
            }

            // check second half
            //
            if (!empty($secondHalf)) {
                $this->findFailuresInBatch($secondHalf);
            }
        }
    }
}