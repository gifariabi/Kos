<?php
// session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    // private $conn;
	function __construct(){
		parent::__construct();
		// $this->load->libraries('form_validation');

        $this->load->model('M_All');

		// $servername = "localhost";
		// $username = "root";
		// $password = "";
		// $db = "kost";
		// $this->conn = mysqli_connect($servername, $username, $password, $db);
	}

	public function index(){
		$data['artikel'] = $this->M_All->get('artikel')->result();

		// if (empty($_SESSION['pencari'])) {
  		// header("location: ".base_url());
		// } else{
		// 	$sql      		= "SELECT nama_pencari FROM pencari WHERE id_pencari = '$_SESSION[id_pencari]';";
        //     $data['nama']   = $this->conn->query($sql);
			
			// $sql      		= "SELECT * FROM kosan";
            // $data['result']   = $this->conn->query($sql);
			// $data['result'] = $this->M_All->get('kosan')->result();
		$data['result'] = $this->M_All->join('pemilik','kosan')->result();

		$this->load->view('home/head_home',$data);
		$this->load->view('home/konten', $data);
		$this->load->view('home/foot_home');
	}
	
	public function view_data_kos($id)
	{
		$where_ = array('kode_kos' => $id);
		$data['kos'] = $this->M_All->view_where('kosan', $where_)->row();
		$data['result'] = $this->M_All->view_where('kamar', $where_)->result();
		
		$this->load->view('home/head_home',$data);
		$this->load->view('home/kos', $data);
		$this->load->view('home/foot_home');
	}

		
	public function chat(){
		
		$this->load->view('home/head_home');
		$this->load->view('home/chat');
		$this->load->view('home/foot_home');
		// }
	}

	public function view_artikel($id)
	{
		$where = array('id_artikel' => $id, );
		$data['artikel'] = $this->M_All->view_where('artikel', $where)->row();
		$this->load->view('home/head_home');
		$this->load->view('home/view_artikel', $data);
		$this->load->view('home/foot_home');
	}

	public function login_pencari(){
		$this->load->view('login/head_login');
		$this->load->view('login/login_pencari');
		$this->load->view('login/foot_login');
	}
	
		public function forget(){
		$this->load->view('login/head_login');
		$this->load->view('login/forget');
		$this->load->view('login/foot_login');
	}
	public function resetpass(){
		$this->load->view('login/head_login');
		$this->load->view('login/resetpass');
		$this->load->view('login/foot_login');
	}



    public function login_pemilik(){
        $this->load->view('login/head_login');
        $this->load->view('login/login_pemilik');
        $this->load->view('login/foot_login');
    }

	public function login_admin(){
		$this->load->view('login/head_login');
		$this->load->view('login/login_admin');
		$this->load->view('login/foot_login');
	}

	public function registrasi_pencari(){
		$this->load->view('registrasi/head_regis');
		$this->load->view('registrasi/registrasi_pencari');
		$this->load->view('registrasi/foot_regis');
	}

	public function registrasi_pemilik(){
		$this->load->view('registrasi/head_regis');
		$this->load->view('registrasi/registrasi_pemilik');
		$this->load->view('registrasi/foot_regis');
	}

	public function registrasi_admin(){
		$this->load->view('registrasi/head_regis');
		$this->load->view('registrasi/registrasi_admin');
		$this->load->view('registrasi/foot_regis');
	}

    public function proses_login(){
        if (isset($_GET['admin'])) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $where = array(
                'password' => md5($password),
				'username' => $username,
            );

            $cek = $this->M_All->view_where('admin', $where)->num_rows();

            if ($cek > 0) {
                $data_session = array(
                    'username' => $username,
                    'admin' => 'admin',
                );

                $this->session->set_userdata($data_session);
                redirect(base_url('index.php/admin'));
            }else {
				echo "<script> alert('Username atau Password Salah'); </script>";
				$this->load->view('login/head_login');
				$this->load->view('login/login_admin');
				$this->load->view('login/foot_login');
            }
            // $sql      = "SELECT * FROM 'admin';";
            // $result   = $this->conn->query($sql);
            // while ($row=$result->fetch_assoc()) {
            //     if ($username==$row['username'] && md5($password)==$row['password']) {
            //         $_SESSION['username']=$row['username'];
            //         $_SESSION['admin']='admin';
            //         header("location: ".base_url('index.php/admin'));
            //         break;
            //     } else{
            //
            //     }
            // }
            if (empty($_SESSION['username'])) {
                    echo "<script> alert('Username atau Password Salah'); </script>";
                session_destroy();
                    header("location: ".base_url('index.php/Welcome/login_admin'));
            }
        }
        elseif (isset($_GET['pencari'])) {
            $id_pencari = $this->input->post('id_pencari');
            $password = $this->input->post('password');

            $where = array(
				'id_pencari' => $id_pencari,
                'password' => md5($password),
            );

            $cek = $this->M_All->view_where('pencari', $where)->num_rows();

            if ($cek > 0) {
                $data_session = array(
                    'id_pencari' => $id_pencari,
                    'pencari' => 'pencari',
                );

                $this->session->set_userdata($data_session);
                redirect(base_url('index.php/pencari'));
            }else {
				echo "<script> alert('Username atau Password Salah'); </script>";
				$this->load->view('login/head_login');
				$this->load->view('login/login_pencari');
				$this->load->view('login/foot_login');
            	// redirect(base_url('index.php/welcome/login_pencari'));
            }

            // $sql      = "SELECT * FROM pencari;";
            // $result   = $this->conn->query($sql);
            // while ($row=$result->fetch_assoc()) {
            //     if ($_POST['id_pencari']==$row['id_pencari'] && md5($_POST['password'])==$row['password']) {
            //         $_SESSION['id_pencari']=$row['id_pencari'];
            //         $_SESSION['pencari']='pencari';
            //         header("location: ".base_url('index.php/pencari'));
            //         break;
            //     } else{
            //
            //     }
            // }
            if (empty($_SESSION['id_pencari'])) {
                echo "<script> alert('Username atau Password Salah'); </script>";
                session_destroy();
                header("location: ".base_url('index.php/Welcome/login_pencari'));
            }
        } elseif (isset($_GET['pemilik'])) {
            $id_pemilik = $this->input->post('id_pemilik');
            $password = $this->input->post('password');

            $where = array(
                'password' => md5($password),
				'id_pemilik' => $id_pemilik,
            );

            $cek = $this->M_All->view_where('pemilik', $where)->num_rows();

            if ($cek > 0) {
                $data_session = array(
                    'id_pemilik' => $id_pemilik,
                    'pemilik' => 'pemilik',
                );

                $this->session->set_userdata($data_session);
                redirect(base_url('index.php/pemilik'));
            }else {
				echo "<script> alert('Username atau Password Salah'); </script>";
				$this->load->view('login/head_login');
				$this->load->view('login/login_pemilik');
				$this->load->view('login/foot_login');
            	// redirect(base_url('index.php/welcome/login_pemilik'));
            }

            // $sql      = "SELECT * FROM pemilik;";
            // $result   = $this->conn->query($sql);
            // while ($row=$result->fetch_assoc()) {
            //     if ($_POST['id_pemilik']==$row['id_pemilik'] && md5($_POST['password'])==$row['password']) {
            //         $_SESSION['id_pemilik']=$row['id_pemilik'];
            //         $_SESSION['pemilik']='pemilik';
            //         header("location: ".base_url('index.php/pemilik'));
            //         break;
            //     } else{
            //
            //     }
            // }
            if (empty($_SESSION['id_pemilik'])) {
                echo "<script> alert('Username atau Password Salah'); </script>";
                session_destroy();
                header("location: ".base_url('index.php/Welcome/login_pemilik'));
            }
        }
    }

	public function login_pilihan(){
		$this->load->view('home/login_pilihan');
	}

	public function regis_pilihan(){
		$this->load->view('home/regis_pilihan');
	}

	 // Insert Pencari
  	public function insert_pencari(){
		$config['upload_path']          = './asset_registrasi/upload_pencari/';
		$config['overwrite']        = true;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
			echo "<script> alert('Foto Gagal diunggah');</script>";
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
			if ($this->input->post('konfirmasi') == $this->input->post('password')) {
				$id_pencari = $this->input->post('id_pencari');
				$password = md5($this->input->post('password'));
				$nama_pencari = $this->input->post('nama_pencari');
				$instansi = $this->input->post('instansi');
				$tempat_lahir = $this->input->post('tempat_lahir');
				$tgl_lahir = $this->input->post('tgl_lahir');
				$asal_daerah = $this->input->post('asal_daerah');
				$no_ktp = $this->input->post('no_ktp');
				$status = $this->input->post('status');
				$jenis_kelamin = $this->input->post('jenis_kelamin');
				$email = $this->input->post('email');
				$no_telp = $this->input->post('no_telp');
				$no_telp_wali = $this->input->post('no_telp_wali');
				$foto = $this->upload->data('file_name');

				$data = array(
					'id_pencari' => $id_pencari,
					'password' => $password,
					'nama_pencari' => $nama_pencari,
					'instansi' => $instansi,
					'tempat_lahir' => $tempat_lahir,
					'tgl_lahir' => $tgl_lahir,
					'asal_daerah' => $asal_daerah,
					'no_ktp' => $no_ktp,
					'status' => $status,
					'jenis_kelamin' => $jenis_kelamin,
					'email' => $email,
					'no_telp' => $no_telp,
					'no_telp_wali' => $no_telp_wali,
					'foto' => $foto,
				);
				if ($this->M_All->insert('pencari', $data) != true) {
					redirect('index.php/welcome/login_pencari');
					echo "<script> alert('Akun Penghuni berhasil dibuat');</script>";
				}else{
					redirect('index.php/welcome/registrasi_pencari');
					echo "<script> alert('Akun Penghuni gagal dibuat');</script>";
				}
			} else {
				echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
				redirect('Welcome/registrasi_pencari');
			}
        }
		// $target_dir   = "././asset_registrasi/upload_pencari/"; // Untuk Foto
	    // $target_dir2   = "asset_registrasi/upload_pencari/"; // Untuk Foto
	    // $file_name    = basename($_FILES["foto"]["name"]); // Untuk Foto
	    // $target_file  = $target_dir . $file_name; // Untuk Foto
	    // $target_file2  = $target_dir2 . $file_name; // Untuk Foto
	    // $imageFileType  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // untuk foto
		//
	    // if (move_uploaded_file($_FILES["foto"]["tmp_name"],$target_file)) {
	    //   if ($_POST['password']==$_POST['konfirmasi']) {
	    //     $id_pencari = $_POST['id_pencari'];
	    //     $password = md5($_POST['password']);
	    //     $nama_pencari = $_POST['nama_pencari'];
	    //     $instansi = $_POST['instansi'];
	    //     $tempat_lahir = $_POST['tempat_lahir'];
	    //     $tgl_lahir = $_POST['tgl_lahir'];
	    //     $asal_daerah = $_POST['asal_daerah'];
	    //     $no_ktp = $_POST['no_ktp'];
	    //     $status = $_POST['status'];
	    //     $jenis_kelamin = $_POST['jenis_kelamin'];
	    //     $email = $_POST['email'];
	    //     $no_telp = $_POST['no_telp'];
	    //     $no_telp_wali = $_POST['no_telp_wali'];
	    //     $foto = $_FILES['foto'];
	    //     if ($foto='') {
	    //     } else{
	    //       $config['upload_path'] = './asset/upload_user';
	    //       $config['allowed_types'] = 'jpg|jpeg|png|gif';
	    //       $this->load->library('upload',$config);
	    //       if (!$this->upload->do_opload('foto')) {
	    //         echo "<script> alert('Foto Gagal diunggah');</script>"; die();
	    //       } else{
	    //         $foto=$this->upload->data('file_name');
	    //       }
	    //     }
	    //     $sql="INSERT INTO pencari VALUES ('$id_pencari', '$password', '$nama_pencari', '$instansi', '$tempat_lahir', '$tgl_lahir', '$asal_daerah', '$no_ktp', '$status', '$jenis_kelamin', '$email', '$no_telp', '$no_telp_wali', '$target_file2')";
	    //     $result=$this->conn->query($sql);
	    //     if ($result == true) {
	    //         echo "<script> alert('Akun Penghuni berhasil dibuat');</script>";
	    //     } else {
	    //         echo "<script> alert('Akun Penghuni gagal dibuat');</script>";
	    //     }
	    //     header("location: ".base_url('index.php/Welcome/login_pencari'));
	    //   } else {
	    //     echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
	    //     header("location: ".base_url('index.php/Welcome/registrasi_pencari'));
	    //   }
	    // } else {
	    //     echo "<script> alert('Foto Gagal diunggah');</script>";
	    //     header("location: ".base_url('index.php/Welcome/registrasi_pencari'));
	    // }
	    // mysqli_close($this->conn);

	}

	// Insert Pemilik
	public function insert_pemilik(){
		$config['upload_path']          = './asset_registrasi/upload_pemilik/';
		$config['overwrite']        = true;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
			echo "<script> alert('Foto Gagal diunggah');</script>";
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
			if ($this->input->post('konfirmasi') == $this->input->post('password')) {
				$id_pemilik = $this->input->post('id_pemilik');
				$password = md5($this->input->post('password'));
				$nama_pemilik = $this->input->post('nama_pemilik');
				$no_ktp = $this->input->post('no_ktp');
				$no_telp = $this->input->post('no_telp');
				$no_rek = $this->input->post('no_rek');
				$atas_nama_rek = $this->input->post('atas_nama_rek');
				$email = $this->input->post('email');
				$jenis_kelamin = $this->input->post('jenis_kelamin');
				$foto = $this->upload->data('file_name');

				$data = array(
					'id_pemilik' => $id_pemilik,
					'password' => $password,
					'nama_pemilik' => $nama_pemilik,
					'no_ktp' => $no_ktp,
					'no_telp' => $no_telp,
					'no_rek' => $no_rek,
					'atas_nama_rek' => $atas_nama_rek,
					'email' => $email,
					'jenis_kelamin' => $jenis_kelamin,
					'foto' => $foto,
				);
				if ($this->M_All->insert('pemilik', $data) != true) {
					redirect('index.php/welcome/login_pemilik');
					echo "<script> alert('Akun Pemilik berhasil dibuat');</script>";
				}else{
					redirect('index.php/welcome/registrasi_pemilik');
					echo "<script> alert('Akun Pemilik gagal dibuat');</script>";
				}
			} else {
				echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
				redirect('Welcome/registrasi_pemilik');
			}
        }
		// $target_dir   = "././asset_registrasi/upload_pemilik/"; // Untuk Foto
	    // $target_dir2   = "asset_registrasi/upload_pemilik/"; // Untuk Foto
	    // $file_name    = basename($_FILES["foto"]["name"]); // Untuk Foto
	    // $target_file  = $target_dir . $file_name; // Untuk Foto
	    // $target_file2  = $target_dir2 . $file_name; // Untuk Foto
	    // $imageFileType  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // untuk foto
		//
	    // if (move_uploaded_file($_FILES["foto"]["tmp_name"],$target_file)) {
	    //   if ($_POST['password']==$_POST['konfirmasi']) {
	        // $id_pemilik = $_POST['id_pemilik'];
	        // $nama_pemilik = $_POST['nama_pemilik'];
	        // $password = md5($_POST['password']);
	        // $no_ktp = $_POST['no_ktp'];
	        // $no_telp = $_POST['no_telp'];
	        // $email = $_POST['email'];
	        // $no_rek = $_POST['no_rek'];
	        // $atas_nama_rek = $_POST['atas_nama_rek'];
	        // $bank = $_POST['bank'];
	        // $jenis_kelamin = $_POST['jenis_kelamin'];
	        // $sql="INSERT INTO pemilik VALUES ('$id_pemilik', '$nama_pemilik', '$password', '$no_ktp', '$no_telp', '$email', '$no_rek', '$atas_nama_rek', '$bank', '$jenis_kelamin', '$target_file2')";
	        // $result=$this->conn->query($sql);
		//
	    //     if ($result == true) {
	    //         echo "<script> alert('Akun Pemilik berhasil dibuat');</script>";
	    //     } else {
	    //         echo "<script> alert('Akun Pemilik gagal dibuat');</script>";
	    //     }
	    //     header("location: ".base_url('index.php/Welcome/login_pemilik'));
		//
	    //   } else {
	    //     echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
	    //     header("location: ".base_url('index.php/Welcome/registrasi_pemilik'));
	    //   }
		//
	    // } else {
	    //     echo "<script> alert('Foto Gagal diunggah');</script>";
	    //     header("location: ".base_url('index.php/Welcome/registrasi_pemilik'));
	    // }
	    // mysqli_close($this->conn);
	}

	// Insert Admin
	public function insert_admin(){
		$config['upload_path']          = './asset_registrasi/upload_admin/';
		$config['overwrite']        = true;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
			echo "<script> alert('Foto Gagal diunggah');</script>";
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
			if ($this->input->post('konfirmasi') == $this->input->post('password')) {
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$nama_admin = $this->input->post('nama_admin');
				$no_telp = $this->input->post('no_telp');
				$email = $this->input->post('email');
				$foto = $this->upload->data('file_name');

				$data = array(
					'username' => $username,
					'password' => $password,
					'nama_admin' => $nama_admin,
					'no_telp' => $no_telp,
					'email' => $email,
					'foto' => $foto,
				);
				if ($this->M_All->insert('admin', $data) != true) {
					redirect('index.php/welcome/login_admin');
					echo "<script> alert('Akun Admin berhasil dibuat');</script>";
				}else{
					redirect('index.php/welcome/registrasi_admin');
					echo "<script> alert('Akun Admin gagal dibuat');</script>";
				}
			} else {
				echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
				redirect('Welcome/registrasi_admin');
			}
        }

		// $target_dir   = "././asset_registrasi/upload_admin/"; // Untuk Foto
	    // $target_dir2   = "asset_registrasi/upload_admin/"; // Untuk Foto
	    // $file_name    = basename($_FILES["foto"]["name"]); // Untuk Foto
	    // $target_file  = $target_dir . $file_name; // Untuk Foto
	    // $target_file2  = $target_dir2 . $file_name; // Untuk Foto
	    // $imageFileType  = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // untuk foto
		//
	    // if (move_uploaded_file($_FILES["foto"]["tmp_name"],$target_file)) {
	    //   if ($_POST['password']==$_POST['konfirmasi']) {
	    //     $username = $_POST['username'];
	    //     $password = md5($_POST['password']);
	    //     $nama_admin = $_POST['nama_admin'];
	    //     $email = $_POST['email'];
	    //     $no_telp = $_POST['no_telp'];
	    //     $sql="INSERT INTO admin VALUES ('$username', '$password', '$nama_admin', '$email', '$no_telp', '$target_file2')";
	    //     $result=$this->conn->query($sql);
	    //     if ($result == true) {
	    //         echo "<script> alert('Akun Admin berhasil dibuat');</script>";
	    //     } else {
	    //         echo "<script> alert('Akun Admin gagal dibuat');</script>";
	    //     }
	    //     header("location: ".base_url('index.php/Welcome/login_admin'));
		//
	    //   } else {
	    //     echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
	    //     header("location: ".base_url('index.php/Welcome/registrasi_admin'));
	    //   }
	    // } else {
	    //   echo "<script> alert('Foto Gagal diunggah');</script>";
	    //     header("location: ".base_url('index.php/Welcome/registrasi_admin'));
	    // }
	    // mysqli_close($this->conn);
	}

	function Logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php/welcome'));
  	}

}
