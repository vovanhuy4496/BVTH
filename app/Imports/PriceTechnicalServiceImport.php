<?php

namespace App\Imports;

use App\Models\PriceTechnicalService;
use Maatwebsite\Excel\Concerns\ToModel;

class PriceTechnicalServiceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $sort = PriceTechnicalService::max('sort');
        $sort = !isset($sort) ? 1 : $sort + 1;

        return new PriceTechnicalService([
            'name'     => $row[0],
            'group'    => $row[1],
            'unit'    => $row[2],
            'price'    => $row[3],
            'price_bhyt'    => $row[4],
            // 'name'     => 'Tên',
            // 'group'    => 'Nhóm',
            // 'unit'    => 'Đơn vị tính',
            // 'price'    => 'Giá bán hiện tại',
            // 'price_bhyt'    => 'Giá BHYT',
            'sort' => $sort
        ]);
    }
}
