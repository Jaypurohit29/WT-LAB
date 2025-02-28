function validateForm() {
    // Get form values
    const name = document.getElementById("name").value;
    const rollno = document.getElementById("rollno").value;
    const className = document.getElementById("class").value;
    const division = document.getElementById("division").value;
    const mobno = document.getElementById("mobno").value;
    const email = document.getElementById("email").value;

    // Name Validation (check for empty or non-alphabetic characters)
    if (name === "" || !/^[a-zA-Z ]+$/.test(name)) {
        alert("Please enter a valid name.");
        return false;
    }

    // Roll Number Validation (check for digits)
    if (rollno === "" || !/^\d+$/.test(rollno)) {
        alert("Please enter a valid roll number.");
        return false;
    }

    // Class Validation (check for empty)
    if (className === "") {
        alert("Please enter a valid class.");
        return false;
    }

    // Division Validation (check for empty)
    if (division === "") {
        alert("Please enter a valid division.");
        return false;
    }

    // Mobile Number Validation (check for 10 digits)
    if (mobno === "" || !/^\d{10}$/.test(mobno)) {
        alert("Please enter a valid mobile number.");
        return false;
    }

    // Email Validation (check for email format)
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid email.");
        return false;
    }

    // If all validations pass, return true
    return true;
}
