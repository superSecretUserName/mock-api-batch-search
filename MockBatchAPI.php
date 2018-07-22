<?php

/**
 * Class MockBatchAPI
 */
class MockBatchAPI
{

    /**
     * Processes a batch. Fails if any elements are false
     * @param array $batch
     * @return bool
     */
    public function processBatch(array $batch)
    {
        foreach($batch as $item) {
            if ($item == false) {
                return false;
            }
        }

        return true;
    }

    public function generateBatchWithRandomFailures(int $size, int $failurePercent)
    {
        $failPositions = [];

        $randMax = floor(100 / $failurePercent);

        for ($i = 0; $i < $size; $i++) {
            if (rand(0, $randMax) == 0) {
                $failPositions[] = $i;
            }
        }

        return $this->generateBatch($size, $failPositions);
    }

    /**
     * returns a a batch of $size, setting failPositions to false
     * @param int $size
     * @param array $failPositions
     * @return array
     */
    public function generateBatch(int $size, array $failPositions = [])
    {
        $batchItems = [];

        // generate with all true
        //
        for ($i = 0; $i < $size; $i++) {
            $batchItems[$i] = true;
        }

        // flag failure positions
        //
        for ($i = 0; $i < count($failPositions); $i++) {
            $batchItems[$failPositions[$i]] = false;
        }

        return $batchItems;
    }
}