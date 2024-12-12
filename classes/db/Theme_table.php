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

/**
 * @author Daniel Poggenpohl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package local_coursetheme
 */

namespace local_coursetheme\db;

class Theme_table {
    const TABLE_NAME = 'coursetheme_theme';

    const FIELD_ID = 'id';

    const FIELD_TYPE = 'type';

    const FIELD_NAME = 'name';

    const FIELD_DISPLAYNAME = 'displayname';

    const FIELD_CSS = 'css';

    const FIELD_js = 'js';
}
