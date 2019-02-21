<?php
namespace App\Helpers;

trait CSVReader
{
	private $path;
	private $csv_file;
	private $requestCsvInfo;
	public $content;

	private $db;


	public function setPath(string $path)
	{
		$this->path = $path;
		return $this;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function setCsvFileName($csv)
	{
		$this->requestCsvInfo = $csv;
		$this->csv_file =  time() . '_' . $csv->getClientOriginalName();
		return $this;
	}

	public function getCsvFileName()
	{
		return $this->csv_file;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function moveFileToPublic()
	{
		$this->requestCsvInfo->move($this->getPath(),$this->getCsvFileName());
		return $this;
	}

	public function readContentFromPublic()
	{
		$this->content = file_get_contents(str_replace("\\",'/',$this->getPath()).$this->getCsvFileName());
		return $this;
	}

	public function convertToArrayWithDelimeter(string $delimeter)
	{
		$this->content = preg_split($delimeter, str_replace("\r", '', $this->content));
		return $this;
	}

	public function chunkInTo(int $pieces)
	{
		$this->content = array_chunk(array_filter($this->content),$pieces);
		return $this;
	}


}
