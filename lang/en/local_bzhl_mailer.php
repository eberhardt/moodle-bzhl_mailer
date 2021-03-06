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

$string["pluginname"] = 'BZHL Mailer';
$string["emailsettings"] = 'Send Options';
$string["subjectprefix"] = 'Subject prefix';
$string["subjectprefix_info"] = 'A string which is prepended on the subject of every mail. This may help email clients to filter the automated messages.';
$string["emails"] = 'Recipents';
$string["emails_info"] = 'List of email adresses, which are to be noticed about the registration procedure (confirmation, subscription, registration)';
$string["eventsettings"] = 'Event management';
$string["courses"] = 'Watched courses';
$string["courses_info"] = 'List of courses (ID), which will send notifications (on self-subscription and registration).';
$string["emailonregistration"] = 'Email on registration/deregistration';
$string["emailonregistration_info"] = 'Sends an email notification to the list, when a registration or deregistration was submitted in one of the specified courses.';
$string["emailonenrolment"] = 'Email on (un)enrolment';
$string["emailonenrolment_info"] = 'Sends an email notification to the list, when a user enrols or unenrols in one of the specified courses.';
$string["emailonconfirmation"] = 'Email on confirmation';
$string["emailonconfirmation_info"] = 'Sends an email notification to the list, when a user confirmed his self-registration to the site.';
$string["emailoncreation"] = 'Email on creation';
$string["emailoncreation_info"] = 'Sends an email notification to the list, when a new user was created. This option is not recommended due high risk of spam.';
