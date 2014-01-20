<?php
namespace Craft;

class GuzzlePlugin extends BasePlugin
{
	function getName()
	{
		 return Craft::t('Guzzle');
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Trevor Davis';
	}

	function getDeveloperUrl()
	{
		return 'http://trevordavis.net';
	}
}