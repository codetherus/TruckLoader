<?php
/**
*	Http Client
*	Copyright (C) 2013-2014  Norbert Krzysztof Kiszka <norbert at linux dot pl>
*	This program is free software; you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation; either version 2 of the License, or
*	(at your option) any later version.
*
*	This program is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*	GNU General Public License for more details.
*
*	You should have received a copy of the GNU General Public License along
*	with this program; if not, write to the Free Software Foundation, Inc.,
*	51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
* 
*	@category Http Client
*	@package Http Client
*	@copyright Copyright (c) 2013-2014 Norbert Kiszka
*	@license http://www.gnu.org/licenses/gpl-2.0.html
*	@version 0.5
*/

/*
*	Http Client - example of usage - get and print latest entries from service phpclasses (rss) to stdout.
*	Read included howto.
*/

function autoLoader($class)
{
	require_once('lib/' . str_replace('_', '/', $class) . '.php');
}

spl_autoload_register('autoLoader');

echo "\nPlease wait. Loading data..."; // it takes some time

// Get lates entries on phpclasses

$request = new Http_Request('http://feeds.feedburner.com/phpclasses-xml?format=xml'); // Create request object

$response = $request->getResponse(); // Send request and get response object (method send() is called automatically in getResponse() when wasn't before)

$xml = $response->getBody(); // Get body of http response (__toString() is a alias of it)

// Shortcuts:
// $xml = (new Http_Request('http://feeds.feedburner.com/phpclasses-xml?format=xml'))->getResponse()->getBody()
// $xml = Http_Client::get('feeds.feedburner.com/phpclasses-xml?format=xml')->getBody();
// $xml = Http_Client::get_('feeds.feedburner.com/phpclasses-xml?format=xml');

// -----------------------------

// Parse and output it to stdout

$reader = new XMLReader;

$reader->xml($xml);

echo "\rLatest entries in phpclasses readed from rss. Example code of Http Client (read included html howto) and XMLReader usage.\n\n---------------------------------------------------------------------------------------------------------------------\n\n";

while($reader->read())
{	
	if($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'item')
	{
		$outer = $reader->readOuterXML();
		$outerReader = new XMLReader;
		$outerReader->xml($outer);
		while($outerReader->read())
		{
			if($outerReader->nodeType == XMLReader::ELEMENT)
			{
				switch($outerReader->name)
				{
					case 'title':
						echo 'Title:        ' .  $outerReader->readString() . "\n";
					break;
					
					case 'feedburner:origLink':
						echo 'Direct link:  ' .  $outerReader->readString() . "\n";
						echo "\n---------------------------------------------------------------------------------------------------------------------\n\n";
					break;
				}
				
				
				
			}
		}
	}
}