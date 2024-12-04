<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .receipt-container {
            max-width: 700px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h3 {
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .receipt-header p {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 10px;
        }

        .receipt-header hr {
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #f1f1f1;
            color: #333;
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .text-end {
            text-align: right;
            font-weight: bold;
            color: #333;
        }

        .receipt-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .btn-download {
            display: block;
            margin: 20px auto;
            padding: 10px 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-download:hover {
            background-color: #0056b3;
        }

        .receipt-footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <div class="receipt-container" id="receipt">
        <div class="receipt-header">
            <h1>Anubhav Pathology Lab</h1>
            <p>Nala Pani Chowk, Sahastradhara Road, Dehradun - 248001</p>
            <hr>
            <table class="w-100">
                <tr>
                    <td><strong>Receipt No.:</strong> <span id="receipt-no">21-22/1/95</span></td>
                    <td><strong>Date:</strong> <span id="date">29/04/2024</span></td>
                </tr>
                <tr>
                    <td><strong>Received From:</strong> <span id="patient-name">Mrs. Sunita</span></td>
                    <td><strong>Age:</strong> <span id="age">47 Yrs.</span></td>
                </tr>
                <tr>
                    <td><strong>Ref. By:</strong> <span id="ref-by">Self</span></td>
                    <td><strong>Patient ID:</strong> <span id="patient-id">2404290133</span></td>
                </tr>
            </table>
        </div>

        <div class="receipt-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>S. No</th>
                        <th>Particulars</th>
                        <th>Charges (₹)</th>
                    </tr>
                </thead>
                <tbody id="receipt-items">
                    <!-- Dynamic items will be injected here -->
                </tbody>
            </table>

            <div class="text-end">
                <p><strong>Total Charge:</strong> ₹ <span id="total-charge">2600</span></p>
                <p>Total Discount: ₹ <span id="total-discount">1601</span></p>
                <p><strong>Net Charged:</strong> ₹ <span id="net-charged">999</span></p>
            </div>
        </div>

        <div class="receipt-footer">
            <p>Thank you for choosing Anubhav Pathology Lab. We hope to serve you again!</p>
        </div>
    </div>

    <div class="text-center">
        <button id="download-btn" class="btn-download">Download Receipt</button>
        <a id="back-btn" href="{{ route('admin.report.view.report', $report->id) }}" class="btn btn-secondary d-inline-block">Back</a>
            <a id="receipt-btn" href="{{ route('admin.report.receipt.report', $report->id) }}" class="btn btn-success d-inline-block">Receipt</a>
    </div>

    <!-- Include html2pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
        // Adding dynamic data to the receipt
        document.getElementById('receipt-no').innerText = '21-22/1/95';
        document.getElementById('date').innerText = '29/04/2024';
        document.getElementById('patient-name').innerText = 'Mrs. Sunita';
        document.getElementById('age').innerText = '47 Yrs.';
        document.getElementById('ref-by').innerText = 'Self';
        document.getElementById('patient-id').innerText = '2404290133';
        document.getElementById('total-charge').innerText = '2600';
        document.getElementById('total-discount').innerText = '1601';
        document.getElementById('net-charged').innerText = '999';

        // Receipt Items (Dynamic Data)
        const items = [{
                name: 'COMPLETE BLOOD COUNT',
                price: 250
            },
            {
                name: 'LIPID PROFILE',
                price: 350
            },
            {
                name: 'KFT',
                price: 450
            },
            {
                name: 'LFT',
                price: 350
            },
            {
                name: 'THYROID PROFILE',
                price: 350
            },
            {
                name: 'HB A1C',
                price: 350
            },
            {
                name: 'SUGAR PP',
                price: 450
            },
            {
                name: 'URINE EXAMINATION',
                price: 150
            }
        ];

        const receiptItemsContainer = document.getElementById('receipt-items');
        items.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `<td>${index + 1}</td><td>${item.name}</td><td>${item.price}</td>`;
            receiptItemsContainer.appendChild(row);
        });

        // Button click to download the receipt as a PDF
        document.getElementById('download-btn').addEventListener('click', function() {
            const receipt = document.getElementById('receipt');
            const opt = {
                margin: 0.5,
                filename: 'receipt.pdf',
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                },
                html2canvas: {
                    useCORS: true,
                    logging: false,
                    scale: 2
                }
            };
            html2pdf().from(receipt).set(opt).save();
        });
    </script>

</body>

</html>
