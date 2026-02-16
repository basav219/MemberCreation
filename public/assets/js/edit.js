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
    // Document fields (optional but length check if filled)
    const docFields = [
        {name:'dl_no', len:10, label:'Driving License'},
        {name:'gst_no', len:15, label:'GST Number'},
        {name:'passport_no', len:8, label:'Passport Number'},
        {name:'gas_consumer_no', len:10, label:'Gas Consumer Number'},
        {name:'voter', len:10, label:'voter'}

    ];
    for (let doc of docFields) {
        let val = form[doc.name].value.trim();
        if (val && val.length < doc.len) {
            alert(`Invalid ${doc.label}`);
            form[doc.name].focus();
            return false;
        }
    }

    if (
        !validateName() ||
        !validateEmail() ||
        !validateMobile() ||
        !validatePincode() ||
        !calculateAge() ||
        !validateNominee() ||
        !validateDccAdbBank() ||
        !validateOtherBank()||
        !validatePan() ||       //  PAN check
        !validateAdhar()        //  Aadhaar check
    ) {
        return false;
    }
   
    if (!photo) {
        alert("Please upload a photo.");
        return false;
    }

    if (!signature) {
        alert("Please upload a signature.");
        return false;
    }

    return true; // ✅ FORM WILL SUBMIT
}
      
function validateName() {
    let name = document.getElementById("name").value;
    let error = document.getElementById("nameError");

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
function validateEmail() {
    let email = document.getElementById("email").value.trim();
    let error = document.getElementById("emailError");
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        error.innerText = "";
        return true; // email optional
    }

    if (!pattern.test(email)) {
        error.innerText = "Enter a valid email address";
        return false;
    }

    error.innerText = "";
    return true;
}
function validateMobile() {
    let mobile = document.getElementById("mobile").value;
    let error  = document.getElementById("mobileError");

    // Indian mobile number pattern
    let pattern = /^[6-9][0-9]{9}$/;

    if (mobile === "") {
        error.innerText = "Mobile number is required";
        return false;
    } 
    else if (!pattern.test(mobile)) {
        error.innerText = "Enter valid 10-digit mobile number";
        return false;
    } 
    else {
        error.innerText = "";
        return true;
    }
}
function calculateAge() {
    let dob = document.getElementById("dob").value;
    let ageField = document.getElementById("age");
    let error = document.getElementById("dobError");

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
        return false;
    }

    ageField.value = age;
    error.innerText = "";
    return true;
}
function validatePincode() {
    let pincode = document.getElementById("pincode").value;
    let error   = document.getElementById("pincodeError");

    let pattern = /^[1-9][0-9]{5}$/;

    if (pincode === "") {
        error.innerText = "Pincode is required";
        return false;
    }
    else if (!pattern.test(pincode)) {
        error.innerText = "Enter valid 6-digit pincode";
        return false;
    }
    else {
        error.innerText = "";
        return true;
    }
}
const photoInput = document.getElementById('photo');
const signInput = document.getElementById('signature');

const photoPreview = document.getElementById('photoPreview');
const signPreview = document.getElementById('signPreview');

function handlePreview(input, preview) {
    const file = input.files[0];
    if (!file) {
        preview.src = "";      // Clear preview
        return;
    }

    const MAX_SIZE = 100 * 1024;
    if (file.size > MAX_SIZE) {
        alert("File size must not exceed 100KB!");
        input.value = "";
        preview.src = "";
        return;
    }

    const allowedTypes = ["image/jpeg", "image/png"];
    if (!allowedTypes.includes(file.type)) {
        alert("Only JPG or PNG files are allowed!");
        input.value = "";
        preview.src = "";
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
    }
    reader.readAsDataURL(file);
}

photoInput.addEventListener("change", () => handlePreview(photoInput, photoPreview));
signInput.addEventListener("change", () => handlePreview(signInput, signPreview));


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

/* ---------- NOMINEE ---------- */

function validateNominee() {
    const name = document.querySelector('[name="nominee_name"]').value.trim();
    if (!name) return true; // optional

    const age = document.querySelector('[name="nominee_age"]').value;
    const mobile = document.querySelector('[name="nominee_mobile"]').value;
    const adhar = document.querySelector('[name="nominee_adhar"]').value;

    if (age <= 0) { alert("Invalid nominee age"); return false; }
    if (mobile.length !== 10) { alert("Nominee mobile must be 10 digits"); return false; }
    if (adhar.length !== 12) { alert("Nominee Aadhaar must be 12 digits"); return false; }

    return true;
}

/* ---------- BANK VALIDATION ---------- */

function validateDccAdbBank() {
    const bank = document.querySelector('[name="select_dcc_adb_bankname"]').value;
    if (!bank) return true;

    const acc = document.querySelector('[name="dcc_adb_accountnumber"]').value.trim();
    const ifsc = document.querySelector('[name="dcc_adb_ifsccode"]').value.trim();

    if (!acc) { alert("DCC/ADB account required"); return false; }
    if (ifsc.length < 8) { alert("Invalid IFSC"); return false; }

    return true;
}

function validateOtherBank() {
    const bank = document.querySelector('[name="select_other_bankname"]').value;
    if (!bank) return true;

    const acc = document.querySelector('[name="other_accountnumber"]').value.trim();
    const ifsc = document.querySelector('[name="other_ifsccode"]').value.trim();

    if (!acc) { alert("Other bank account required"); return false; }
    if (ifsc.length < 8) { alert("Invalid IFSC"); return false; }

    return true;
}

function validatePan() {
    let pan = document.getElementById("pan").value
    let error = document.getElementById("panError");
    // PAN pattern: 5 letters, 4 digits, 1 letter (example: ABCDE1234F)
    const pattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/i;

    if (pan==="") {
        error.innerText = "PAN is required";
        return false;
    } else if (!pattern.test(pan)) {
        error.innerText = "Enter a valid PAN (ABCDE1234F)";
        return false;
    } else {
        error.innerText = "";
        return true;
    }
}

function validateAdhar() {
    const adhar = document.getElementById("adhar").value
    const error = document.getElementById("adharError");
    const pattern = /^\d{12}$/; // 12 digits

    if (!adhar) {
        error.innerText = "Aadhaar number is required";
        return false;
    } else if (!pattern.test(adhar)) {
        error.innerText = "Enter a valid 12-digit Aadhaar number";
        return false;
    } else {
        error.innerText = "";
        return true;
    }
}

document.getElementById('memberForm').addEventListener('submit', function(e) {
    let adhar = document.getElementById('adhar').value.trim();
    let pan = document.getElementById('pan').value.trim().toUpperCase();
    let valid = true;

    if(!/^\d{12}$/.test(adhar)) valid = false;
    if(!/^[A-Z]{5}[0-9]{4}[A-Z]$/.test(pan)) valid = false;

    if(!valid) e.preventDefault(); // stop submit
});
