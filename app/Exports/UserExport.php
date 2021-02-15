<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, withHeadings {
    public function collection() {
        return User::with('myTeam')->get();
    }
    public function headings(): array {
        return [
            'ID','Name','Email','Phone','Instansi','Status','Alasan ikut DSW','Gender','Alamat',
            'LinkedIn','Medium','Tablue',
            'Sudah bergabung dengan DSI?','Tertarik bergabung dengan DSI?'
        ];
    }
    public function prepareRows($rows): array {
        return array_map(function($user) {
            $hasJoinedDSI = $user->has_joined_dsi == 1 ? "Sudah" : "Belum";
            $user->has_joined_dsi = $hasJoinedDSI;

            if ($user->interested_with_dsi == 1) {
                $interestedWithDSI = "Ya";
            }else if ($user->interested_with_dsi === 0) {
                $interestedWithDSI = "Tidak";
            }else {
                $interestedWithDSI = "";
            }
            $user->interested_with_dsi = $interestedWithDSI;
            $user->created_at = "";
            $user->updated_at = "";
            
            return $user;
        }, $rows);
    }
}