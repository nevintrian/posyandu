<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwalibu_model extends MY_Model
{
    protected $table = "jadwalibu";

    function __construct()
    {
        parent::__construct($this->table);
        parent::set_join_key('jadwalibu_id');
    }

    /**
     * create
     *
     * @param array  $data
     * @return static
     * @author madukubah
     */
    public function create($data)
    {
        // Filter the data passed
        $data = $this->_filter_data($this->table, $data);

        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id($this->table . '_id_seq');

        if (isset($id)) {
            $this->set_message("berhasil");
            return $id;
        }
        $this->set_error("gagal");
        return FALSE;
    }
    /**
     * update
     *
     * @param array  $data
     * @param array  $data_param
     * @return bool
     * @author madukubah
     */
    public function update($data, $data_param)
    {
        $this->db->trans_begin();
        $data = $this->_filter_data($this->table, $data);

        $this->db->update($this->table, $data, $data_param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $this->set_error("gagal");
            return FALSE;
        }

        $this->db->trans_commit();

        $this->set_message("berhasil");
        return TRUE;
    }
    /** 
     * delete
     *
     * @param array  $data_param
     * @return bool
     * @author madukubah
     */
    public function delete($data_param)
    {
        //foreign
        //delete_foreign( $data_param. $models[]  )
        // if (!$this->delete_foreign($data_param, [''])) {
        //     $this->set_error("gagal"); //('group_delete_unsuccessful');
        //     return FALSE;
        // }
        //foreign
        $this->db->trans_begin();

        $this->db->delete($this->table, $data_param);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $this->set_error("gagal"); //('group_delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->set_message("berhasil"); //('group_delete_successful');
        return TRUE;
    }

    /**
     * group
     *
     * @param int|array|null $id = id_groups
     * @return static
     * @author madukubah
     */
    public function jadwalibu($id = NULL)
    {
        if (isset($id)) {
            $this->where($this->table . '.id', $id);
        }

        $this->limit(1);
        $this->order_by($this->table . '.id', 'desc');

        $this->jadwalibus();

        return $this;
    }
    /**
     * groups
     *
     *
     * @return static
     * @author madukubah
     */
    public function jadwalibus($start = 0, $limit = NULL)
    {
        if (isset($limit)) {
            $this->limit($limit);
        }
        $this->select($this->table . '.*');
        $this->select('jeniskegiatan.name AS jeniskegiatan_name');
        $this->select('imunisasiibu.name AS imunisasiibu_name');
        $this->select('penyuluhanibu.name AS penyuluhanibu_name');
        $this->join(
            'jeniskegiatan',
            'jeniskegiatan.id = jadwalibu.jeniskegiatan_id',
            'inner'
        );
        $this->join(
            'imunisasiibu',
            'imunisasiibu.id = jadwalibu.imunisasiibu_id',
            'inner'
        );
        $this->join(
            'penyuluhanibu',
            'penyuluhanibu.id = jadwalibu.penyuluhanibu_id',
            'inner'
        );
        $this->offset($start);
        $this->order_by($this->table . '.id', 'asc');
        return $this->fetch_data();
    }
}
