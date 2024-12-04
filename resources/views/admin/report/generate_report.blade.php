<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pathology Report</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .report-container {
            background-color: #ffffff;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        header h1 {
            color: #0073e6;
            font-size: 26px;
            margin-bottom: 5px;
        }

        header p {
            margin: 3px 0;
            font-size: 14px;
        }

        .patient-info {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .patient-info p {
            margin: 5px 0;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .interpretation {
            margin-top: 20px;
        }

        .interpretation h3 {
            font-size: 18px;
            text-decoration: underline;
        }

        .interpretation p {
            font-size: 14px;
            line-height: 1.6;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #000;
            font-weight: bold;
        }

        #download-btn,
        {
        background-color: #0073e6;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 20px;
        display: inline-block;
        margin: 20px auto;
        border-radius: 5px;
        }

        #download-btn:hover {
            background-color: #005bb5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="report-container" id="report">
            {{-- <header>
                <h1 class="pathalogy_name">{{ $setting->pathalogy_name }}</h1>
                <p class="address">{{ $setting->address }}</p>
                <p class="working_hour">Working Hours: {{ $setting->working_hour }} | Sunday Open</p>
                <p class="email_phones">Email ID: {{ $setting->email }} | Phones: {{ $setting->phones }}</p>
            </header> --}}

            <header>
                <h1 class="pathalogy_name" ondblclick="editText('pathalogy_name')">{{ $setting->pathalogy_name }}</h1>
                <p class="address" ondblclick="editText('address')">{{ $setting->address }}</p>
                <p class="working_hour" ondblclick="editText('working_hour')">Working Hours:
                    {{ $setting->working_hour }} | Sunday Open</p>
                <p class="email_phones" ondblclick="editText('email_phones')">Email ID: {{ $setting->email }} | Phones:
                    {{ $setting->phones }}</p>
            </header>

            <section class="patient-info">
                <div class="row">
                    <div class="col-6">
                        <p><strong>Sr No.:</strong> {{ $report->id }}</p>
                        <p><strong>Patient Name:</strong> {{ $report->name }}</p>
                        <p><strong>Age:</strong> {{ $report->age }} Yrs.</p>
                    </div>
                    <div class="col-6">
                        <p><strong>Date:</strong> {{ date('d/m/Y') }}</p>
                        <p><strong>Ref. By:</strong> {{ $report->refer_by_doctor }} &nbsp;</p>
                    </div>
                </div>
            </section>

            @forelse ($subCategoryData as $subCategory)
                <section class="test-results">
                    <h2>{{ $subCategory['name'] }}</h2>
                    @if (count($subCategory['tests']) > 0)
                        <table class="table table-bordered_">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Test Name</th>
                                    <th>Upper Value</th>
                                    <th>Percent</th>
                                    <th>Lower Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategory['tests'] as $key => $test)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $test->name }}</td>
                                        <td>{{ $test->upper_value }}</td>
                                        <td>{{ $test->percent }}%</td>
                                        <td>{{ $test->pivot->lower_value }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif

                </section>
            @empty
            @endforelse

            <section class="interpretation">
                <h3>Interpretation</h3>
                <p class="interpretation_content" ondblclick="editText('interpretation_content')">
                    In normal healthy individuals, CRP levels generally do not exceed 6 mg/L...
                    <!-- Add full interpretation text -->
                </p>
            </section>

            <footer>
                <p>THIS REPORT IS NOT MEANT FOR MEDICO-LEGAL PURPOSE</p>
            </footer>
        </div>

        <!-- Download Button -->
        <div class="text-center my-4">
            <button id="download-btn" class="btn btn-primary">Download Report PDF</button>
            <a id="back-btn" href="{{ route('admin.report.view.report', $report->id) }}" class="btn btn-secondary d-inline-block">Back</a>
            <a id="receipt-btn" href="{{ route('admin.report.receipt.report', $report->id) }}" class="btn btn-success d-inline-block">Receipt</a>
        </div>
    </div>

    <!-- Bootstrap and jsPDF libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        function editText(className) {
            // Get the element by className
            const element = document.querySelector(`.${className}`);
            const currentText = element.textContent || element.innerText;

            // Create an input field with the current text as value
            const input = document.createElement('input');
            input.type = 'text';
            input.value = currentText;
            input.classList.add('editable');
            input.classList.add('form-control');

            // Replace the element with the input field
            element.innerHTML = '';
            element.appendChild(input);

            // Focus on the input field
            input.focus();

            // Add event listener to save the new text when the user clicks outside (on blur)
            input.addEventListener('blur', function() {
                // Get the new value from the input field
                const newText = input.value;
                // Replace the input field with the new text
                element.innerHTML = newText;
            });
        }

        document.getElementById('download-btn').addEventListener('click', async function() {
            const {
                jsPDF
            } = window.jspdf;
            const reportElement = document.getElementById('report');
            html2canvas(reportElement, {
                scale: 3
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210;
                const pageHeight = 295;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                // Add the first image
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                // Add additional pages if needed
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                // Save the PDF with dynamic name
                pdf.save("pathology_report.pdf");
            });
        });
    </script>
</body>

</html>
