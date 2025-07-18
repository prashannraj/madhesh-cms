<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <title>अनलाइन उजुरी फारम</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        .primary_header_2_wrapper {
            background: #fff;
            padding: 10px 0;
            border-bottom: 2px solid #ccc;
        }
        .header_site_title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 0;
        }
        .header_site_description {
            font-size: 16px;
            margin-top: 0;
        }
        .form-wrapper {
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            font-size: 14px;
        }
        input[type="text"],
        input[type="email"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
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
            font-size: 14px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        /* Styling for the published years sidebar */
        .years-sidebar {
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            padding: 15px;
            margin-top: 30px;
        }
        .years-sidebar h4 {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="primary_header_2_wrapper full_width">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-sm-2">
                    <img src="https://ppoc.madhesh.gov.np/wp-content/uploads/2022/05/logo.jpg" style="max-height: 80px;" alt="Logo">
                </div>
                <div class="col-sm-8">
                    <div style="color: #d41113; font-size: 16px; font-weight: bold;">मधेश प्रदेश सरकार</div>
                    <a class="logo" href="https://ppoc.madhesh.gov.np/" target="_self">
                        <h3 class="header_site_title">प्रदेश जनलोकपाल आयोग</h3>
                        <p class="header_site_description">जनकपुरधाम</p>
                    </a>
                </div>
                <div class="col-sm-2">
                    <img src="https://ppoc.madhesh.gov.np/wp-content/uploads/2022/05/flag.gif" style="max-height: 80px;" alt="Flag">
                </div>
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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
    </div>

    <div class="container mt-4">
        <div class="row">
            {{-- फारामको Left Side --}}
            <div class="col-md-8">
                <div class="form-wrapper">
                    <form action="{{ route('complaint.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="header_site_title">अनलाइन उजुरी फाराम</h3>
                        <label>नामको प्रकार / Name Type:</label>
                        <input type="radio" name="name_type" value="individual" required> व्यक्तिगत / Individual
                        <input type="radio" name="name_type" value="group"> समूह/संस्था / Group/Institution
                        <input type="text" name="name" placeholder="पुरा नाम / संस्थाको नाम" class="my-2" required>

                        <label>लिङ्ग / Gender:</label>
                        <select name="gender" required>
                            <option value="">--छान्नुहोस्--</option>
                            <option value="male">पुरुष / Male</option>
                            <option value="female">महिला / Female</option>
                            <option value="third_gender">तेस्रो लिङ्गी / Third Gender</option>
                            <option value="others">अन्य / Others</option>
                        </select>

                        <label>उमेर समूह / Age Group:</label>
                        <select name="age_group" required>
                            <option value="">--छान्नुहोस्--</option>
                            <option value="below_16">१६ वर्ष मुनि / Below 16</option>
                            <option value="16_39">१६-३९ वर्ष / 16-39</option>
                            <option value="40_59">४०-५९ वर्ष / 40-59</option>
                            <option value="60_above">६० वर्ष माथि / 60 Above</option>
                        </select>

                        <label>सम्पर्क नम्बर:</label>
                        <input type="text" name="contact_number" placeholder="सम्पर्क नम्बर" required>

                        <label>इमेल:</label>
                        <input type="email" name="email" placeholder="Email Address">

                        <label>गुनासोको प्रकार:</label>
                        <input type="radio" name="complaint_type" value="corruption" required> भ्रष्टाचार / Corruption
                        <input type="radio" name="complaint_type" value="illegal_property"> अवैध सम्पत्ति / Illegal Property

                        <label>गुनासोको विषयहरू:</label>
                        <textarea name="subject_of_complaint" placeholder="अल्पविराम (,) प्रयोग गर्नुहोस्" rows="3" required></textarea>

                        <label>भ्रष्टाचारको क्षेत्र:</label>
                        <input type="radio" name="corruption_domain" value="province" required> प्रदेश स्तर
                        <input type="radio" name="corruption_domain" value="local"> स्थानीय तह

                        <label>कसको विरुद्ध:</label>
                        <input type="text" name="against_person_or_institution" placeholder="व्यक्ति वा संस्था" required>

                        <label>थप जानकारी:</label>
                        <textarea name="additional_info" placeholder="थप विवरण" rows="4"></textarea>

                        <label>फाइल अपलोड गर्नुहोस् (५MB सम्म):</label>
                        <input type="file" name="uploaded_file" accept=".jpeg,.jpg,.png,.pdf,.doc,.avi,.mp3,.mp4,.wav">

                        <label>
                            <input type="checkbox" name="terms_accepted" value="1" required>
                            म नियम र सर्तहरू स्वीकार गर्दछु / I accept the terms and conditions.
                        </label>

                        <button type="submit">पेश गर्नुहोस् / Submit Complaint</button>
                    </form>
                </div>
            </div>

            {{-- Right Side: Published Years --}}
            <div class="col-md-4">
                {{-- <div class="years-sidebar">
                    <h4>आर्थिक वर्ष</h4>
                    @if(isset($years) && $years->count())
                        <ul class="list-group">
                            @foreach($years as $year)
                                <li class="list-group-item">
                                    {{-- यहाँ $year->name अथवा चाहिएको वर्षको attribute प्रयोग गर्नुहोस् --}}
                                    {{-- {{ $year->title ?? $year->year }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>हाल कुनै प्रकाशित वर्ष उपलब्ध छैन।</p>
                    @endif
                </div> --}}
                  <div class="years-sidebar">
                    <h4>सम्पर्क विवरण</h4>
                        <h3>प्रदेश जनलोकपाल आयोग</h3></br>
                        <p>मधशे प्रदेश, जनकपुरधाम । </p></br>
                        <p>फोन नं.: ०४१-५२६२१५१ </p></br>
                        <p>इमेल: info.ppoc@madhesh.gov.np </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        $(function () {
            $('input[name="name_type"]').change(function () {
                const placeholder = $(this).val() === 'group' ? 'Institution Name' : 'Full Name';
                $('input[name="name"]').attr('placeholder', placeholder).val('');
            });

            $('input[name="complaint_type"]').change(function () {
                const isCorruption = $(this).val() === 'corruption';
                $('input[name="corruption_domain"]').prop('required', isCorruption);
            });

            $('form').on('submit', function (e) {
                if (!$('input[name="terms_accepted"]').is(':checked')) {
                    e.preventDefault();
                    alert('You must accept the terms and conditions.');
                }
            });
        });
    </script>

</body>
</html>
