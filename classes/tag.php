<?php

class Tag 
{
	private $tag;
	public function __construct(
		$tag= NULL
	) {
		$this->tag= $tag;
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