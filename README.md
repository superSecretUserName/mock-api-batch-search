# Mock API And Binary Search

### Installation:
* run composer install
* run index.php

### Purpose
This binary search is meant to work with an external API that accepts batches of objects. In the event that all objects are valid, the API responds with true. If any given element is invalid, the API rejects the entire batch with no indication of which is the offending element.

This binary search breaks any offending batch into smaller and smaller batches until the offending elements have been found.

Successful and unsuccessful elements are recorded in the class properties of $successes and $failures.

Keep in mind that successful calls to the Mock API are considered saved/processed by the API. By the end of this search, any elements in the $successes array will have been accepted by the API, and any in the $failures array will not have been processed by the API.


