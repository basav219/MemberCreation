<?php

namespace App\Controllers;

use App\Models\MemberModel;

class Member extends BaseController
{
    public function create()
    {
        return view('member/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'customer_id' => 'required',
            'member_code' => 'required',
            'name'        => 'required|min_length[3]',
            'dob'         => 'required|valid_date',
            'mobile'      => 'required|numeric|exact_length[10]',
            'email'       => 'permit_empty|valid_email',
            'photo'       => 'uploaded[photo]|max_size[photo,2048]|is_image[photo]',
            'signature'   => 'uploaded[signature]|max_size[signature,2048]|is_image[signature]'
        ];
        

        if (!$this->validate($rules)) {
            return view('member/create', [
                'validation' => $this->validator
            ]);
        }

        $photo = $this->request->getFile('photo');
        $signature = $this->request->getFile('signature');

        $photoName = $photo->isValid() ? $photo->getRandomName() : null;
        $signatureName = $signature->isValid() ? $signature->getRandomName() : null;

        if ($photoName) {
            $photo->move('uploads/photos', $photoName);
        }

        if ($signatureName) {
            $signature->move('uploads/signatures', $signatureName);
        }
        
        $model = new MemberModel();

        $model->insert([
            'customer_id' => $this->request->getPost('customer_id'),
            'member_code' => $this->request->getPost('member_code'),
            'title' => $this->request->getPost('title'),
            'name' => $this->request->getPost('name'),
            'residential_address' => $this->request->getPost('res_address'),
            'mobile' => $this->request->getPost('mobile'),
            'telephone' => $this->request->getPost('telephone'),
            'pincode' => $this->request->getPost('pincode'),
            'city' => $this->request->getPost('city'),
            'dob' => $this->request->getPost('dob'),
            'age' => $this->request->getPost('age'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'occupation' => $this->request->getPost('occupation'),
            'religion' => $this->request->getPost('religion'),
            'caste' => $this->request->getPost('caste'),
            'permanent_address' => $this->request->getPost('per_address'),
            'photo' => $photoName,
            'signature' => $signatureName,
        ]);

        return redirect()->to('/member/create')->with('success', 'Member Created Successfully');
    }
    public function index()
    {
    $model = new \App\Models\MemberModel();

    $data['members'] = $model->paginate(5);
    $data['pager']   = $model->pager;

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

    $data = [
        'customer_id' => $this->request->getPost('customer_id'),
        'member_code' => $this->request->getPost('member_code'),
        'name'        => $this->request->getPost('name'),
        'mobile'      => $this->request->getPost('mobile'),
        'email'       => $this->request->getPost('email'),
    ];

    // Photo update
    $photo = $this->request->getFile('photo');
    if ($photo && $photo->isValid()) {
        $photoName = $photo->getRandomName();
        $photo->move('uploads/photos', $photoName);
        $data['photo'] = $photoName;
    }

    // Signature update
    $signature = $this->request->getFile('signature');
    if ($signature && $signature->isValid()) {
        $signName = $signature->getRandomName();
        $signature->move('uploads/signatures', $signName);
        $data['signature'] = $signName;
    }

    $model->update($id, $data);

    return redirect()->to('/member')->with('success', 'Member updated successfully');
}
}