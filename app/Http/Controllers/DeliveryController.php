<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller {
    public function delivery(Request $request) {
        $city = City::orderBy('matp', 'ASC')->get();
        return view("admin.delivery.add_delivery")->with(compact("city"));
    }
    public function select_delivery(Request $request) {
        $data = $request->all();
        if($data['action']) {
            $output = '';
            if($data['action'] == 'city') {
                $select_district = District::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output .= '<option><--- Chọn quận huyện ---></option>';
                foreach($select_district as $key => $district) {
                    $output .= '<option value="'.$district->maqh.'">'.$district->name_quanhuyen.'</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
                $output .= '<option><--- Chọn xã phường/ thị trấn ---></option>';
                foreach($select_wards as $key => $ward) {
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
    public function add_delivery(Request $request) {
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->fee_matp = $data['city'];
        $feeship->fee_maqh = $data['district'];
        $feeship->fee_xaid = $data['wards'];
        $feeship->fee_feeship = $data['feeship'];
        $feeship->save();
    }
    public function select_feeship() {
        $feeship = Feeship::orderBy('fee_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên xã phường</th>
                        <th class="sticky-column">Phí ship</th>
                    </tr>
                </thead>
                <tbody>';
        foreach($feeship as $key => $fee) {
            $output .= '
                <tr>
                    <td>'.$fee->city->name_thanhpho.'</td>
                    <td>'.$fee->district->name_quanhuyen.'</td>
                    <td>'.$fee->wards->name_xaphuong.'</td>
                    <td contenteditable class="operation-buttons fee_feeship_edit" data-feeship_id="'.$fee->fee_id.'">'.number_format($fee->fee_feeship, 0, ',', '.').'</td>
                </tr>';
        }
        $output .= '
                </tbody>
            </table>
        </div>';
        echo $output;
    }
    public function update_feeship(Request $request) {
        $data = $request->all();
        $feeship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], '.');
        $feeship->fee_feeship = $fee_value;
        $feeship->save();
    }
}
