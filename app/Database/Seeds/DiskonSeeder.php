<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $tanggal = new \DateTime('2025-07-01');
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'tanggal'    => $tanggal->format('Y-m-d'),
                'nominal'    => rand(50000, 150000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $tanggal->modify('+1 day');
        }

        $this->db->table('diskon')->insertBatch($data);
    }
}
