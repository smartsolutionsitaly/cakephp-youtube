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

namespace SmartSolutionsItaly\CakePHP\YouTube\Shell;

use Cake\Console\Shell;
use SmartSolutionsItaly\CakePHP\YouTube\Http\Client\YouTubeClient;

/**
 * YouTube Shell.
 * @package SmartSolutionsItaly\CakePHP\YouTube\Shell
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class YouTubeShell extends Shell
{
    /**
     * Base client.
     * @var YouTubeClient
     */
    protected $_client;

    /**
     * {@inheritDoc}
     * @see \Cake\Controller\Controller::initialize()
     */
    public function initialize()
    {
        parent::initialize();

        $this->_client = new YouTubeClient;
    }

    /**
     * The main shell command.
     * @return null
     */
    public function main()
    {
        return null;
    }

    /**
     * Gets the ID of the given user.
     * @param string $username The username.
     * @return mixed The ID of the given user.
     */
    public function id($username)
    {
        $id = $this->_client->processChannelId($username);

        if ($id) {
            $this->info(__('ID: {0}', $id));
        } else {
            $this->info(__('The ID or Username is not correct.'));
        }

        return $id;
    }

    /**
     * Gets the option parser instance and configures it.
     * @return \Cake\Console\ConsoleOptionParser The option parser instance.
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->addSubcommand('id', [
            'help' => __('Checks the channel ID.'),
            'parser' => [
                'description' => [
                    __('Used to check the channel ID.')
                ]
            ],
            'arguments' => [
                'username' => [
                    'help' => __('Username or ID.'),
                    'required' => true
                ]
            ]
        ]);

        return $parser;
    }
}
