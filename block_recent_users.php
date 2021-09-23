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
 * Recent users block.
 *
 * @package    block_recent_users
 * @copyright  2021 Shadman Ahmed
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_recent_users extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_recent_users');
    }

    function has_config() {
        return true;
    }


    function get_content() {
        global $DB;
        if ($this->content !== NULL) {
            return $this->content;
        }

        $content = '';

        $showcourses = get_config('block_recent_users', 'showcourses');
        if($showcourses) {
            $content .= '<b> Recent Courses: </b><br>';
            $courses = $DB->get_records('course');
            foreach ($courses as $course) {
                $content .= $course->fullname . '<br>';
            }
        } else {
            $content .= '<b> Recent Users: </b><br>';
            $users = $DB->get_records('user');
            foreach($users as $user) {
                $content .= $user->firstname . ' ' . $user->lastname . ' ' . '<br>';
            }
        }
        
        $this->content = new stdClass();
        $this->content->text = $content;
        $this->content->footer= "";

        return $this->content;
    }
}
