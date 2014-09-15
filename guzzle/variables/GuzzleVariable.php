<?php
namespace Craft;

class GuzzleVariable
{
	public function get($options)
	{
		$url = $options['url'];
		$limit = array_key_exists('limit', $options) ? NumberHelper::makeNumeric($options['limit']) : null;
		$offset = array_key_exists('offset', $options) ? NumberHelper::makeNumeric($options['offset']) : 0;
		$expire = array_key_exists('expire', $options) ? NumberHelper::makeNumeric($options['expire']) : null;

		// Check to see if the response is cached
		$cachedResponse = craft()->fileCache->get($url);

		if ($cachedResponse) {
			return $cachedResponse;
		}

		try {
			$client = new \Guzzle\Http\Client();
			$request = $client->get($url);
			$response = $request->send();

			if (!$response->isSuccessful()) {
				return;
			}

			$items = $response->json();

			// Cache the response
			craft()->fileCache->set($url, $items, $expire);

			// Apply the limit and offset
			$items = array_slice($items, $offset, $limit);

			return $items;
		} catch(\Exception $e) {
			return;
		}
	}
}