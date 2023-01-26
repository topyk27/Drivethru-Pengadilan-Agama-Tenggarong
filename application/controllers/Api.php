<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function produk($pihak,$no,$jenis,$tahun,$nama_pa)
    {
        $data = array(
            'pihak' => $pihak,
            'no' => $no,
            'jenis' => $jenis,
            'tahun' => $tahun,
            'nama_pa' => $nama_pa
        );
        redirect('https://web-pemula-ku.blogspot.com/p/shortener.html?'.http_build_query($data)."\n");
    }
}

?>