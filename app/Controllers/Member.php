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
}