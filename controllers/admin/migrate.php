<?php

/*
 * @auther Shafiq
 */
defined("BASEPATH") or exit("No direct script access allowed");
(defined('ENVIRONMENT') && ENVIRONMENT === "development") or exit("Migrations only work in development");

class Migrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index($version = -2) {

        $this->load->library('migration');
        echo '<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type"content="text/html; charset=utf-8"/>
<title>' . SITE_NAME . '</title>
<base href="' . base_url() . '">
</head>
<body>';

        if ($version >= 0) {
            echo"<pre>Migrating to version:" . $version . "\n</pre>";
            if (!$this->migration->version($version)) {
                show_error($this->migration->error_string(), 200, 'Migrating to version ' . $version . ' has failed.');
            }
        } else if ($version == -2) {
            echo"<pre>Undoing migrations...\n</pre> <a href='" . base_url('admin/migrate/index/-1') . "'>Click here to continue.</a>";
            if (!$this->migration->version(0)) {
                show_error($this->migration->error_string(), 200, 'Migrating to version 0 has failed.');
            }
        } else {
            echo"<pre>Migrating to the latest version....\n</pre>";
            if (!$this->migration->latest()) {
                show_error($this->migration->error_string(), 200, 'Migrating to latest has failed.');
            }
            echo"<a href='" . base_url('/') . "'>Click here to continue.</a>";
        }

        echo '</body></html>';
    }

}
