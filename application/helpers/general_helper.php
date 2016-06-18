<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function checkLogged() {
	if (!get_instance()->session->has_userdata('username')) {
		redirect(site_url('login'));
		return false;
	}
	return true;
}

function checkToken($token) {
	$init = get_instance();
	$init->load->model("m_register");
	return $init->m_register->checkToken($token);
}