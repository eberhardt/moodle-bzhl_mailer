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

if ($ADMIN->locate("localplugins")) {
	$tmp = new admin_settingpage("bzhl_mailer", get_string("pluginname", "local_bzhl_mailer"));
	$tmp->add(new admin_setting_heading("local_bzhl_mailer/emailsettings", get_string("emailsettings", "local_bzhl_mailer")));
	$tmp->add(new admin_setting_configtext("local_bzhl_mailer/subjectprefix",
	                                       get_string("subjectprefix", "local_bzhl_mailer"),
	                                       get_string("subjectprefix_info", "local_bzhl_mailer"),
	                                       null));
	$tmp->add(new admin_setting_configtextarea("local_bzhl_mailer/recipents",
	                                           get_string("emails", "local_bzhl_mailer"),
	                                           get_string("emails_info", "local_bzhl_mailer"),
	                                           ""));
	$tmp->add(new admin_setting_heading("local_bzhl_mailer/eventsettings", get_string("eventsettings", "local_bzhl_mailer")));
	$tmp->add(new admin_setting_configtextarea("local_bzhl_mailer/courses",
	                                           get_string("courses", "local_bzhl_mailer"),
	                                           get_string("courses_info", "local_bzhl_mailer"),
	                                           ""));
	$tmp->add(new admin_setting_configcheckbox("local_bzhl_mailer/emailonregistration",
	                                           get_string("emailonregistration",
	                                           "local_bzhl_mailer"),
	                                           get_string("emailonregistration_info",
	                                           "local_bzhl_mailer"),
	                                           true));
	$tmp->add(new admin_setting_configcheckbox("local_bzhl_mailer/emailonenrolment",
	                                           get_string("emailonenrolment", "local_bzhl_mailer"),
	                                           get_string("emailonenrolment_info", "local_bzhl_mailer"),
	                                           true));
	$tmp->add(new admin_setting_configcheckbox("local_bzhl_mailer/emailonconfirmation",
	                                           get_string("emailonconfirmation", "local_bzhl_mailer"),
	                                           get_string("emailonconfirmation_info", "local_bzhl_mailer"),
	                                           true));
	$tmp->add(new admin_setting_configcheckbox("local_bzhl_mailer/emailoncreation",
	                                           get_string("emailoncreation", "local_bzhl_mailer"),
	                                           get_string("emailoncreation_info", "local_bzhl_mailer"),
	                                           false));

	$ADMIN->add("localplugins", $tmp);
}
