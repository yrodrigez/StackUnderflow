<?php

class Tag 
{
	private $idTag;
	private $tag;
	public function __construct(
		$idTag= NULL,
		$tag= NULL
	) {
		$this->idTag= $idTag
		$this->tag= $tag;
	}

	public function getId()
	{
		return $this->idTag;
	}

	public function setId( 
		$idTag	
	) {
		$this->idTag= $idTag;
	}

	public function getTag()
	{
		return $this->tag;
	}

	public function setTag( 
		$tag	
	) {
		$this->tag= $tag;
	}
}