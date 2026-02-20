<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\PincodeModel;
use Dompdf\Dompdf;
class Member extends BaseController
{
    
    public function __construct()
    {
        if (!session()->get('is_admin_logged_in')) {
            redirect()->to('/admin/login')->send();
            exit;
        }
          // ✅ LOAD PINCODE MODEL
        $this->pincodeModel = new PincodeModel();
    }
    public function list()
{
    $model = new \App\Models\MemberModel();

    // Get search query
    $search = $this->request->getGet('q');

    
    $data = [
        'members' => $model->paginate(10), // records per page
        'pager'   => $model->pager,
        'search'  => $search,             // pass back to search bar
    ];

    return view('member/list', $data);
}
    public function create()
    {
        return view('member/create'); // Mamber creation page
    }

    public function store()
    {
    helper(['form']);

    // ✅ VALIDATION RULES (MATCH DB NOT NULL COLUMNS)
    $rules = [
    'customer_id' => 'required',
    'member_code' => 'required',
    'title' => 'required',
    'name' => 'required|min_length[3]|alpha_space',
    'dob' => 'required|valid_date',
    'age' => 'required|numeric',
    'mobile' => 'required|numeric|exact_length[10]',
    'email' => 'required|valid_email',
    'gender' => 'required',
    'residential_address' => 'required',
    'pincode' => 'required|numeric|exact_length[6]',
    'city' => 'required',
    // 'area' => 'required',
    // 'taluk' => 'required',
    // 'district' => 'required',
    // 'state' => 'required',
    'dl_no' => 'permit_empty',
    'gst_no' => 'permit_empty',
    'passport_no' => 'permit_empty',
    'gas_consumer_no' => 'permit_empty',
    'gas_company' => 'permit_empty',
    'property_details' => 'permit_empty',
    'occupation' => 'required',
    'religion' => 'required',
    'caste' => 'required',
    'permanent_address' => 'required',
    'marital_status' => 'required',
    'ration_card_type' => 'required',
    'rationcard_number' => 'required',
    'father' => 'required|alpha_space',
    'adhar' => 'required|exact_length[12]',
    'pan' => 'required',
    'country' => 'required',
    'voter' => 'required',
    'photo' => 'uploaded[photo]|max_size[photo,100]|is_image[photo]',
    'signature' => 'uploaded[signature]|max_size[signature,100]|is_image[signature]',
    
    // Nominee
    'nominee_name' => 'permit_empty|min_length[3]',
    'nominee_age' => 'permit_empty|numeric|less_than_equal_to[60]',
    'nominee_mobile' => 'permit_empty|numeric|exact_length[10]',
    'nominee_adhar' => 'permit_empty|numeric|exact_length[12]',
    'nominee_father' => 'permit_empty',
    'nominee_gender' => 'permit_empty',
    'nominee_relation' => 'permit_empty',
    'nominee_address' => 'permit_empty',
    
    // Bank fields
    'dcc_adb_accountnumber' => 'permit_empty|numeric',
    'dcc_adb_ifsccode' => 'permit_empty|alpha_numeric',
    'other_accountnumber' => 'permit_empty|numeric',
    'other_ifsccode' => 'permit_empty|alpha_numeric',
    ];

    // ❌ STOP IF VALIDATION FAILS
    if (!$this->validate($rules)) {
        return view('member/create', [
            'validation' => $this->validator
        ]);
    }

    // ✅ GET ALL POST DATA
    $data = $this->request->getPost();

  
    // ✅ ENUM CHECKBOX VALUES (MUST BE yes / no)
    $data['dcc_adb_rupaycard'] = $this->request->getPost('dcc_adb_rupaycard') ? 'yes' : 'no';
    $data['dcc_adb_cheque']   = $this->request->getPost('dcc_adb_cheque') ? 'yes' : 'no';
    $data['other_rupaycard']  = $this->request->getPost('other_rupaycard') ? 'yes' : 'no';
    $data['other_cheque']     = $this->request->getPost('other_cheque') ? 'yes' : 'no';

    // ✅ PHOTO UPLOAD
    $photo = $this->request->getFile('photo');
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move('uploads/photos', $photoName);
        $data['photo'] = $photoName;
    }

    // ✅ SIGNATURE UPLOAD
    $signature = $this->request->getFile('signature');
    if ($signature && $signature->isValid() && !$signature->hasMoved()) {
        $signName = $signature->getRandomName();
        $signature->move('uploads/signatures', $signName);
        $data['signature'] = $signName;
    }

    // ✅ INSERT DATA
    $model = new \App\Models\MemberModel();

    if (!$model->insert($data)) {
        // SHOW DB ERROR IF ANY
        dd($model->errors());
    }

    // ✅ SUCCESS
    return redirect()->to('/member/create')
        ->with('success', 'Member Created Successfully');
}
   public function index()
{
    $model = new MemberModel();
    $data['members'] = $model->findAll();
    return view('member/list', $data);
}
    public function edit($id)
    {
    $model = new \App\Models\MemberModel();
    $data['member'] = $model->find($id);

    return view('member/edit', $data);
}
   public function update($id)
{
    $model = new \App\Models\MemberModel();

    //  Validation rules
    $rules = [
    'customer_id' => 'required',
    'member_code' => 'required',
    'title' => 'required',
    'name' => 'required|min_length[3]',
    'dob' => 'required|valid_date',
    'age' => 'required|numeric',
    'mobile' => 'required|numeric|exact_length[10]',
    'email' => 'required|valid_email',
    'gender' => 'required',
    'residential_address' => 'required',
    'pincode' => 'required|numeric|exact_length[6]',
    'city' => 'required',
    'area' => 'required',
    'taluk' => 'required',
    'district' => 'required',
    'state' => 'required',
    'dl_no' => 'permit_empty',
    'gst_no' => 'permit_empty',
    'passport_no' => 'permit_empty',
    'gas_consumer_no' => 'permit_empty',
    'gas_company' => 'permit_empty',
    'property_details' => 'permit_empty',
    'occupation' => 'required',
    'religion' => 'required',
    'caste' => 'required',
    'permanent_address' => 'required',
    'marital_status' => 'required',
    'ration_card_type' => 'required',
    'rationcard_number' => 'required',
    'father' => 'required',
    'adhar' => 'required|exact_length[12]',
    'pan' => 'required',
    'country' => 'required',
    'voter' => 'permit_empty',
   'photo' => 'permit_empty|is_image[photo]|max_size[photo,100]',
   'signature' => 'permit_empty|is_image[signature]|max_size[signature,100]',
    // Nominee
    'nominee_name' => 'permit_empty|min_length[3]',
    'nominee_age' => 'permit_empty|numeric|less_than_equal_to[60]',
    'nominee_mobile' => 'permit_empty|numeric|exact_length[10]',
    'nominee_adhar' => 'permit_empty|numeric|exact_length[12]',
    'nominee_father' => 'permit_empty',
    'nominee_gender' => 'permit_empty',
    'nominee_relation' => 'permit_empty',
    'nominee_address' => 'permit_empty',
    
    // Bank fields
    'dcc_adb_accountnumber' => 'permit_empty|numeric',
    'dcc_adb_ifsccode' => 'permit_empty|alpha_numeric',
    'other_accountnumber' => 'permit_empty|numeric',
    'other_ifsccode' => 'permit_empty|alpha_numeric',
    
   ];

    // Stop update if validation fails
    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('validation', $this->validator)
            ->with('error', 'Please fill all required fields before updating.');
    }
      $data = $this->request->getPost();

    // Checkbox Enums
    $data['dcc_adb_rupaycard'] = $this->request->getPost('dcc_adb_rupaycard') ? 'yes' : 'no';
    $data['dcc_adb_cheque']    = $this->request->getPost('dcc_adb_cheque') ? 'yes' : 'no';
    $data['other_rupaycard']   = $this->request->getPost('other_rupaycard') ? 'yes' : 'no';
    $data['other_cheque']      = $this->request->getPost('other_cheque') ? 'yes' : 'no';
    //  Only runs if all fields are filled
    $data = [
    'customer_id' => $this->request->getPost('customer_id'),
    'member_code' => $this->request->getPost('member_code'),
    'title' => $this->request->getPost('title'),
    'name' => $this->request->getPost('name'),
    'dob' => $this->request->getPost('dob'),
    'age' => $this->request->getPost('age'),
    'gender' => $this->request->getPost('gender'),
    'mobile' => $this->request->getPost('mobile'),
    'email' => $this->request->getPost('email'),
    'residential_address' => $this->request->getPost('residential_address'),
    'permanent_address' => $this->request->getPost('permanent_address'),
    'pincode' => $this->request->getPost('pincode'),
    'area' => $this->request->getPost('area'),
    'city' => $this->request->getPost('city'),
    'taluk' => $this->request->getPost('taluk'),
    'district'=> $this->request->getPost('district'),
    'state' => $this->request->getPost('state'),
    'country' => $this->request->getPost('country'),
    'father' => $this->request->getPost('father'),
    'dl_no' => $this->request->getPost('dl_no'),
    'gst_no' => $this->request->getPost('gst_no'),
    'passport_no' => $this->request->getPost('passport_no'),
    'gas_consumer_no' => $this->request->getPost('gas_consumer_no'),
    'gas_company' => $this->request->getPost('gas_company'),
    'property_details' => $this->request->getPost('property_details'),
    'occupation' => $this->request->getPost('occupation'),
    'religion' => $this->request->getPost('religion'),
    'caste' => $this->request->getPost('caste'),
    'marital_status' => $this->request->getPost('marital_status'),
    'ration_card_type' => $this->request->getPost('ration_card_type'),
    'rationcard_number' => $this->request->getPost('rationcard_number'),
    'voter' => $this->request->getPost('voter'),

    // Nominee
    'nominee_name' => $this->request->getPost('nominee_name'),
    'nominee_father' => $this->request->getPost('nominee_father'),
    'nominee_gender' => $this->request->getPost('nominee_gender'),
    'nominee_relation' => $this->request->getPost('nominee_relation'),
    'nominee_age' => $this->request->getPost('nominee_age'),
    'nominee_mobile' => $this->request->getPost('nominee_mobile'),
    'nominee_adhar' => $this->request->getPost('nominee_adhar'),
    'nominee_address' => $this->request->getPost('nominee_address'),
    'nominee_other_details' => $this->request->getPost('nominee_other_details'),

    // Bank
    'dcc_adb_bankname' => $this->request->getPost('dcc_adb_bankname'),
    'dcc_adb_accountnumber' => $this->request->getPost('dcc_adb_accountnumber'),
    'dcc_adb_ifsccode' => $this->request->getPost('dcc_adb_ifsccode'),
    'dcc_adb_branchname' => $this->request->getPost('dcc_adb_branchname'),
    'dcc_adb_rupaycard' => $data['dcc_adb_rupaycard'],
    'dcc_adb_cheque' => $data['dcc_adb_cheque'],

    'other_bankname' => $this->request->getPost('other_bankname'),
    'other_accountnumber' => $this->request->getPost('other_accountnumber'),
    'other_ifsccode' => $this->request->getPost('other_ifsccode'),
    'other_branchname' => $this->request->getPost('other_branchname'),
    'other_rupaycard' => $data['other_rupaycard'],
    'other_cheque' => $data['other_cheque'],
];
    // Photo update 
    $photo = $this->request->getFile('photo');
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move('uploads/photos', $photoName);
        $data['photo'] = $photoName;
    }

    //  Signature update 
    $signature = $this->request->getFile('signature');
    if ($signature && $signature->isValid() && !$signature->hasMoved()) {
        $signName = $signature->getRandomName();
        $signature->move('uploads/signatures', $signName);
        $data['signature'] = $signName;
    }

    // Update only after validation success
    $model->update($id, $data);

    return redirect()->to('/member/list')
        ->with('success', 'Member updated successfully');
}
public function editByCustomerId()
{
    $customerId = $this->request->getPost('customer_id');

    $memberModel = new MemberModel();

    $member = $memberModel->where('customer_id', $customerId)->first();

    if (!$member) {
        return redirect()->back()
            ->with('error', 'Customer ID not found');
    }

    // 🔁 Redirect to existing EDIT page
    return redirect()->to('member/edit/' . $member['id']);
}


public function exportCSV()
{
    $memberModel = new \App\Models\MemberModel();
    $members = $memberModel->findAll();

    $filename = "members_" . date('Ymd_His') . ".csv";

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv");

    $file = fopen('php://output', 'w');

    // CSV Header
    fputcsv($file, [
        'ID',
        'Customer ID',
        'Name',
        'Father/Husband',
        'Mobile',
        'Email',
        'DOB',
        'Address'
    ]);

    foreach ($members as $row) {
        fputcsv($file, [
            $row['id'],
            $row['customer_id'],
            $row['name'],
            $row['father'],
            $row['mobile'],
            $row['email'],
            $row['dob'],
            $row['residential_address'],
        ]);
    }

    fclose($file);
    exit;
}

public function exportPDF()
{
    $memberModel = new \App\Models\MemberModel();
    $data['members'] = $memberModel->findAll();

    $html = view('member/member_pdf', $data);

    $dompdf = new Dompdf();   // ✅ works now
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $dompdf->stream('member_list.pdf', ['Attachment' => true]);
}
//Introducer Serch
public function searchIntroducer()
{
    $q = $this->request->getGet('q');

    $model = new \App\Models\MemberModel();

    return $this->response->setJSON(
        $model->like('customer_id', $q)
              ->orLike('name', $q)
              ->findAll(10)
    );
}
//Pincode Search
public function fetchLocationByPincode()
{
    $pincode = $this->request->getGet('pincode');

    if (!$pincode || strlen($pincode) !== 6) {
        return $this->response->setJSON([]);
    }

    $data = $this->pincodeModel
        ->select('area, taluk, district, state')
        ->where('pincode', $pincode)
        ->first();

    return $this->response->setJSON($data ?? []);
}

// Fetch multiple areas by pincode
public function fetchAreasByPincode()
{
    $pincode = $this->request->getGet('pincode');

    if (!$pincode || strlen($pincode) !== 6) {
        return $this->response->setJSON([]);
    }

    $rows = $this->pincodeModel
        ->where('pincode', $pincode)
        ->findAll();

    return $this->response->setJSON($rows);
}


// Fetch full location by pincode + area
public function fetchLocationByArea()
{
    $pincode = $this->request->getGet('pincode');
    $area    = $this->request->getGet('area');

    $row = $this->pincodeModel
        ->where('pincode', $pincode)
        ->where('area', $area)
        ->first();

    return $this->response->setJSON($row ?? []);
}

 
}
  