<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .receipt-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
        }

        h1, h3 {
            text-align: center;
        }

        .table th, .table td {
            border: 1px solid #000 !important;
            padding: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-end {
            text-align: end;
        }
    </style>
</head>

<body>

    <div class="receipt-container" id="receipt">
        <h1>Anubhav Pathology Lab</h1>
        <p class="text-center">Nala Pani Chowk, Sahastradhara Road, Dehradun - 248001</p>
        <hr>
        <table class="w-100">
            <tr>
                <td>Receipt No.: 21-22/1/95</td>
                <td>Date: 29/04/2024</td>
            </tr>
            <tr>
                <td>Received From: Mrs. Sunita</td>
                <td>Age: 47 Yrs.</td>
            </tr>
            <tr>
                <td>Ref. By: Self</td>
                <td>Patient ID: 2404290133</td>
            </tr>
        </table>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Particulars</th>
                    <th>Charges (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>COMPLETE BLOOD COUNT</td>
                    <td>250</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>LIPID PROFILE</td>
                    <td>350</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>KFT</td>
                    <td>450</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>LFT</td>
                    <td>350</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>THYROID PROFILE</td>
                    <td>350</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>HB A1C</td>
                    <td>350</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>SUGAR PP</td>
                    <td>450</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>URINE EXAMINATION</td>
                    <td>150</td>
                </tr>
            </tbody>
        </table>
        <p class="text-end"><strong>Total Charge: ₹ 2600</strong></p>
        <p class="text-end">Total Discount: ₹ 1601</p>
        <p class="text-end"><strong>Net Charged: ₹ 999</strong></p>
    </div>

    <div class="text-center mt-4">
        <button id="download-btn" class="btn btn-primary">Download Receipt</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('download-btn').addEventListener('click', async function() {
            const { jsPDF } = window.jspdf;
            const receiptElement = document.getElementById('receipt');
            html2canvas(receiptElement, { scale: 3 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, 'PNG', 0, 10, imgWidth, imgHeight);
                pdf.save("receipt.pdf");
            });
        });
    </script>
</body>

</html>
