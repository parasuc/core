<?php
/**
 * @author Roeland Jago Douma <rullzer@owncloud.com>
 * @author Victor Dubiniuk <dubiniuk@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud GmbH.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\Files_Versions\AppInfo;

use OCP\AppFramework\App;
use OCA\Files_Versions\Expiration;

class Application extends App {
	public function __construct(array $urlParams = array()) {
		parent::__construct('files_versions', $urlParams);

		$container = $this->getContainer();

		/*
		 * Register capabilities
		 */
		$container->registerCapability('OCA\Files_Versions\Capabilities');

		/*
		 * Register expiration
		 */
		$container->registerService('Expiration', function($c) {
			return  new Expiration(
				$c->query('ServerContainer')->getConfig(),
				$c->query('OCP\AppFramework\Utility\ITimeFactory')
			);
		});
	}
}
