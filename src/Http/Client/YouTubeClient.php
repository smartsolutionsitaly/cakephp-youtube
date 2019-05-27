<?php
/**
 * cakephp-youtube (https://github.com/smartsolutionsitaly/cakephp-youtube)
 * Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 *
 * YouTube plugin for CakePHP
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  cakephp-plugin
 * @package   cakephp-youtube
 * @author    Lucio Benini <dev@smartsolutions.it>
 * @copyright 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://smartsolutions.it Smart Solutions
 * @since     1.0.0
 */

namespace SmartSolutionsItaly\CakePHP\YouTube\Http\Client;

use Cake\Core\Configure;
use Exception;

/**
 * A wrapper class for YouTube client.
 * @package SmartSolutionsItaly\CakePHP\YouTube\Http\Client
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class YouTubeClient
{
    /**
     * The base client.
     * @var \Google_Client
     */
    protected $_client;

    /**
     * Constructor.
     * Configures the base client.
     * @throws \Google_Exception
     */
    public function __construct()
    {
        $client = new \Google_Client();
        $client->setApplicationName(Configure::read('Google.appName'));
        $client->setScopes([\Google_Service_YouTube::YOUTUBE]);
        $client->setAuthConfig(Configure::read('Google.service'));
        $client->useApplicationDefaultCredentials();
        $this->_client = new \Google_Service_YouTube($client);
    }

    /**
     * Gets the channel's items.
     * @param string $id The channel's ID.
     * @param int $count The number of returned results.
     * @return mixed The channel's items.
     */
    public function getChannel(string $id, int $count = 10)
    {
        return $this->_client
            ->search
            ->listSearch('id,snippet', [
                'part' => 'snippet',
                'channelId' => $id,
                'order' => 'date',
                'maxResults' => $count,
                'type' => 'video'
            ])
            ->getItems();
    }

    /**
     * Process a channel's ID and checks if its validity.
     * @param string $id The channel's ID.
     * @return string|null If the ID is valid returns it; otherwise, a null value.
     */
    public function processChannelId(string $id)
    {
        if (!empty($id)) {
            try {
                $this->_client
                    ->search
                    ->listSearch('id', [
                        'channelId' => $id
                    ])
                    ->getItems();

                return $id;
            } catch (Exception $ex) {
                return $this->getChannelId($id);
            }
        }

        return null;
    }

    /**
     * Gets a channel's ID from the given username.
     * @param string $username The YouTube username.
     * @param int $position The channel's position in the results.
     * @return string|null The channel's ID from the given username.
     */
    public function getChannelId(string $username, int $position = 0)
    {
        try {
            $items = $this->_client
                ->channels
                ->listChannels('id', [
                    'forUsername' => $username
                ])
                ->getItems();

            if (!empty($items[$position]->id)) {
                return $items[$position]->id;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
}
