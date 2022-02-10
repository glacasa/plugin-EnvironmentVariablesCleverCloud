<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

return array(
    'Piwik\Config' => DI\decorate(function ($previous, \Psr\Container\ContainerInterface $c) {
	
		$category = "database";
		$general = $previous->$category;
		
		$proxySql = getenv("CC_ENABLE_MYSQL_PROXYSQL");
		if ($proxySql !== false) {
			$unix_socket  = getenv("CC_MYSQL_PROXYSQL_SOCKET_PATH");
			$general["unix_socket"] = $unix_socket;
		}
		else{
			$host = getenv("MYSQL_ADDON_HOST");
			$general["host"] = $host;
		}
		
        $username = getenv("MYSQL_ADDON_USER");
        $password = getenv("MYSQL_ADDON_PASSWORD");
        $dbname = getenv("MYSQL_ADDON_DB");
        $general["username"] = $username;
        $general["password"] = $password;
        $general["dbname"] = $dbname;
		
		$previous->$category = $general;

        return $previous;
    }),
);