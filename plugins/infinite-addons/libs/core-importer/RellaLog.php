<?php
/**
* Insert the import log inside text file so they can be used as for live log
*
*/
class RellaLog
{
	public $log_folder;
	public $log_file_name;
	public $log_progress_name;
	public $totalposts;
	public $imported;


	function __construct()
	{
		$this->log_file_name = 'import_log.txt';
		$this->log_progress_name = 'import_progress.txt';
		$this->log_folder = 'rella_log';
		$this->imported = 0;

	}
	public function run() {
		add_action( 'wp_ajax_rella_progress_imported', array($this, 'getProgress'), 10, 1 );
		add_action( 'wp_ajax_rella_total_imported', array($this, 'getImported'), 10, 1 );
		add_action( 'wp_ajax_rella_reset_logs', array($this, 'resetFiles'), 10, 1 );
		add_action( 'admin_footer', array( $this, 'loadingTpl'), 10, 1 );
	}

	public function loadingTpl(){
		echo '
		  <div id="rella-smily-loader">
		    <span class="text">'.esc_html__( 'Checking Requirement..', 'infinite-addons' ).'</span>
		    <div class="leftEye"></div>
		    <div class="rightEye"></div>
		    <div class="mouth"></div>
		  </div>';
	}

	public function getImported() {
		echo $this->getContent();
		die();
	}
	public function getProgress() {
		echo $this->getContent(true);
		die();
	}
	public function resetFiles() {
		$this->putContent('', true, true);
		die();
	}
	public function uploadDir($url = false) {
		$upload_dir = wp_upload_dir();
		$log_folder = $this->log_folder;
		$theme_import_log_folder = $upload_dir['basedir'].'/'.$log_folder;
		if(!file_exists($theme_import_log_folder)) {
			wp_mkdir_p( $theme_import_log_folder );
		}
		if($url) {
			return $upload_dir['baseurl'].'/'.$log_folder;
		} else {
			return $theme_import_log_folder;
		}
	}
	public function importedTotal($num = false) {
		if($num) {
			return $this->totalposts = $num;
		} else {
			return $this->totalposts;
		}
		
	}

	public function increace($num = false) {
		if($num) {
			return $this->imported += $num;
		} else {
			return $this->imported;
		}
	}
	public function importFile($filename = false) {
		if($filename) {
			return $this->uploadDir().'/'.$this->log_progress_name;
		} else {
			return $this->uploadDir().'/'.$this->log_file_name;
		}
		
	}
	public function getContent($file = false) {
		global $wp_filesystem;
		
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');WP_Filesystem();
		}
		return $wp_filesystem->get_contents($this->importFile($file));
	}

	public function putContent($content = '', $rest = false, $filename = false) {
		global $wp_filesystem;
		$import_file = $this->importFile($filename);
		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');WP_Filesystem();
		}
		if($rest) {
			$wp_filesystem->put_contents($import_file, "", 0644);
		}
		$old_content = $wp_filesystem->get_contents($import_file);
		if(!empty($content)) {
			$wp_filesystem->put_contents($import_file, $old_content."  ".$content, 0644);
		}
	}
}
?>