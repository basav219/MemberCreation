<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\PincodeModel;
use Dompdf\Dompdf;
use App\Models\NomineeModel;

class Member extends BaseController
{
    protected $memberModel;
    protected $pincodeModel;
    protected $nomineeModel;


    public function __construct()
    {
        // Ensure admin is logged in
        if (!session()->get('is_admin_logged_in')) {
            redirect()->to('/admin/login')->send();
            exit;
        }

        // Load models
        $this->memberModel = new MemberModel();
        $this->pincodeModel = new PincodeModel();
    }

    // -----------------------------
    // List Members with Pagination
    // -----------------------------
   public function list()
{
    $search   = $this->request->getGet('q');
    $role     = session()->get('role');
    $username = session()->get('username');

    $builder = $this->memberModel;

    // 🔐 ROLE BASED FILTER
    if ($role !== 'superadmin') {
        $builder = $builder->where('created_by', $username);
    }

    // 🔍 SEARCH
    if ($search) {
        $builder = $builder->groupStart()
                           ->like('customer_id', $search)
                           ->orLike('name', $search)
                           ->groupEnd();
    }

    $data = [
        'members' => $builder->paginate(10),
        'pager'   => $this->memberModel->pager,
        'search'  => $search,
    ];

    return view('member/list', $data);
}
    // -----------------------------
    // Show Create Member Form
    // -----------------------------
    public function create()
    {
          $data = [];
          $data['customer_id'] = $this->memberModel->generateCustomerId();
          return view('member/create',$data);
    }

    // -----------------------------
    // Store New Member
    // -----------------------------
    public function store()
    {
        helper(['form']);

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
            'occupation' => 'required',
            'religion' => 'required',
            'caste' => 'required',
            'permanent_address' => 'required',
            'marital_status' => 'required',
            'father' => 'required|alpha_space',
            'adhar' => 'required|exact_length[12]',
            'pan' => 'required',
             'dl_no' => 'permit_empty',
             'gst_no' => 'permit_empty',
            'passport_no' => 'permit_empty',
             'gas_consumer_no' => 'permit_empty',
             'gas_company' => 'permit_empty',
             'property_details' => 'permit_empty',
             'ration_card_type' => 'required',
            'rationcard_number' => 'required',
            'country' => 'required',
            'voter' => 'permit_empty',
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
            // Bank
            'dcc_adb_accountnumber' => 'permit_empty|numeric',
            'dcc_adb_ifsccode' => 'permit_empty|alpha_numeric',
            'other_accountnumber' => 'permit_empty|numeric',
            'other_ifsccode' => 'permit_empty|alpha_numeric',
        ];

        if (!$this->validate($rules)) {
            return view('member/create', [
                'validation' => $this->validator
            ]);
        }

        $data = $this->request->getPost();
         // 🔐 Track who created this member
             $data['created_by'] = session()->get('username');
        // If customer_id is empty, generate
          if (empty($data['customer_id'])) {
               $data['customer_id'] = $this->memberModel->generateCustomerId();
          }
    
                // Checkbox values
        $data['dcc_adb_rupaycard'] = $this->request->getPost('dcc_adb_rupaycard') ? 'yes' : 'no';
        $data['dcc_adb_cheque'] = $this->request->getPost('dcc_adb_cheque') ? 'yes' : 'no';
        $data['other_rupaycard'] = $this->request->getPost('other_rupaycard') ? 'yes' : 'no';
        $data['other_cheque'] = $this->request->getPost('other_cheque') ? 'yes' : 'no';

        // Photo upload
        if ($photo = $this->request->getFile('photo')) {
            if ($photo->isValid() && !$photo->hasMoved()) {
                $photoName = $photo->getRandomName();
                $photo->move('uploads/photos', $photoName);
                $data['photo'] = $photoName;
            }
        }

        // Signature upload
        if ($signature = $this->request->getFile('signature')) {
            if ($signature->isValid() && !$signature->hasMoved()) {
                $signName = $signature->getRandomName();
                $signature->move('uploads/signatures', $signName);
                $data['signature'] = $signName;
            }
        }

        // Insert
        if (!$this->memberModel->insert($data)) {
            dd($this->memberModel->errors());
        }

        

        session()->setFlashdata([
    'customer_id' => $data['customer_id'],
    'customer_name' => $data['name']
      ]);

         return redirect()->to('/member/success');;
    }

    // -----------------------------
    // Edit Member by ID
    // -----------------------------
    public function edit($id)
    {
        $data['member'] = $this->memberModel->find($id);

        if (!$data['member']) {
            return redirect()->back()->with('error', 'Member not found');
        }

        return view('member/edit', $data);
    }

    // -----------------------------
    // Update Member by ID
    // -----------------------------
    public function update($id)
    {
        helper(['form']);

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
            'occupation' => 'required',
            'religion' => 'required',
            'caste' => 'required',
            'permanent_address' => 'required',
            'marital_status' => 'required',
            'father' => 'required',
            'adhar' => 'required|exact_length[12]',
            'pan' => 'required',
            'country' => 'required',
            'photo' => 'permit_empty|is_image[photo]|max_size[photo,100]',
            'signature' => 'permit_empty|is_image[signature]|max_size[signature,100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('validation', $this->validator)
                             ->with('error', 'Please fill all required fields');
        }

        $data = $this->request->getPost();

        // Checkbox values
        $data['dcc_adb_rupaycard'] = $this->request->getPost('dcc_adb_rupaycard') ? 'yes' : 'no';
        $data['dcc_adb_cheque'] = $this->request->getPost('dcc_adb_cheque') ? 'yes' : 'no';
        $data['other_rupaycard'] = $this->request->getPost('other_rupaycard') ? 'yes' : 'no';
        $data['other_cheque'] = $this->request->getPost('other_cheque') ? 'yes' : 'no';

        // Photo upload
        if ($photo = $this->request->getFile('photo')) {
            if ($photo->isValid() && !$photo->hasMoved()) {
                $photoName = $photo->getRandomName();
                $photo->move('uploads/photos', $photoName);
                $data['photo'] = $photoName;
            }
        }

        // Signature upload
        if ($signature = $this->request->getFile('signature')) {
            if ($signature->isValid() && !$signature->hasMoved()) {
                $signName = $signature->getRandomName();
                $signature->move('uploads/signatures', $signName);
                $data['signature'] = $signName;
            }
        }

        $this->memberModel->update($id, $data);

        return redirect()->to('/member/list')
                         ->with('success', 'Member updated successfully');
    }

    // -----------------------------
    // Edit Member by Customer ID
    // -----------------------------
    public function editByCustomerId()
    {
        $customerId = $this->request->getPost('customer_id');
        $member = $this->memberModel->where('customer_id', $customerId)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Customer ID not found');
        }

        return redirect()->to('/member/edit/' . $member['id']);
    }

    // -----------------------------
    // Export CSV
    // -----------------------------
   public function exportCSV()
{
    if (!session()->get('is_admin_logged_in')) {
        return redirect()->to('/admin/login');
    }

    $role = session()->get('role');
    $username = session()->get('username');

    if ($role === 'superadmin') {
        // SuperAdmin gets all members
        $members = $this->memberModel->findAll();
    } elseif ($role === 'admin') {
        // Admin gets only members they created
        $members = $this->memberModel->where('created_by', $username)->findAll();
    } else {
        return redirect()->to('/admin/dashboard')->with('error', 'Access denied');
    }

    $filename = "members_" . date('Ymd_His') . ".csv";

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv");

    $file = fopen('php://output', 'w');
    fputcsv($file, ['ID','Customer ID','Name','Father/Husband','Mobile','Email','DOB','Address','Created By']);

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
            $row['created_by'],
        ]);
    }

    fclose($file);
    exit;
}
    // -----------------------------
    // Export PDF
    // -----------------------------
    public function exportPDF()
{
    if (!session()->get('is_admin_logged_in')) {
        return redirect()->to('/admin/login');
    }

    $role = session()->get('role');
    $username = session()->get('username');

    if ($role === 'superadmin') {
        $data['members'] = $this->memberModel->findAll();
    } elseif ($role === 'admin') {
        $data['members'] = $this->memberModel->where('created_by', $username)->findAll();
    } else {
        return redirect()->to('/admin/dashboard')->with('error', 'Access denied');
    }

    $html = view('member/member_pdf', $data);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('member_list.pdf', ['Attachment' => true]);
}

    // -----------------------------
    // AJAX: Fetch Location by Pincode
    // -----------------------------
    public function fetchLocationByPincode()
    {
        $pincode = $this->request->getGet('pincode');

        if (!$pincode || strlen($pincode) !== 6) {
            return $this->response->setJSON([]);
        }

        $row = $this->pincodeModel
                    ->select('area, taluk, district, state')
                    ->where('pincode', $pincode)
                    ->first();

        return $this->response->setJSON($row ?? []);
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
        $area = $this->request->getGet('area');

        $row = $this->pincodeModel
                    ->where('pincode', $pincode)
                    ->where('area', $area)
                    ->first();

        return $this->response->setJSON($row ?? []);
    }
    public function sharecreation()
    {
          return view('share/sharecreation');
    }

public function view($id)
{
    // 1️⃣ Get member
    $member = $this->memberModel->find($id);

    if (!$member) {
        return redirect()->back()->with('error', 'Member not found');
    }

    // 2️⃣ Get nominee using customer_id
    $nomineeModel = new NomineeModel();

    $nominee = $nomineeModel
        ->where('customer_id', $member['customer_id'])
        ->first();

    // 3️⃣ Send data to view
    return view('member/viewcustomer', [
        'member'  => $member,
        'nominee' => $nominee   // can be null, that's OK
    ]);
}
public function index()
{
    $memberModel = new \App\Models\MemberModel();

    // 👑 SUPERADMIN → see all
    if (session()->get('role') === 'superadmin') {
        $data['members'] = $memberModel->findAll();
    }
    // 👤 ADMIN → see only own records
    else {
        $data['members'] = $memberModel
            ->where('created_by', session()->get('username'))
            ->findAll();
    }

    return view('member/list', $data);
}

public function success()
{
    if (!session()->getFlashdata('customer_id')) {
        return redirect()->to('/member/create');
    }

    return view('member/success');
}

public function searchIntroducer()
{
    $q = $this->request->getGet('q');

    if (!$q || strlen($q) < 2) {
        return $this->response->setJSON([]);
    }

    $role     = session()->get('role');
    $username = session()->get('username');

    $builder = $this->memberModel
        ->select('customer_id, name, father, mobile')
        ->groupStart()
            ->like('customer_id', $q)
            ->orLike('name', $q)
        ->groupEnd();

    // 🔐 ROLE BASED FILTER
    if ($role !== 'superadmin') {
        $builder->where('created_by', $username);
    }

    $members = $builder
        ->limit(10)
        ->findAll();

    return $this->response->setJSON($members);
}
}