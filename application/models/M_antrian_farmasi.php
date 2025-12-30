<?php
class M_antrian_farmasi extends MY_Model
{
    function get_antrian_belumterpanggil_nonracik($tanggal)
    {
        // $this->db->select('ps.nm_pasien, ro.no_antri, af.no_resep, af.no_rawat, nm_poli, panggil, panggil_ulang');
        // $this->db->from('resep_obat ro');
        // $this->db->join('reg_periksa rp', "ro.no_rawat = rp.no_rawat AND stts_resep = 'Sudah Terlayani' AND ro.STATUS = 'ralan'");
        // $this->db->join('poliklinik pl', 'rp.kd_poli = pl.kd_poli');
        // $this->db->join('pasien ps', 'rp.no_rkm_medis = ps.no_rkm_medis');
        // $this->db->join('antrian_farmasi af', 'ro.no_resep = af.no_resep and ro.no_rawat = af.no_rawat and rp.no_rawat = af.no_rawat');
        // $this->db->join('obat_racikan orc', 'af.no_resep = orc.no_resep', 'left');
        // $this->db->or_group_start();
        // $this->db->where('DATE(ro.tgl_peresepan)', $tanggal);
        // $this->db->where('orc.no_resep is null', null, false);
        // $this->db->where('panggil', 0);
        // $this->db->group_end();
        // $this->db->or_group_start();
        // $this->db->where('DATE(ro.tgl_peresepan)', $tanggal);
        // $this->db->where('orc.no_resep is null', null, false);
        // $this->db->group_end();
        // // $this->db->group_by('ro.no_rawat');
        // $this->db->order_by('panggil_ulang', 'desc');
        // $this->db->order_by('af.id', 'desc');
        // $this->db->limit(4);
        
        
        // $this->db->select('ps.nm_pasien, af.no_antri, af.no_resep, af.no_rawat, nm_poli, panggil, panggil_ulang');
        // $this->db->from('antrian_farmasi af');
        // $this->db->join('poliklinik pl', "af.kd_poli = pl.kd_poli");
        // $this->db->join('pasien ps', 'af.no_rkm_medis = ps.no_rkm_medis');
        // $this->db->where('DATE(af.tgl_peresepan)', $tanggal);
        // $this->db->where('af.racikan', 0);
        // $this->db->order_by('panggil_ulang', 'desc');
        // $this->db->order_by('panggil', 'asc');
        // $this->db->order_by('af.id', 'desc');
        // $this->db->limit(4);
        
        
        $this->db->select('nm_pasien, no_antri, no_resep, no_rawat, nm_poli, panggil, panggil_ulang');
        $this->db->from('antrian_farmasi');
        // $this->db->where('DATE(tgl_peresepan)', $tanggal);
        $this->db->where('DATE(tgl_peresepan)', $tanggal);
        $this->db->where('racikan', 0);
        $this->db->order_by('panggil_ulang', 'desc');
        $this->db->order_by('panggil', 'asc');
        $this->db->order_by('id', 'desc');
        $this->db->limit(4);

        return
            $this->db->get()->result_array();
        // $this->lq();
    }

    function get_antrian_belumterpanggil_racik($tanggal)
    {
        // $this->db->select('ps.nm_pasien, ro.no_antri, af.no_resep, af.no_rawat, nm_poli, panggil, panggil_ulang');
        // $this->db->from('resep_obat ro');
        // $this->db->join('reg_periksa rp', "ro.no_rawat = rp.no_rawat AND stts_resep = 'Sudah Terlayani' AND ro.STATUS = 'ralan'");
        // $this->db->join('obat_racikan orc', 'ro.no_resep = orc.no_resep');
        // $this->db->join('poliklinik pl', 'rp.kd_poli = pl.kd_poli');
        // $this->db->join('pasien ps', 'rp.no_rkm_medis = ps.no_rkm_medis');
        // $this->db->join('antrian_farmasi af', 'ro.no_resep = af.no_resep and ro.no_rawat = af.no_rawat and rp.no_rawat = af.no_rawat');
        // $this->db->or_group_start();
        // $this->db->where('DATE(ro.tgl_peresepan)', $tanggal);
        // $this->db->where('panggil', 0);
        // $this->db->group_end();
        // $this->db->or_where('DATE(ro.tgl_peresepan)', $tanggal);
        // // $this->db->group_by('ro.no_rawat');
        // $this->db->order_by('panggil_ulang', 'desc');
        // $this->db->order_by('af.id', 'desc');
        // $this->db->limit(4);
        
        
        // $this->db->select('ps.nm_pasien, af.no_antri, af.no_resep, af.no_rawat, nm_poli, panggil, panggil_ulang');
        // $this->db->from('antrian_farmasi af');
        // $this->db->join('poliklinik pl', "af.kd_poli = pl.kd_poli");
        // $this->db->join('pasien ps', 'af.no_rkm_medis = ps.no_rkm_medis');
        // $this->db->where('DATE(af.tgl_peresepan)', $tanggal);
        // $this->db->where('af.racikan', 1);
        // $this->db->order_by('panggil_ulang', 'desc');
        // $this->db->order_by('panggil', 'asc');
        // $this->db->order_by('af.id', 'desc');
        // $this->db->limit(4);
        
        
        $this->db->select('nm_pasien, no_antri, no_resep, no_rawat, nm_poli, panggil, panggil_ulang');
        $this->db->from('antrian_farmasi');
        $this->db->where('DATE(tgl_peresepan)', $tanggal);
        $this->db->where('racikan', 1);
        $this->db->order_by('panggil_ulang', 'desc');
        $this->db->order_by('panggil', 'asc');
        $this->db->order_by('id', 'desc');
        $this->db->limit(4);

        return
            $this->db->get()->result_array();
        // $this->lq();
    }

    function upd_antrian_belumterpanggil($no_resep, $panggil_ulang)
    {
        $wkt_panggil = $panggil_ulang == 'tidak' ? 'wkt_panggil1' : 'wkt_panggil2';
        $query = "
            UPDATE antrian_farmasi 
            SET panggil = 1, panggil_ulang = 'tidak', $wkt_panggil = now()
            WHERE
                no_resep = '$no_resep';
        ";
        // prd($query);

        $this->db->query($query);
        // $this->lq(2);
    }

    function listResep($tgl_peresepan)
    {
        $this->db->select(
            'a.no_rawat,
            c.nm_dokter,
            d.nm_pasien,
            e.nm_poli,
            b.*,'
        );
        $this->db->from('reg_periksa a ');
        $this->db->join('resep_obat b', 'a.no_rawat = b.no_rawat');
        $this->db->join('pasien d', 'a.no_rkm_medis = d.no_rkm_medis');
        $this->db->join('dokter c', 'b.kd_dokter = c.kd_dokter');
        $this->db->join('poliklinik e', 'a.kd_poli = e.kd_poli');
        $this->db->where('b.status', 'ralan');
        $this->db->where('b.tgl_peresepan =', $tgl_peresepan);
        $this->db->where('b.stts_resep !=', 'Selesai');
        //TODO:
        $this->db->where('b.stts_resep !=', 'Batal');
        $this->db->where('b.status =', 'ralan');
        $this->db->where('a.kd_poli !=', 'IGDK');
        $this->db->where('a.kd_poli !=', 'M0033');
        $this->db->where('a.kd_poli !=', 'PL009');
        $this->db->group_by('a.no_rawat');
        $this->db->order_by('b.tgl_peresepan', 'ASC');
        $this->db->order_by('b.jam_peresepan','ASC');
        $this->db->limit(5);
        return $this->db->get();
    }
}