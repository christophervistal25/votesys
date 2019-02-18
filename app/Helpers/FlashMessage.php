<?php

function setFlashMessage(string $key , string $message)
{
	if (session_id() == null) {
		session_start();
	}
	$_SESSION[$key] = $message;
}

function hasMessage(string $key)
{
	if (session_id() == null) {
		session_start();
	}
	return isset($_SESSION[$key]);
}

function flushMessage(string $key)
{
	if (session_id() != null) {
		$_SESSION[$key] = null;
	}
}

function getFlashMessage(string $key)
{
	if (session_id() != '' && isset($_SESSION[$key])) {
		return $_SESSION[$key];
	}
}


