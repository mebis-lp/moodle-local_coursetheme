<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

/** @var bool $hassiteconfig * @package local_coursetheme
 * @package local_coursetheme
 */
if ($hassiteconfig) {
    /** @var admin_root $ADMIN */
    $ADMIN->add('users', new admin_externalpage(
        'local_coursetheme',
        'Kursthemes-Liste',
        new moodle_url('/local/coursetheme/themes.php')
    ));
// $ADMIN->add(
// $feuUsersCategory->name,
// new admin_externalpage(
// DegreeProgramConstants::getPluginName(),
// DegreeProgramLocalization::getPluginString(
// DegreeProgramLocalization::NAVIGATION_VIEW_DEGREE_PROGRAMS
// ),
// ViewDegreeProgramsPage::getMoodleUrl()
// )
// );
}
