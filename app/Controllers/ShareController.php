<?php

namespace App\Controllers;

use App\Models\NomineeModel;
use App\Models\MemberModel;
use App\Models\ShareModel;
use Dompdf\Dompdf;
use Dompdf\Options;
class ShareController extends BaseController
{
    protected $memberModel;
    protected $shareModel;
    protected $nomineeModel;

    public function __construct()
    {
        $this->memberModel  = new MemberModel();
        $this->shareModel   = new ShareModel();
        $this->nomineeModel = new NomineeModel();
    }

    // ================= CREATE FORM =================
    public function create()
    {
        return view('share/sharecreation');
    }

    // ================= STORE SHARE + NOMINEES =================
    public function store()
    {
        $db = \Config\Database::connect();
        $db->transBegin();
         
         // ---------------- VALIDATION RULES ----------------
    $rules = [
        'customer_id'        => 'required',
        'share_value'        => 'required|decimal|greater_than[0]',
        'number_of_shares'   => 'required|integer|greater_than[0]',
        'share_amount'       => 'permit_empty|decimal',
        'share_fees'         => 'permit_empty|decimal',
        'entry_fees'         => 'permit_empty|decimal',
        'other_income'       => 'permit_empty|decimal',
        'building_fund'      => 'permit_empty|decimal',
        'total_income'       => 'permit_empty|decimal',
        'total_expense'      => 'permit_empty|decimal',
        'total'              => 'permit_empty|decimal',
        'receipt_no'         => 'permit_empty|max_length[50]',
        'certificate_number' => 'permit_empty|max_length[50]',
        'receipt_mode'       => 'required|in_list[cash,cheque]',
        'payment_status'     => 'required|in_list[paid,pending]',
        'transaction_detail' => 'permit_empty|max_length[255]',
    ];

        // GET ARRAYS
         $names        = (array) $this->request->getPost('nominee_name');
         $percentages  = (array) $this->request->getPost('nominee_percentage');

        // SAFETY CHECK
        if (empty($names) || empty($percentages)) {
        return redirect()->back()->with('error', 'Nominee details missing');
        }

        // CLEAN VALUES (important)
       $percentages = array_map('intval', $percentages);

        // VALIDATION
        $total = array_sum($percentages);

        if ($total !== 100) {
          return redirect()->back()
          ->with('error', 'Nominee percentage must be exactly 100%');
         }

    try {

            $customerId = $this->request->getPost('customer_id');

             if (!$customerId) {
            throw new \Exception('Customer ID is required');
        }

        // 🔴 CHECK EXISTING SHARE (CRITICAL FIX)
        $existingShare = $this->shareModel
            ->where('customer_id', $customerId)
            ->first();

        if ($existingShare) {
            return redirect()
                ->to(site_url('share/share_edit/' . $customerId))
                ->with('error', 'Share already exists for this customer. You can update it.');
        }


           // -------- SAVE SHARE --------
            $this->shareModel->insert([
                'customer_id'     => $customerId,
                'share_type'      => $this->request->getPost('share_type'),
                'membership_date' => $this->request->getPost('membership_date'),
                'lf_number'       => $this->request->getPost('lf_number'),
                'account_number'  => $this->request->getPost('account_number'),
                'resolution_date' => $this->request->getPost('resolution_date'),
                'other_details'   => $this->request->getPost('other_details'),
                'share_value'        => $this->request->getPost('share_value'),
               'number_of_shares'   => $this->request->getPost('number_of_shares'),
                'share_amount'       => $this->request->getPost('share_amount'),
                 'share_fees'         => $this->request->getPost('share_fees'),
                 'entry_fees'         => $this->request->getPost('entry_fees'),
                'other_income'       => $this->request->getPost('other_income'),
                'building_fund'      => $this->request->getPost('building_fund'),
                 'total_income'       => $this->request->getPost('total_income'),
                'total_expense'      => $this->request->getPost('total_expense'),
                  'total'              => $this->request->getPost('total'),
                'receipt_no'         => $this->request->getPost('receipt_no'),
               'certificate_number' => $this->request->getPost('certificate_number'),
                'receipt_mode'       => $this->request->getPost('receipt_mode'),
                'payment_status'     => $this->request->getPost('payment_status'),
               'transaction_detail' => $this->request->getPost('transaction_detail'),
            ]);

            // -------- NOMINEE DATA (ARRAY SAFE) --------
            $names       = (array) $this->request->getPost('nominee_name');
            $fathers     = (array) $this->request->getPost('nominee_father');
            $genders     = (array) $this->request->getPost('nominee_gender');
            $relations   = (array) $this->request->getPost('nominee_relation');
            $mobiles     = (array) $this->request->getPost('nominee_mobile');
            $ages        = (array) $this->request->getPost('nominee_age');
            $addresses   = (array) $this->request->getPost('nominee_address');
            $percentages = (array) $this->request->getPost('nominee_percentage');

            if (!empty($names)) {

                if (array_sum($percentages) != 100) {
                    throw new \Exception('Nominee percentage must be exactly 100%');
                }

                foreach ($names as $i => $name) {

                    if (empty($name)) {
                        continue;
                    }

                    $this->nomineeModel->insert([
                        'customer_id'      => $customerId,
                        'nominee_name'     => $name,
                        'nominee_father'   => $fathers[$i]     ?? null,
                        'nominee_gender'   => $genders[$i]     ?? null,
                        'nominee_relation' => $relations[$i]   ?? null,
                        'nominee_mobile'   => $mobiles[$i]     ?? null,
                        'nominee_age'      => $ages[$i]        ?? null,
                        'nominee_address'  => $addresses[$i]   ?? null,
                        'nominee_percentage' => $percentages[$i] ?? 0,
                    ]);
                }
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Share & Nominees saved successfully');

        } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // ================= AUTOCOMPLETE SEARCH =================
    public function searchCustomer()
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $term = $this->request->getGet('term');

        $customers = $this->memberModel
            ->select('customer_id, name')
            ->like('customer_id', $term)
            ->orLike('name', $term)
            ->limit(10)
            ->get()
            ->getResultArray();

        $result = [];

        foreach ($customers as $row) {
            $result[] = [
                'label' => $row['customer_id'] . ' - ' . $row['name'],
                'value' => $row['customer_id']
            ];
        }

        return $this->response->setJSON($result);
    }

    // ================= FETCH CUSTOMER =================
    public function getCustomer($customer_id)
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $data = $this->memberModel
            ->where('customer_id', $customer_id)
            ->first();

        return $this->response->setJSON($data);
    }

    // ================= SHARE LIST =================
    public function index()
{
    $builder = $this->shareModel->builder();
    $builder->select('shares.*, members.name AS customer_name');
    $builder->join('members', 'members.customer_id = shares.customer_id', 'left');
    $builder->orderBy('shares.id', 'DESC');

    $data['shares'] = $builder
        ->get($this->shareModel->perPage ?? 10)
        ->getResultArray();

    $data['pager'] = $this->shareModel->pager;
    $data['title'] = 'Share List';

    return view('share/sharecreationlist', $data);
}

    // ================= EXPORT CSV =================
   public function exportCsv()
{
    $shares = $this->shareModel->findAll();

    $filename = 'share_list_' . date('Ymd_His') . '.csv';

    $response = $this->response;
    $response->setHeader('Content-Type', 'text/csv');
    $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');

    $file = fopen('php://output', 'w');

    // CSV Header row
    fputcsv($file, [
        'ID',
        'Customer ID',
        
        'Share Type',
        'Number of Shares',
        'Account Number',
        'Total Share Amount'
    ]);

    if (!empty($shares)) {
        foreach ($shares as $row) {
            fputcsv($file, [
                $row['id'],
                $row['customer_id'],
               
                $row['share_type'],
                $row['number_of_shares'],
                $row['account_number'],
                $row['total'],
            ]);
        }
    }

    fclose($file);
    return $response;
}

    // ================= EXPORT PDF =================
    public function exportPdf()
{
    $data['shares'] = $this->shareModel->findAll();

    $html = view('share/share_pdf', $data);

    $options = new Options();
    $options->set('defaultFont', 'DejaVu Sans');
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $dompdf->stream(
        'share_list_' . date('Ymd_His') . '.pdf',
        ['Attachment' => true]
    );
}

    // ================= GET NOMINEES =================
 public function getNominees($customerId)
{
    $db = \Config\Database::connect();

    $nominees = $db->table('nominees')
        ->select('nominee_name, nominee_father, nominee_relation, nominee_percentage')
        ->where('customer_id', $customerId)
        ->get()
        ->getResultArray();

    return $this->response->setJSON($nominees);
}
    // EDIT PAGE
public function edit($customerId)
{
    // Fetch share using customer_id
    $share = $this->shareModel
        ->where('customer_id', $customerId)
        ->first();

    if (!$share) {
        return redirect()->back()->with('error', 'Share record not found');
    }

    // Fetch customer
    $customer = $this->memberModel
        ->where('customer_id', $customerId)
        ->first();

    // Fetch nominees (linked by customer_id)
    $nominees = $this->nomineeModel
        ->where('customer_id', $customerId)
        ->findAll();

    return view('share/share_edit', [
        'share'    => $share,
        'customer' => $customer,
        'nominees' => $nominees
    ]);
}
public function update($customerId)
{
    if (!$customerId) {
        return redirect()->back()->with('error', 'Customer ID missing');
    }

    // ---------- VALIDATION ----------
    $rules = [
        'share_value'      => 'required|decimal|greater_than[0]',
        'number_of_shares' => 'required|integer|greater_than[0]',
        'receipt_mode'     => 'required|in_list[cash,cheque]',
        'payment_status'   => 'required|in_list[paid,pending]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('error', implode('<br>', $this->validator->getErrors()));    }

    $db = \Config\Database::connect();
    $db->transBegin();

    try {
        // ---------- UPDATE SHARE ----------
        $this->shareModel
            ->where('customer_id', $customerId)
            ->set([
                'share_type'         => $this->request->getPost('share_type'),
                'membership_date'    => $this->request->getPost('membership_date'),
                'lf_number'          => $this->request->getPost('lf_number'),
                'account_number'     => $this->request->getPost('account_number'),
                'resolution_date'    => $this->request->getPost('resolution_date'),
                'other_details'      => $this->request->getPost('other_details'),
                'share_value'        => $this->request->getPost('share_value'),
                'number_of_shares'   => $this->request->getPost('number_of_shares'),
                'share_amount'       => $this->request->getPost('share_amount'),
                'share_fees'         => $this->request->getPost('share_fees'),
                'entry_fees'         => $this->request->getPost('entry_fees'),
                'other_income'       => $this->request->getPost('other_income'),
                'building_fund'      => $this->request->getPost('building_fund'),
                'total_income'       => $this->request->getPost('total_income'),
                'total_expense'      => $this->request->getPost('total_expense'),
                'total'              => $this->request->getPost('total'),
                'receipt_no'         => $this->request->getPost('receipt_no'),
                'certificate_number' => $this->request->getPost('certificate_number'),
                'receipt_mode'       => $this->request->getPost('receipt_mode'),
                'payment_status'     => $this->request->getPost('payment_status'),
                'transaction_detail' => $this->request->getPost('transaction_detail'),
            ])->update();

        // ---------- UPDATE NOMINEES ----------
         $names        = (array) $this->request->getPost('nominee_name');
         $fathers      = (array) $this->request->getPost('nominee_father');
          $genders      = (array) $this->request->getPost('nominee_gender');
           $relations    = (array) $this->request->getPost('nominee_relation');
            $mobiles      = (array) $this->request->getPost('nominee_mobile');
              $ages         = (array) $this->request->getPost('nominee_age');
                $addresses    = (array) $this->request->getPost('nominee_address');
                  $others       = (array) $this->request->getPost('nominee_other_details');
                    $percentages  = (array) $this->request->getPost('nominee_percentage');

if (!empty($names)) {

    $percentages = array_map('intval', $percentages);

    if (array_sum($percentages) !== 100) {
        throw new \Exception('Nominee percentage must be exactly 100%');
    }

    // 🔥 Delete old nominees
    $this->nomineeModel
        ->where('customer_id', $customerId)
        ->delete();

    foreach ($names as $i => $name) {

        if (empty($name)) continue;

        $this->nomineeModel->insert([
            'customer_id'        => $customerId,
            'nominee_name'       => $name,
            'nominee_father'     => $fathers[$i]    ?? null,
            'nominee_gender'     => $genders[$i]    ?? null,
            'nominee_relation'   => $relations[$i]  ?? null,
            'nominee_mobile'     => $mobiles[$i]    ?? null,
            'nominee_age'        => $ages[$i]       ?? null,
            'nominee_address'    => $addresses[$i]  ?? null,
            'nominee_other_details' => $others[$i]  ?? null,
            'nominee_percentage' => $percentages[$i],
        ]);
    }
}
        

        $db->transCommit();
        

         return redirect()->to('/share/sharecreationlist')
                         ->with('success', 'Share updated successfully');

    } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->back()->with('error', $e->getMessage());
    }
}

   // View Share Details
    public function viewPageShareCreation($customer_id = null)
    {
        $shareModel   = new ShareModel();
        $memberModel  = new MemberModel();
        $nomineeModel = new NomineeModel();

        // Fetch customer details
        $member = $memberModel->where('customer_id', $customer_id)->first();

        // Fetch share details
        $share = $shareModel->where('customer_id', $customer_id)->first();

        // Fetch nominee(s)
        $nominees = $nomineeModel->where('customer_id', $customer_id)->findAll();

        if (!$member || !$share) {
            return redirect()->back()->with('error', 'Customer or share details not found.');
        }

        $data = [
            'member'   => $member,
            'share'    => $share,
            'nominees' => $nominees
        ];

        return view('share/viewpagesharecreation', $data);
    }
   public function checkShareExists($customerId)
{ 
    $exists = $this->shareModel
        ->where('customer_id', $customerId)
        ->countAllResults();

    return $this->response->setJSON([
        'exists' => $exists > 0
    ]);
}

}