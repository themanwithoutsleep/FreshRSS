<?php

return array(
	'auth' => array(
		'allow_anonymous' => 'Allow anonymous reading of the articles of the default user (%s)',
		'allow_anonymous_refresh' => 'Allow anonymous refresh of the articles',
		'api_enabled' => 'Allow <abbr>API</abbr> access <small>(required for mobile apps)</small>',
		'form' => 'Web form (traditional, requires JavaScript)',
		'http' => 'HTTP (for advanced users with HTTPS)',
		'none' => 'None (dangerous)',
		'persona' => 'Mozilla Persona (modern, requires JavaScript)',
		'title' => 'Authentication',
		'title_reset' => 'Authentication reset',
		'token' => 'Authentication token',
		'token_help' => 'Allows access to RSS output of the default user without authentication:',
		'type' => 'Authentication method',
		'unsafe_autologin' => 'Allow unsafe automatic login using the format: ',
	),
	'check_install' => array(
		'cache' => array(
			'nok' => 'Check permissions on <em>./data/cache</em> directory. HTTP server must have rights to write into',
			'ok' => 'Permissions on cache directory are good.',
		),
		'categories' => array(
			'nok' => 'Category table is bad configured.',
			'ok' => 'Category table is ok.',
		),
		'connection' => array(
			'nok' => 'Connection to the database cannot being established.',
			'ok' => 'Connection to the database is ok.',
		),
		'ctype' => array(
			'nok' => 'You lack a required library for character type checking (php-ctype).',
			'ok' => 'You have the required library for character type checking (ctype).',
		),
		'curl' => array(
			'nok' => 'You lack cURL (php5-curl package).',
			'ok' => 'You have cURL extension.',
		),
		'data' => array(
			'nok' => 'Check permissions on <em>./data</em> directory. HTTP server must have rights to write into',
			'ok' => 'Permissions on data directory are good.',
		),
		'database' => 'Database installation',
		'dom' => array(
			'nok' => 'You lack a required library to browse the DOM (php-xml package).',
			'ok' => 'You have the required library to browse the DOM.',
		),
		'entries' => array(
			'nok' => 'Entry table is bad configured.',
			'ok' => 'Entry table is ok.',
		),
		'favicons' => array(
			'nok' => 'Check permissions on <em>./data/favicons</em> directory. HTTP server must have rights to write into',
			'ok' => 'Permissions on favicons directory are good.',
		),
		'feeds' => array(
			'nok' => 'Feed table is bad configured.',
			'ok' => 'Feed table is ok.',
		),
		'files' => 'File installation',
		'json' => array(
			'nok' => 'You lack JSON (php5-json package).',
			'ok' => 'You have JSON extension.',
		),
		'minz' => array(
			'nok' => 'You lack the Minz framework.',
			'ok' => 'You have the Minz framework.',
		),
		'pcre' => array(
			'nok' => 'You lack a required library for regular expressions (php-pcre).',
			'ok' => 'You have the required library for regular expressions (PCRE).',
		),
		'pdo' => array(
			'nok' => 'You lack PDO or one of the supported drivers (pdo_mysql, pdo_sqlite).',
			'ok' => 'You have PDO and at least one of the supported drivers (pdo_mysql, pdo_sqlite).',
		),
		'persona' => array(
			'nok' => 'Check permissions on <em>./data/persona</em> directory. HTTP server must have rights to write into',
			'ok' => 'Permissions on Mozilla Persona directory are good.',
		),
		'php' => array(
			'_' => 'PHP installation',
			'nok' => 'Your PHP version is %s but FreshRSS requires at least version %s.',
			'ok' => 'Your PHP version is %s, which is compatible with FreshRSS.',
		),
		'tables' => array(
			'nok' => 'There is one or more lacking tables in the database.',
			'ok' => 'Tables are existing in the database.',
		),
		'title' => 'Installation checking',
		'tokens' => array(
			'nok' => 'Check permissions on <em>./data/tokens</em> directory. HTTP server must have rights to write into',
			'ok' => 'Permissions on tokens directory are good.',
		),
		'users' => array(
			'nok' => 'Check permissions on <em>./data/users</em> directory. HTTP server must have rights to write into',
			'ok' => 'Permissions on users directory are good.',
		),
		'zip' => array(
			'nok' => 'You lack ZIP extension (php5-zip package).',
			'ok' => 'You have ZIP extension.',
		),
	),
	'extensions' => array(
		'disabled' => 'Disabled',
		'empty_list' => 'There is no installed extension',
		'enabled' => 'Enabled',
		'no_configure_view' => 'This extension cannot be configured.',
		'system' => array(
			'_' => 'System extensions',
			'no_rights' => 'System extension (you have no rights on it)',
		),
		'title' => 'Extensions',
		'user' => 'User extensions',
	),
	'stats' => array(
		'_' => 'Statistics',
		'all_feeds' => 'All feeds',
		'category' => 'Category',
		'entry_count' => 'Entry count',
		'entry_per_category' => 'Entries per category',
		'entry_per_day' => 'Entries per day (last 30 days)',
		'entry_per_day_of_week' => 'Per day of week (average: %.2f messages)',
		'entry_per_hour' => 'Per hour (average: %.2f messages)',
		'entry_per_month' => 'Per month (average: %.2f messages)',
		'entry_repartition' => 'Entries repartition',
		'feed' => 'Feed',
		'feed_per_category' => 'Feeds per category',
		'idle' => 'Idle feeds',
		'main' => 'Main statistics',
		'main_stream' => 'Main stream',
		'menu' => array(
			'idle' => 'Idle feeds',
			'main' => 'Main statistics',
			'repartition' => 'Articles repartition',
		),
		'no_idle' => 'There is no idle feed!',
		'number_entries' => '%d articles',
		'percent_of_total' => '%% of total',
		'repartition' => 'Articles repartition',
		'status_favorites' => 'Favourites',
		'status_read' => 'Read',
		'status_total' => 'Total',
		'status_unread' => 'Unread',
		'title' => 'Statistics',
		'top_feed' => 'Top ten feeds',
	),
	'update' => array(
		'_' => 'Update system',
		'apply' => 'Apply',
		'check' => 'Check for new updates',
		'current_version' => 'Your current version of FreshRSS is the %s.',
		'last' => 'Last verification: %s',
		'none' => 'No update to apply',
		'title' => 'Update system',
	),
	'user' => array(
		'articles_and_size' => '%s articles (%s)',
		'create' => 'Create new user',
		'email_persona' => 'Login mail address<br /><small>(for <a href="https://persona.org/" rel="external">Mozilla Persona</a>)</small>',
		'language' => 'Language',
		'number' => 'There is %d account created yet',
		'numbers' => 'There are %d accounts created yet',
		'password_form' => 'Password<br /><small>(for the Web-form login method)</small>',
		'password_format' => 'At least 7 characters',
		'registration' => array(
			'allow' => 'Allow account creation',
			'help' => '0 means that there is no account limit',
			'number' => 'Max number of accounts',
		),
		'title' => 'Manage users',
		'user_list' => 'List of users',
		'username' => 'Username',
		'users' => 'Users',
	),
);
