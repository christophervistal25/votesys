<?php
use App\Admin;
use App\AdminInfo;

function getAdminInfo(array $columns = ['*'])
{
	return AdminInfo::first($columns);
}

function getAdminCredentials(array $columns = ['*'])
{
	return Admin::first($columns);
}
