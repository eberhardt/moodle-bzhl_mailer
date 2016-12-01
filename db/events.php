<?php

$observers = array(

		array('eventname' => '\core\event\user_enrolment_created',
		      'includefile' => '/local/bzhl_mailer/lib.php',
		      'callback' => 'local_bzhl_mailer_enrolment',
		      'priority' => 200
		      ),

		array('eventname' => '\core\event\user_created',
		      'includefile' => '/local/bzhl_mailer/lib.php',
		      'callback' => 'local_bzhl_mailer_creation',
		      'priority' => 200
		      ),

		array('eventname' => '\mod_registration\event\user_subscribed',
		      'includefile' => '/local/bzhl_mailer/lib.php',
		      'callback' => 'local_bzhl_mailer_registration',
		      'priority' => 200
		      ),

		array('eventname' => '\mod_registration\event\user_unsubscribed',
				'includefile' => '/local/bzhl_mailer/lib.php',
				'callback' => 'local_bzhl_mailer_deregistration',
				'priority' => 200
		),

		array('eventname' => '\core\event\user_enrolment_deleted',
		      'includefile' => '/local/bzhl_mailer/lib.php',
		      'callback' => 'local_bzhl_mailer_unenrol',
		      'priority' => 200));
