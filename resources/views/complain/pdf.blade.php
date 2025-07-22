<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8" />
    <style>
        body {
            font-family: "dejavusans", sans-serif;
            font-size: 14px;
        }
        /* तपाईंको अन्य CSS */
    </style>
</head>
<body>
    <h2>अनलाइन उजुरी विवरण (Online Complain Details)</h2>

    <p><strong>Submission Number:</strong> {{ $complaint->submission_number }}</p>
    <p><strong>Name Type:</strong> {{ $complaint->name_type }}</p>
    <p><strong>Name:</strong> {{ $complaint->name }}</p>
    <p><strong>Gender:</strong> {{ $complaint->gender }}</p>
    <p><strong>Age Group:</strong> {{ $complaint->age_group }}</p>
    <p><strong>Contact Number:</strong> {{ $complaint->contact_number }}</p>
    <p><strong>Email:</strong> {{ $complaint->email }}</p>
    <p><strong>Complaint Type:</strong> {{ $complaint->complaint_type }}</p>
    <p><strong>Subject of Complaint:</strong> {{ $complaint->subject_of_complaint }}</p>
    <p><strong>Corruption Domain:</strong> {{ $complaint->corruption_domain }}</p>
    <p><strong>Against Person or Institution:</strong> {{ $complaint->against_person_or_institution }}</p>
    <p><strong>Fiscal Year:</strong> {{ $complaint->year->title }}</p>
    <p><strong>Submitted Date:</strong> {{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d H:i') }}</p>
    <p><strong>Additional Info:</strong> {{ $complaint->additional_info }}</p>
    <p><strong>Status:</strong> {{ $complaint->status ?? 'N/A' }}</p>
</body>
</html>
