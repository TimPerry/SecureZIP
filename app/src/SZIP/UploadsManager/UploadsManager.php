<?php

	namespace SZIP\UploadsManager;

	use Symfony\Component\Filesystem\Filesystem;

	class UploadsManager {

		protected $files;
		protected $fileSystem;
		protected $uploadDirectory;

		public function __construct( $files, Filesystem $filesystem, $upload_directory ) {

			$this->files = $files;
			$this->fileSystem = $filesystem;
			$this->uploadDirectory = $upload_directory;

		}

		public function processUploads() {

			$fs = $this->fileSystem;

			if( ! $fs->exists( $this->uploadDirectory ) ) {
				$fs->mkdir( $this->uploadDirectory );
			}

			foreach ($this->files as $file) {

				$file->move( $this->uploadDirectory, $file->getClientOriginalName());

			}

		}

	}