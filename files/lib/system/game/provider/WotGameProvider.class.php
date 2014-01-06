<?php
namespace gms\system\game\provider;
use gms\data\game\GameServer;
use wcf\util\JSON;

/**
 * Implementation of GameProvider for World of Tanks
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms.game.wot
 * @subpackage	system.game.provider
 * @category	Guilded 2.0
 */
class WotGameProvider extends AbstractGameProvider implements IGameProvider {
	/**
	 * World of Tanks Application ID
	 * @var	string
	 */
	const APPLICATION_ID = '1504016756f5e1a53301705dfbd788e0'; // Application: Guilded

	/**
	 * @see	\wcf\system\game\provider\AbstractGameProvider::$baseUrl
	 */
	protected $baseUrl  = 'http://api.worldoftanks.eu/wot/';
	
	/**
	 * @see	\wcf\system\game\provider\IGameProvider::getGuild()
	 */
	public function getGuild($server, $name) {
		// @todo get clan by name and game
		$guild = null;
	
		// get data from provider
		$clan = $this->getData(array(
			'clan',
			'info'
		), array(
			'clan_id' => $guild->clanID
		));

		return array(
			'name' => $clan->name,
			'server' => $clan->realm,
			'level' => $clan->level,
			'members' => $clan->members
		);
	}

	/**
	 * Sending request and returns response data.
	 */
	protected function sendRequest($url) {
		parent::sendRequest($url);

		$this->data = JSON::decode($this->data, false);
	}
}