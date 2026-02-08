<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <title>Complain Print</title>
    <style>
        @page {
            size: A4;
            margin: 30mm 20mm 20mm 20mm;
        }
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            text-decoration: underline;
        }

        .section {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: inline-block;
            min-width: 200px;
        }

        .value {
            display: inline-block;
        }

        .primary_header_2_wrapper {
            border-bottom: 2px solid #d41113;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .header_site_title {
            font-size: 22px;
            margin: 0;
            font-weight: bold;
            color: #000;
        }

        .header_site_description {
            font-size: 16px;
            margin: 0;
            color: #000;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .col-sm-2, .col-sm-8 {
            padding: 5px;
        }

        .col-sm-2 {
            flex: 0 0 20%;
        }

        .col-sm-8 {
            flex: 0 0 60%;
        }

        img {
            max-height: 80px;
        }

        table td {
        padding: 6px 10px;
        vertical-align: top;
        }

        table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table, td {
            border: 1px solid #ccc;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="primary_header_2_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                   <img src="{{ asset('assets/images/logo.png') }}" style="max-height: 80px;" alt="Logo">
                </div>
                <div class="col-sm-8">
                    <div style="color: #d41113; font-size: 16px; font-weight: bold;">मधेश प्रदेश सरकार</div>
                    <h3 class="header_site_title">प्रदेश जनलोकपाल आयोग</h3>
                    <p class="header_site_description">जनकपुरधाम</p>
                </div>
                <div class="col-sm-2">
                    <img src="{{ asset('assets/images/flag.gif') }}" style="max-height: 80px;" alt="Flag">
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container">
        <h2>अनलाइन उजुरी विवरण (Online Complain Details)</h2>

        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td><strong>Submission Number / दर्ता नम्बर:</strong></td>
                    <td>{{ $complaint->submission_number }}</td>
                </tr>
                <tr>
                    <td><strong>Name Type / नामको प्रकार:</strong></td>
                    <td>{{ $complaint->name_type }}</td>
                </tr>
                <tr>
                    <td><strong>Name / नाम:</strong></td>
                    <td>{{ $complaint->name }}</td>
                </tr>
                <tr>
                    <td><strong>Gender / लिङ्ग:</strong></td>
                    <td>{{ $complaint->gender }}</td>
                </tr>
                <tr>
                    <td><strong>Age Group / उमेर समूह:</strong></td>
                    <td>{{ $complaint->age_group }}</td>
                </tr>
                <tr>
                    <td><strong>Contact Number / सम्पर्क नम्बर:</strong></td>
                    <td>{{ $complaint->contact_number }}</td>
                </tr>
                <tr>
                    <td><strong>Email / इमेल:</strong></td>
                    <td>{{ $complaint->email }}</td>
                </tr>
                <tr>
                    <td><strong>Complaint Type / उजुरीको प्रकार:</strong></td>
                    <td>{{ $complaint->complaint_type }}</td>
                </tr>
                <tr>
                    <td><strong>Subject of Complaint / उजुरीको विषयवस्तु:</strong></td>
                    <td>{{ $complaint->subject_of_complaint }}</td>
                </tr>
                <tr>
                    <td><strong>Corruption Domain / भ्रष्टाचार क्षेत्र:</strong></td>
                    <td>{{ $complaint->corruption_domain }}</td>
                </tr>
                <tr>
                    <td><strong>Against Person or Institution / व्यक्ति वा संस्था:</strong></td>
                    <td>{{ $complaint->against_person_or_institution }}</td>
                </tr>
                <tr>
                    <td><strong>Fiscal Year / आर्थिक वर्ष:</strong></td>
                    <td>{{ $complaint->year->title }}</td>
                </tr>
                <tr>
                    <td><strong>Submitted Date / पेश गरेको मिति (AD):</strong></td>
                    <td>{{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <td><strong>पेश गरेको मिति (वि.सं.):</strong></td>
                    <td>{{ \App\Helpers\DateHelper::engToNepaliDate($complaint->created_at) }}</td>
                </tr>
                <tr>
                    <td><strong>Additional Info / थप जानकारी:</strong></td>
                    <td>{{ $complaint->additional_info }}</td>
                </tr>
                <tr>
                    <td><strong>Status / स्थिति:</strong></td>
                    <td>{{ $complaint->status ?? 'N/A' }}</td>
                </tr>
                @if ($complaint->uploaded_file)
                <tr>
                    <td><strong>Uploaded File / अपलोड गरिएको फाइल:</strong></td>
                    <td><a href="{{ asset('storage/' . $complaint->uploaded_file) }}" target="_blank">View File</a></td>
                </tr>
                @endif
            </tbody>
        </table>

        <br><br>

        <button class="no-print" onclick="window.print()">Print this page</button>

        <div class="footer">
            <div class="signature">
                <p>.............................................</p>
                <p>प्रमाणित गर्ने अधिकारी / Authorized Person</p>
            </div>
        </div>

        <div class="timestamp">
            यो प्रतिवेदन {{ now()->format('Y-m-d H:i') }} मा जनरेट गरिएको हो।
        </div>
    </div>


</body>
</html>
