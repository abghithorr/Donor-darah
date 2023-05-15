<?php

namespace App\Exports;

use App\Models\Darah;
use App\Models\Response;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; 

class darahExport implements FromCollection, WithHeadings, WithMapping 
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Darah::with('response')->orderBy('created_at', 'DESC')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Umur',
            'No_Telp',
            'Berat',
            'Gol.Darah',
            'Status',
            'Jadwal',
        ];
    }

    public function map($item): array
    {
        if($item->response){
            if($item->response['status' == 'ditolak']){
                $jadwal= '-';
            }else{
                $jadwal = $item->response['jadwal'];
            }
        }
        else{
            $jadwal = '-';
        }
        return[
            $item->nama,
            $item->email,
            $item->umur,
            $item->no_telp,
            $item->berat,
            $item->darah,
            $item->response ? $item->response['status'] : '-',
            $jadwal,
            // \Carbon\Carbon::parse($item->created_at)->format('j-F-Y'),
        ];
    }
}
