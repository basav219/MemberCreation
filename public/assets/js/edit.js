/* ---------------- FORM VALIDATION ---------------- */
function validateForm() {
    const form = document.forms["memberForm"];

    // Required fields
    const requiredFields = [
        'customer_id','member_code','name','dob','mobile','email',
        'residential_address','pincode','city','gender','occupation',
        'religion','caste','permanent_address','marital_status',
        'ration_card_type','rationcard_number','father','adhar',
        'pan','country','area','taluk','district','state'
    ];

    for (let field of requiredFields) {
        if (!form[field].value.trim()) {
            alert(`Please fill ${field.replace(/_/g,' ')}`);
            form[field].focus();
            return false;
        }
    }

    // Optional document fields
    const docFields = [
        {name:'dl_no', len:10, label:'Driving License'},
        {name:'gst_no', len:15, label:'GST Number'},
        {name:'passport_no', len:8, label:'Passport Number'},
        {name:'gas_consumer_no', len:10, label:'Gas Consumer Number'},
        {name:'voter', len:10, label:'Voter ID'}
    ];

    for (let doc of docFields) {
        let val = form[doc.name]?.value.trim() || '';
        if (val && val.length < doc.len) {
            alert(`Invalid ${doc.label}`);
            form[doc.name].focus();
            return false;
        }
    }

    // Individual validations
    if (
        !validateName() ||
        !validateEmail() ||
        !validateMobile() ||
        !validatePincode() ||
        !calculateAge() ||
        !validateNominee() ||
        !validateDccAdbBank() ||
        !validateOtherBank() ||
        !validatePan() ||
        !validateAdhar()
    ) return false;

    // Photo & Signature
    const photo = document.getElementById('photo');
    const signature = document.getElementById('signature');

    if (!photo || !photo.files.length) {
        alert("Please upload a photo.");
        photo.focus();
        return false;
    }
    if (!signature || !signature.files.length) {
        alert("Please upload a signature.");
        signature.focus();
        return false;
    }

    return true; // ✅ FORM IS VALID
}

/* ---------------- NAME ---------------- */
function validateName() {
    let name = document.getElementById("name")?.value || '';
    let error = document.getElementById("nameError");
    if (!error) return true;

    if (name.trim() === "") {
        error.innerText = "Name is required";
        return false;
    } else if (name.length < 3) {
        error.innerText = "Name must be at least 3 characters";
        return false;
    } else {
        error.innerText = "";
        return true;
    }
}

/* ---------------- EMAIL ---------------- */
function validateEmail() {
    let email = document.getElementById("email")?.value.trim() || '';
    let error = document.getElementById("emailError");
    if (!error) return true;

    if (!email) {
        error.innerText = "";
        return true; // optional
    }

    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!pattern.test(email)) {
        error.innerText = "Enter a valid email address";
        return false;
    }

    error.innerText = "";
    return true;
}

/* ---------------- MOBILE ---------------- */
function validateMobile() {
    let mobile = document.getElementById("mobile")?.value || '';
    let error  = document.getElementById("mobileError");
    if (!error) return true;

    const pattern = /^[6-9][0-9]{9}$/;
    if (!mobile) {
        error.innerText = "Mobile number is required";
        return false;
    } else if (!pattern.test(mobile)) {
        error.innerText = "Enter valid 10-digit mobile number";
        return false;
    } else {
        error.innerText = "";
        return true;
    }
}

/* ---------------- DATE OF BIRTH / AGE ---------------- */
function calculateAge() {
    let dob = document.getElementById("dob")?.value;
    let ageField = document.getElementById("age");
    let error = document.getElementById("dobError");
    if (!ageField || !error) return true;

    if (!dob) {
        ageField.value = "";
        error.innerText = "Please select Date of Birth";
        return false;
    }

    let birthDate = new Date(dob);
    let today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    let monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    if (age < 0) {
        error.innerText = "Invalid Date of Birth";
        ageField.value = "";
        return false;
    }

    ageField.value = age;
    error.innerText = "";
    return true;
}

/* ---------------- ONLY NUMBERS ---------------- */
function onlyNumbers(e) {
    if (["Backspace","Delete","Tab","ArrowLeft","ArrowRight"].includes(e.key)) return true;
    if (e.key >= "0" && e.key <= "9") return true;
    e.preventDefault();
    return false;
}

/* ---------------- PINCODE ---------------- */
function validatePincode() {
    let pincode = document.getElementById("pincode")?.value || '';
    let error   = document.getElementById("pincodeError");
    if (!error) return true;

    const pattern = /^[1-9][0-9]{5}$/;
    if (!pincode) {
        error.innerText = "Pincode is required";
        return false;
    } else if (!pattern.test(pincode)) {
        error.innerText = "Enter valid 6-digit pincode";
        return false;
    } else {
        error.innerText = "";
        return true;
    }
}

/* ---------------- PHOTO & SIGNATURE PREVIEW ---------------- */
const photoInput = document.getElementById('photo');
const signInput = document.getElementById('signature');
const photoPreview = document.getElementById('photoPreview');
const signPreview = document.getElementById('signPreview');

function handlePreview(input, preview) {
    const file = input?.files[0];
    if (!file) {
        preview.src = "";
        return;
    }

    const MAX_SIZE = 100 * 1024; // 100 KB
    const allowedTypes = ["image/jpeg","image/png"];
    if (file.size > MAX_SIZE) { alert("File size must not exceed 100KB!"); input.value=""; preview.src=""; return; }
    if (!allowedTypes.includes(file.type)) { alert("Only JPG or PNG allowed!"); input.value=""; preview.src=""; return; }

    const reader = new FileReader();
    reader.onload = e => preview.src = e.target.result;
    reader.readAsDataURL(file);
}

photoInput?.addEventListener("change", () => handlePreview(photoInput, photoPreview));
signInput?.addEventListener("change", () => handlePreview(signInput, signPreview));

document.getElementById('photo').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const img = document.getElementById('photoPreview');
        img.src = URL.createObjectURL(file);
        img.style.display = 'block';
        document.getElementById('photoText').style.display = 'none';
    }
});

document.getElementById('signature').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const img = document.getElementById('signPreview');
        img.src = URL.createObjectURL(file);
        img.style.display = 'block';
        document.getElementById('signText').style.display = 'none';
    }
});

/* ---------------- NOMINEE ---------------- */
function validateNominee() {
    const name = document.querySelector('[name="nominee_name"]')?.value.trim() || '';
    if (!name) return true;

    const age = parseInt(document.querySelector('[name="nominee_age"]')?.value) || 0;
    const mobile = document.querySelector('[name="nominee_mobile"]')?.value || '';
    const adhar = document.querySelector('[name="nominee_adhar"]')?.value || '';

    if (age <= 0) { alert("Invalid nominee age"); return false; }
    if (mobile && mobile.length !== 10) { alert("Nominee mobile must be 10 digits"); return false; }
    if (adhar && adhar.length !== 12) { alert("Nominee Aadhaar must be 12 digits"); return false; }

    return true;
}

/* ---------------- BANK VALIDATION ---------------- */
function validateDccAdbBank() {
    const bank = document.querySelector('[name="select_dcc_adb_bankname"]')?.value;
    if (!bank) return true;

    const acc = document.querySelector('[name="dcc_adb_accountnumber"]')?.value.trim();
    const ifsc = document.querySelector('[name="dcc_adb_ifsccode"]')?.value.trim();

    if (!acc) { alert("DCC/ADB account required"); return false; }
    if (!ifsc || ifsc.length < 8) { alert("Invalid IFSC"); return false; }

    return true;
}

function validateOtherBank() {
    const bank = document.querySelector('[name="select_other_bankname"]')?.value;
    if (!bank) return true;

    const acc = document.querySelector('[name="other_accountnumber"]')?.value.trim();
    const ifsc = document.querySelector('[name="other_ifsccode"]')?.value.trim();

    if (!acc) { alert("Other bank account required"); return false; }
    if (!ifsc || ifsc.length < 8) { alert("Invalid IFSC"); return false; }

    return true;
}

/* ---------------- PAN / ADHAR ---------------- */
function validatePan() {
    const pan = document.getElementById("pan")?.value || '';
    const error = document.getElementById("panError");
    if (!error) return true;

    const pattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/i;
    if (!pan) { error.innerText="PAN is required"; return false; }
    if (!pattern.test(pan)) { error.innerText="Enter valid PAN (ABCDE1234F)"; return false; }
    error.innerText=""; return true;
}

function validateAdhar() {
    const adhar = document.getElementById("adhar")?.value || '';
    const error = document.getElementById("adharError");
    if (!error) return true;

    const pattern = /^\d{12}$/;
    if (!adhar) { error.innerText="Aadhaar is required"; return false; }
    if (!pattern.test(adhar)) { error.innerText="Enter valid 12-digit Aadhaar"; return false; }
    error.innerText=""; return true;
}

/* ---------------- ONLY ALPHABETS ---------------- */
function onlyAlpabets(e) {
    if (["Backspace","Delete","Tab","ArrowLeft","ArrowRight"].includes(e.key)) return true;
    if (/^[a-zA-Z]$/.test(e.key)) return true;
    e.preventDefault();
    return false;
}

/* ---------------- INTRODUCER SEARCH ---------------- */
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('introducer_search');
    const box   = document.getElementById('introducer_results');
    if (!input || !box) return;

    input.addEventListener('keyup', function () {
        const q = this.value.trim();
        if (q.length < 2) { box.innerHTML=''; box.style.display='none'; return; }

        fetch("<?= base_url('member/searchIntroducer') ?>?q=" + encodeURIComponent(q))
            .then(res=>res.json())
            .then(data=>{
                if (!data.length) { box.innerHTML='<div class="list-group-item">No results</div>'; box.style.display='block'; return; }

                box.innerHTML = data.map(row=>`
                  <div class="list-group-item list-group-item-action" style="cursor:pointer"
                       onclick="selectIntroducer('${row.customer_id}','${row.name}','${row.father}','${row.mobile}')">
                    <strong>${row.customer_id}</strong> – ${row.name}
                  </div>
                `).join('');
                box.style.display='block';
            });
    });
});

function selectIntroducer(id, name, father, mobile) {
    document.getElementById('introducer_search').value = id;
    document.getElementById('introducer_customer_id').value = id;
    document.getElementById('introducer_name').value = name;
    document.getElementById('introducer_father').value = father;
    document.getElementById('introducer_mobile').value = mobile;
    document.getElementById('introducer_results').style.display='none';
}

/* ---------------- PINCODE → AREA → LOCATION ---------------- */
document.getElementById('pincode')?.addEventListener('keyup', function() {
    const pincode = this.value.trim();
    if (pincode.length !== 6) return;

    fetch('<?= base_url("member/fetch-areas") ?>?pincode=' + pincode)
        .then(res => res.json())
        .then(rows => {
            const areaSelect = document.getElementById('area');
            if (!areaSelect) return;
            areaSelect.innerHTML = '<option value="">-- Select Area --</option>';
            rows.forEach(row => {
                const opt = document.createElement('option');
                opt.value = row.area;
                opt.textContent = row.area;
                areaSelect.appendChild(opt);
            });
        });
});

document.getElementById('area')?.addEventListener('change', function() {
    const area = this.value;
    const pincode = document.getElementById('pincode')?.value;
    if (!area || !pincode) return;

    fetch('<?= base_url("member/fetch-location-by-area") ?>?pincode=' + pincode + '&area=' + encodeURIComponent(area))
        .then(res=>res.json())
        .then(data=>{
            if (!data) return;
            document.getElementById('taluk').value = data.taluk || '';
            document.getElementById('district').value = data.district || '';
            document.getElementById('state').value = data.state || '';
        });
});