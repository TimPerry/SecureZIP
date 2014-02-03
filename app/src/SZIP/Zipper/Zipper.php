<?php

namespace SZIP\Zipper;

class Zipper {

	protected $input_files;

	public function __construct( $input_files = array() ) {

		$this->input_files = $input_files;

	}

} 