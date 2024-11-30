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

        #download-btn {
            background-color: #0073e6;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            display: block;
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
            <header>
                <h1>ANUBHAV PATHOLOGY LAB</h1>
                <p>Nala Pani Chowk, Sahastradhara Road, Adjoining Jagdamba Gas Agency, Dehra Dun - 248001</p>
                <p>Working Hours: 7:00 AM to 8:30 PM | Sunday Open</p>
                <p>Email ID: anubhavpathologylab@gmail.com | Phones: 8650270860, 8077014570</p>
            </header>

            <section class="patient-info">
                <p><strong>Date:</strong> 04/10/2024 &nbsp; <strong>Sr No.:</strong> 128</p>
                <p><strong>Patient ID:</strong> 2410040128 &nbsp; <strong>Age:</strong> 58 Yrs. &nbsp;
                    <strong>Sex:</strong> M
                </p>
                <p><strong>Ref. By:</strong> Self &nbsp; <strong>Name:</strong> Dr. V.S. Kapri</p>
            </section>

            <section class="test-results">
                <h2>Complete Blood Count (CBC)</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Value</th>
                            <th>Unit</th>
                            <th>Normal Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Haemoglobin (Hb)</td>
                            <td>12.2</td>
                            <td>gm/dl</td>
                            <td>13.5 - 17.5</td>
                        </tr>
                        <tr>
                            <td>Total Leucocyte Count (TLC)</td>
                            <td>5550</td>
                            <td>/cumm</td>
                            <td>4000 - 11000</td>
                        </tr>
                        <tr>
                            <td>Neutrophil</td>
                            <td>58</td>
                            <td>%</td>
                            <td>40 - 75</td>
                        </tr>
                        <tr>
                            <td>Lymphocyte</td>
                            <td>35</td>
                            <td>%</td>
                            <td>20 - 45</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </section>

            <section class="serology">
                <h2>Serology</h2>
                <table class="table table-bordered">
                    <tr>
                        <td>CRP (Quantitative)</td>
                        <td>1.2</td>
                        <td>mg/L</td>
                        <td>0.0 - 6.0</td>
                    </tr>
                </table>
            </section>

            <section class="interpretation">
                <h3>Interpretation</h3>
                <p>
                    In normal healthy individuals, CRP levels generally do not exceed 6 mg/L...
                    <!-- Add full interpretation text -->
                </p>
            </section>

            <footer>
                <p>THIS REPORT IS NOT MEANT FOR MEDICO-LEGAL PURPOSE</p>
            </footer>
        </div>

        <!-- Download Button -->
        <button id="download-btn" class="btn btn-primary">Download PDF</button>
    </div>

    <!-- Bootstrap and jsPDF libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
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
