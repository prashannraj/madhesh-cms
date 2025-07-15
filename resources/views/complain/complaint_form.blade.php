<form action="{{ route('complaint.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- 1. Name -->
    <label>Name Type:</label><br>
    <input type="radio" name="name_type" value="individual" required> Individual
    <input type="radio" name="name_type" value="group"> Group/Institution<br>

    <input type="text" name="name" placeholder="Full Name / Institution Name" class="block w-full my-2" required>

    <!-- 2. Gender -->
    <label>Gender:</label><br>
    <select name="gender" required>
        <option value="">--Select--</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="third_gender">Third Gender</option>
        <option value="others">Others</option>
    </select><br><br>

    <!-- 3. Age Group -->
    <label>Age Group:</label><br>
    <select name="age_group" required>
        <option value="">--Select--</option>
        <option value="below_16">Below 16</option>
        <option value="16_39">16-39</option>
        <option value="40_59">40-59</option>
        <option value="60_above">60 Above</option>
    </select><br><br>

    <!-- 4. Contact -->
    <input type="text" name="contact_number" placeholder="Contact Number" required><br><br>

    <!-- 5. Email -->
    <input type="email" name="email" placeholder="Email Address"><br><br>

    <!-- 6. Complaint Type -->
    <label>Complaint Type:</label><br>
    <input type="radio" name="complaint_type" value="corruption" required> Corruption
    <input type="radio" name="complaint_type" value="illegal_property"> Acquisition of Illegal Property<br><br>

    <!-- 7. Subject of Complain -->
    <label>Subject(s) of Complaint:</label><br>
    <textarea name="subject_of_complaint[]" placeholder="Write subject(s), separated by comma" rows="3" required></textarea><br><br>

    <!-- 8. Domain -->
    <label>Domain of Corruption:</label><br>
    <input type="radio" name="corruption_domain" value="province" required> Province Level
    <input type="radio" name="corruption_domain" value="local"> Local Level<br><br>

    <!-- 9. Against -->
    <input type="text" name="against_person_or_institution" placeholder="Name of person/institution" required><br><br>

    <!-- 10. Additional Info -->
    <textarea name="additional_info" placeholder="Additional info about the complaint" rows="4"></textarea><br><br>

    <!-- 11. File Upload -->
    <label>Upload File (jpeg, jpg, png, pdf, doc, avi, mp3, mp4, wav – max 5MB):</label><br>
    <input type="file" name="uploaded_file" accept=".jpeg,.jpg,.png,.pdf,.doc,.avi,.mp3,.mp4,.wav"><br><br>

    <!-- 12. Terms -->
    <label>
        <input type="checkbox" name="terms_accepted" required>
        I accept the terms and conditions.
    </label><br><br>

    <!-- 13. Submit -->
    <button type="submit">Submit Complaint</button>
</form>
@if (session('success'))
    <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<style>
    form {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="file"],
    select,
    textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button {
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #218838;
    }
    .alert {
        padding: 10px;
        margin-top: 10px;
        border-radius: 4px;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const termsAccepted = document.querySelector('input[name="terms_accepted"]');
            if (!termsAccepted.checked) {
                event.preventDefault();
                alert('You must accept the terms and conditions to submit the complaint.');
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script
<script>
    $(document).ready(function() {
        $('input[name="name_type"]').change(function() {
            if ($(this).val() === 'group') {
                $('input[name="name"]').attr('placeholder', 'Institution Name').val('');
            } else {
                $('input[name="name"]').attr('placeholder', 'Full Name').val('');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="complaint_type"]').change(function() {
            if ($(this).val() === 'corruption') {
                $('input[name="corruption_domain"]').prop('required', true);
            } else {
                $('input[name="corruption_domain"]').prop('required', false);
            }
        });
    });
</script>
