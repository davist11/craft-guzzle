<?php
namespace Craft;

class GuzzleVariable
{
	public function objectToArray($object)
	{
		if(!is_object($object) && !is_array($object)) {
			return $object;
		}

		return array_map(array($this, 'objectToArray'), (array) $object);
	}

	public function get($options)
	{
		$url = $options['url'];
		$format = array_key_exists('format', $options) ? $options['format'] : 'json';
		$traverse_to = array_key_exists('traverseTo', $options) ? $options['traverseTo'] : null;
		$limit = array_key_exists('limit', $options) ? NumberHelper::makeNumeric($options['limit']) : null;
		$offset = array_key_exists('offset', $options) ? NumberHelper::makeNumeric($options['offset']) : 0;

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
		} catch(\Exception $e) {
			return;
		}

		if ($format == 'xml') {
			$items = $response->xml();
			$items = $this->objectToArray($items);
		} else {
			$items = $response->json();
		}

		if($traverse_to) {
			$keys = explode(',', $traverse_to);
			foreach ($keys as $key) {
				$items = $items[$key] ? $items[$key] : $items;
			}
		}

		// Apply the limit and offset
		$items = array_slice($items, $offset, $limit);

		// Cache the response
		craft()->fileCache->set($url, $items);

		return $items;
	}
}