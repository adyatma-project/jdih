<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_Model extends CI_Model
{

	public function getLoginData($data)
	{
		$login['username'] = $data['username'];
		$login['password'] = md5($data['password'] . 'jdihlutra@xxxaseww21%^&^$#');
		$cek = $this->db->get_where('tbl_user_login', $login);
		if ($cek->num_rows() > 0) {
			foreach ($cek->result() as $qad) {
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['id_user'] = $qad->id_user_login;
				$sess_data['username'] = $qad->username;
				$sess_data['nama'] = $qad->nama_lengkap;
				$sess_data['stts'] = $qad->stts;
				$this->session->set_userdata($sess_data);
			}
			$id['id_user_login'] = $this->session->userdata('id_user');
			$upd['online'] = '1';
			$this->db->update("tbl_user_login", $upd, $id);

			header('location:' . base_url() . 'backend');
		} else {
			$this->session->set_flashdata('result_login', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<p align="center" style="font-size:12px">Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami</p>.
						</div>');
			header('location:' . base_url() . 'backend');
		}
	}
}

/* End of file app_login_model.php */
/* Location: ./application/models/app_login_model.php */