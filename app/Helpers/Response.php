<?php
namespace App\Helpers;

use Illuminate\Http\Request;
trait Response
{
	private $errors = [];
	private $messages;

	/**
	 * [Set errors]
	 * @param array $errors [description]
	 */
	public function setErrors(array $errors)
	{
		$this->errors = $errors;
		return $this;
	}

	/**
	 * [flattenErrors flatten the error messages]
	 * @return [type] [description]
	 */
	private function flattenErrors()
	{
		$this->errors = array_flatten($this->errors);
	}

	/**
	 * [Replace some string in error messages ]
	 * @param  string $find    [description]
	 * @param  string $replace [description]
	 * @return [type]          [description]
	 */
	public function findAndReplaceErrorMessage(string $pattern , string $replace)
	{
		if (is_null($this->errors)) {
			throw new Exception('Undefined errors.');
		}
		foreach ($this->errors as &$message) {
			$message = preg_replace($pattern, $replace, $message);
		}
		return $this;
	}

	/**
	 * [Display some errors and set flash messages]
	 * @return [type] [description]
	 */
	public function displayErrors()
	{
		$this->flattenErrors();
		$this->message = rtrim(str_replace('.'," , ", implode('',$this->errors)),' , ');
		setFlashMessage('errors',$this->message);
		return $this;
	}

	/**
	 * [Redirect to back]
	 * @return [type] [description]
	 */
	public function toPreviousPage()
	{
		return redirect($_SERVER['HTTP_REFERER']);
	}

	public function toRoute(string $route)
	{
		return redirect()->route($route);
	}
}
