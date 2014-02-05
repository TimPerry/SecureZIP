<?php

namespace SZIP\Zipper;

use Symfony\Component\Process\Process;

class Secure7zZipper {

	protected $input_location;
	protected $output_location;
	protected $password;

	public function __construct( $input_location, $output_location, $password ) {

		$this->input_location = $input_location;
		$this->output_location = $output_location;
		$this->password = $password;

	}

	public function zip() {

		$command = $this->build_command();

		$process = new Process( $command );
		$process->run();

		if (!$process->isSuccessful()) {
			throw new \RuntimeException($process->getErrorOutput());
		}

	}

	protected function build_command() {

		return implode( "",

			array(

				'7za a -tzip \'-p',
				$this->password,
				'\' -mem=AES256 ',
				$this->output_location,
				' ',
				$this->input_location

			)

		);

	}

} 