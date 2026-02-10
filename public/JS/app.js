
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('photo').addEventListener('change', function() {
    previewImage(this, 'photoPreview');
});

document.getElementById('signature').addEventListener('change', function() {
    previewImage(this, 'signPreview');
});

function validateForm() {

    if (document.getElementById('customer_id').value.trim() === '') {
        alert('Customer ID is required');
        return false;
    }

    if (document.getElementById('name').value.trim() === '') {
        alert('Name is required');
        return false;
    }

    let mobile = document.getElementById('mobile').value;
    if (!/^[6-9]\d{9}$/.test(mobile)) {
        alert('Enter valid 10 digit mobile number');
        return false;
    }

    let email = document.getElementById('email').value;
    if (email !== '' && !/^\S+@\S+\.\S+$/.test(email)) {
        alert('Invalid email format');
        return false;
    }

    return true;
}

function calculateAge() {
    let dob = document.getElementById('dob').value;
    if (dob) {
        let birthDate = new Date(dob);
        let today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        document.getElementById('age').value = age;
    }
}
document.getElementById('email').addEventListener('input', function () {
    const email = this.value;
    const emailError = document.getElementById('emailError');

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        emailError.innerText = 'Enter a valid email address';
    } else {
        emailError.innerText = '';
    }
});
