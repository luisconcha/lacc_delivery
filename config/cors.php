<?php
return [
		/*
		 |--------------------------------------------------------------------------
		 | Laravel CORS
		 |--------------------------------------------------------------------------
		 |

		 | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
		 | to accept any value.
		 |
		 */
	'supportsCredentials' => false,
	'allowedOrigins'      => [ '*' ], // ['http://localhost:8000','outra_url']
	'allowedHeaders'      => [ '*' ],
	'allowedMethods'      => [ '*' ],
	'exposedHeaders'      => [],
	'maxAge'              => 0,
	'hosts'               => [],
];

