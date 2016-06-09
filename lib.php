<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * BZHL - Bibliothek zum Versenden von eigenen Nachrichten an eine im Backend definierte Liste
*
* @package   local_bzhl_mailer
* @copyright 2015 Jan Eberhardt (@innoCampus, TU Berlin)
* @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die();

/**
 * Sends the message
 *
 * @param string $subject
 * @param string $message
 */
function local_bzhl_mailer_send($subject, $message) {
	global $CFG;
	$emails = explode("\n", get_config("local_bzhl_mailer", "recipents"));
	$recipents = array();
	foreach ($emails as $address) {
		if (validate_email($address)) {
			$recipents[] = $address;
		}
	}
	if (!empty($recipents)) {
		// Don't send an email, unless at least one address is vaild.
		$admin = get_admin();
		$mail = get_mailer();
		$mail->From = $CFG->noreplyaddress;
		$mail->FromName = fullname($admin);
		$mail->Subject = $subject;
		$mail->Body = $message;
		foreach ($recipents as $recipent) {
			$mail->addAddress($recipent);
		}

		return $mail->send();
	} else {
		return true;
	}
}

/**
 *
 * @param string $emailsetting
 * @return boolean
 */
function local_bzhl_mailer_is_enabled($emailsetting) {
	$config = get_config("local_bzhl_mailer", $emailsetting);
	return ($config != "0");
}

/*************************************** MANUALLY CALLED MAILER **********************************************/

/**
 * Sends confirmation notification
 *
 * @param stdClass $user Moodle user object
 */
function local_bzhl_mailer_confirmation(stdClass $user) {
	global $CFG;
	if (!local_bzhl_mailer_is_enabled("emailonconfirmation")) {
		// Disabled by setting.
		return true;
	}
	$subject = "User registration confirmed";
	$message = "The registration of following student has been confirmed:\n\n"
	         . "Username: " . $user->username . "\n"
	         . "Fullname: " . fullname($user) . "\n"
	         . "Email:    " . $user->email . "\n\n"
	         . "Visit the profile: " . $CFG->wwwroot . "/user/profile.php?id=" . $user->id . "\n\n"
	         . "--\nThis message was created automatically.";

	return local_bzhl_mailer_send($subject, $message);
}

/*************************************** EVENT BASED MAILER **********************************************/

/**
 * Sends notification on self-registration
 *
 * @param stdClass $eventdata
 * @return boolean
 * @see https://docs.moodle.org/dev/Events_API#Handling_an_event
 */
function local_bzhl_mailer_creation($eventdata) {
	global $CFG;
	if (!local_bzhl_mailer_is_enabled("emailoncreation")) {
		// Disabled by setting.
		return true;
	}
	$user = get_complete_user_data("id", $eventdata->relateduserid);
	$subject = "A new user has registered";
	$message = "The following account was created:\n\n"
	         . "Username: " . $user->username . "\n"
	         . "Fullname: " . fullname($user) . "\n"
	         . "Email:    " . $user->email . "\n\n"
	         . "Visit the user profile: {$CFG->wwwroot}/user/profile.php?id={$user->id}\n\n"
	         . "--\nThis message was created automatically.";

	return local_bzhl_mailer_send($subject, $message);
}

/**
 * Sends enrolment notification
 *
 * @param stdClass $eventdata
 * @return boolean
 * @see https://docs.moodle.org/dev/Events_API#Handling_an_event
 */
function local_bzhl_mailer_enrolment($eventdata) {
	global $CFG, $DB;
	if ($eventdata->other["enrol"] !== "self") {
		// Only on self-enrolment.
		return true;
	}
	if (!local_bzhl_mailer_is_enabled("emailonenrolment")) {
		// Disabled by setting.
		return true;
	}
	$courses = explode("\n", get_config("local_bzhl_mailer", "courses"));
	$courses = array_map("trim", $courses);
	if (!in_array($eventdata->courseid, $courses)) {
		// This course isn't watched.
		return true;
	}
	$user = get_complete_user_data("id", $eventdata->userid);
	$cname = $DB->get_field("course", "fullname", array("id" => $eventdata->courseid));
	$subject = "User subscribed to a course";
	$message = "The student " . fullname($user) . " has subscribed to the course `{$cname}` successfully.\n\n"
	         . "Visit the course profile: {$CFG->wwwroot}/user/view.php?id={$user->id}&course={$eventdata->courseid}\n\n"
	         . "--\nThis message was created automatically.";

	return local_bzhl_mailer_send($subject, $message);
}

/**
 * Sends notification when user unenrols
 *
 * @param stdClass $eventdata
 * @return boolean
 * @see https://docs.moodle.org/dev/Events_API#Handling_an_event
 */
function local_bzhl_mailer_unenrol($eventdata) {
	global $CFG, $DB;

	if ($eventdata->other["enrol"] !== "self") {
		// Only on self-enrolment.
		return true;
	}
	if (!local_bzhl_mailer_is_enabled("emailonenrolment")) {
		// Disabled by setting.
		return true;
	}
	$courses = explode("\n", get_config("local_bzhl_mailer", "courses"));
	$courses = array_map("trim", $courses);
	if (!in_array($eventdata->courseid, $courses)) {
		// This course isn't watched.
		return true;
	}
	$user = get_complete_user_data("id", $eventdata->userid);
	$cname = $DB->get_field("course", "fullname", array("id" => $eventdata->courseid));
	$subject = "User unsubscribed from a course";
	$message = "The student " . fullname($user) . " has unsubscribed to the course `{$cname}` successfully.\n\n"
	         . "Visit the user profile: {$CFG->wwwroot}/user/view.php?id={$user->id}\n\n"
	         . "--\nThis message was created automatically.";

	return local_bzhl_mailer_send($subject, $message);
}

/**
 * Sends registration notfication
 *
 * @param stdClass $eventdata
 * @return boolean
 * @see https://docs.moodle.org/dev/Events_API#Handling_an_event
 */
function local_bzhl_mailer_registration($eventdata) {
	global $CFG, $DB;
	if (!local_bzhl_mailer_is_enabled("emailonregistration")) {
		// Disabled by setting
		return true;
	}
	$cm = get_coursemodule_from_id("registration", $eventdata->contextinstanceid, $eventdata->courseid);
	$user = get_complete_user_data("id", $eventdata->userid);
	$courses = explode("\n", get_config("local_bzhl_mailer", "courses"));
	if (!in_array($cm->course, $courses)) {
		return true;
	}
	// May use section name or activity name... not sure
	$name = $DB->get_field("course_sections", "name", array("id" => $cm->section));
	//$name = $DB->get_field("registration", "name", array("id" => $cm->instance)); // optional
	$subject = "User registered succesfully";
	$message = "The following registration has been saved:\n\n"
	         . "Name:     " . fullname($user) . "\n"
	         . "Workshop: " . $name . "\n\n"
	         . "Visit the course profile: {$CFG->wwwroot}/user/view.php?id={$user->id}&course={$cm->course}\n"
	         . "Visit the registration:   {$CFG->wwwroot}/mod/registration/view.php?id={$cm->id}\n\n"
	         . "--\nThis message was created automatically.";

	return local_bzhl_mailer_send($subject, $message);
}
