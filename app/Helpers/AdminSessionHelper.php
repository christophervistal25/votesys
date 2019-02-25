<?php

function isAdminLogin()
{
	if (session_id() == null) {
		session_start();
	}
	return isset($_SESSION['login']) && $_SESSION['login'] === true;
}


