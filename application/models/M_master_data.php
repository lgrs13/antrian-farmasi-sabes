<?php
class M_master_data extends CI_Model {

    public function get_list_poliklinik() {

        $this->db->select('a.kd_poli, a.nm_poli');
        $this->db->from('poliklinik a');
        $this->db->where('a.status', '1');
        $this->db->order_by('a.nm_poli');
        return $this->db->get()->result();
    }

    public function get_list_dokter() {

        $this->db->select('a.kd_dokter, a.nm_dokter');
        $this->db->from('dokter a');
        $this->db->where('a.status', '1');
        $this->db->order_by('a.nm_dokter');
        return $this->db->get()->result();
    }

    public function get_list_poliklinik_lantai() {

        $this->db->select('a.id, a.kd_poli, b.nm_poli, a.kd_dokter, c.nm_dokter, a.poli_lantai');
        $this->db->from('poliklinik_lantai a');
        $this->db->join('poliklinik b', 'a.kd_poli = b.kd_poli');
        $this->db->join('dokter c', 'a.kd_dokter = c.kd_dokter');
        $this->db->order_by('a.poli_lantai');
        $this->db->order_by('b.nm_poli');
        $this->db->order_by('c.nm_dokter');
        return $this->db->get()->result();
    }

    public function get_poliklinik_lantai_by_kdpoli_kddokter($kd_poli, $kd_dokter) {

        $this->db->select('a.id');
        $this->db->from('poliklinik_lantai a');
        $this->db->where('a.kd_poli', $kd_poli);
        $this->db->where('a.kd_dokter', $kd_dokter);
        return $this->db->get()->row();
    }

    public function update_poliklinik_lantai($data, $kd_poli, $kd_dokter) {

        $this->db->where('kd_poli', $kd_poli);
        $this->db->where('kd_dokter', $kd_dokter);
        $this->db->update('poliklinik_lantai', $data);
    }

    public function delete_poliklinik_lantai($kd_poli, $kd_dokter, $lantai) {

        $this->db->where('kd_poli', $kd_poli);
        $this->db->where('kd_dokter', $kd_dokter);
        $this->db->where('poli_lantai', $lantai);
        $this->db->delete('poliklinik_lantai');
    }

    public function post_poliklinik_lantai($data) {

        $this->db->insert('poliklinik_lantai', $data);
    }

    public function get_detail_poliklinik($kd_poli) {

        $this->db->select('a.nm_poli');
        $this->db->from('poliklinik a');
        $this->db->where('a.kd_poli', $kd_poli);
        return $this->db->get()->row();
    }

    public function get_detail_dokter($kd_dokter) {

        $this->db->select('a.nm_dokter');
        $this->db->from('dokter a');
        $this->db->where('a.kd_dokter', $kd_dokter);
        return $this->db->get()->row();
    }
}
?>