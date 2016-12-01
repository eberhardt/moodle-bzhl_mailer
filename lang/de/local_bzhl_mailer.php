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
$string["emailsettings"] = 'Versandeinstellungen';
$string["subjectprefix"] = 'Betreff-Präfix';
$string["subjectprefix_info"] = 'Ein Text der dem Betreff aller E-Mail-Nachricht vorangestellt wird. Dies kann E-Mail-Clients helfen die vom BZHL Mailer generierten  Nachrichten zu filtern.';
$string["emails"] = 'Empfängerliste';
$string["emails_info"] = 'Zeilenseperierte Liste der E-Mail-Adressen, die über den Registrierungsstatus informiert werden (Best&auml;tigugng, Einschreibung, Registrierung).';
$string["eventsettings"] = 'Ereignis-Einstellungen';
$string["courses"] = 'Beobachtete Kurse';
$string["courses_info"] = 'Liste der Kurse (ID), von denen Benachrichtigungen ausgehen (bei Selbsteinschreibung oder Registration).';
$string["emailonregistration"] = 'E-Mail bei An-/Abmeldung';
$string["emailonregistration_info"] = 'Sendet eine Benachrichtigung an die Liste, wenn eine An- oder Abmeldung in einem der beobachteten Kurse registriert wurde.';
$string["emailonenrolment"] = 'E-Mail bei Ein-/Ausschreibung';
$string["emailonenrolment_info"] = 'Sendet eine Benachrichtigung an die Liste, wenn sich Nutzende in einem der beobachteten Kurse ein- oder ausschreiben.';
$string["emailonconfirmation"] = 'E-Mail bei Bestätigung';
$string["emailonconfirmation_info"] = 'Sendet eine Benachrichtigung an die Liste, wenn Nutzende ihre Registrierung best&auml;tigen.';
$string["emailoncreation"] = 'E-Mail bei Registrierung';
$string["emailoncreation_info"] = 'Sendet eine Benachrichtigung an die Liste, wenn neue Konten angelegt werden. Diese Option wird nicht empfohlen, da sie sehr anf&auml;llig gegen Missbrauch (Spam) ist.';
