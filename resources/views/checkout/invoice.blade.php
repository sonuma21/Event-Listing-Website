<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice #{{ $checkout->id }} - Event Registration</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
            color: #333;
            line-height: 1.5;
            font-size: 12px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            font-size: 12px;
            color: #666;
            margin: 5px 0;
        }
        .company-details {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #555;
            margin-bottom: 20px;
        }
        .company-details div {
            width: 45%;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .details-columns {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .details-column {
            flex: 1;
            font-size: 12px;
        }
        .details-column div {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .details-column div:last-child {
            border-bottom: none;
        }
        .details-column div strong {
            font-weight: bold;
            width: 40%;
        }
        .details-column div span {
            width: 60%;
            text-align: right;
        }
        .total-row strong, .total-row span {
            font-weight: bold;
            color: #333;
        }
        .download-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
        }
        .download-btn:hover {
            background: #218838;
        }
        .error-message {
            color: #d32f2f;
            font-size: 12px;
            text-align: center;
            margin-top: 10px;
            display: none;
        }
        .terms {
            font-size: 12px;
            color: #666;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .terms h3 {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        @media screen and (max-width: 600px) {
            .details-columns {
                flex-direction: column;
            }
            .company-details {
                flex-direction: column;
                gap: 10px;
            }
            .company-details div {
                width: 100%;
            }
        }
        @media print {
            body {
                padding: 0;
                background: #fff;
            }
            .container {
                border: none;
            }
            .download-btn, .error-message {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="invoice">
        <div class="header">
            <h1>Invoice</h1>
            <p>Invoice #{{ $checkout->id }}</p>
            <p>Issued on: {{ $checkout->created_at->format('F j, Y, g:i A') }}</p>
        </div>

        <div class="company-details">
            <div>
                <strong>From:</strong><br>
                {{ $checkout->event->organizer->name ?? 'Event Organizer' }}<br>
                {{ $checkout->event->location ?? 'N/A' }}<br>
                Email: {{ $checkout->event->organizer->email ?? 'contact@eventorganizer.com' }}<br>
                Phone: {{ $checkout->event->organizer->phone ?? 'N/A' }}
            </div>
            <div>
                <strong>To:</strong><br>
                {{ $checkout->user->name ?? 'Customer' }}<br>
                User ID: {{ $checkout->user_id }}<br>
                Email: {{ $checkout->user->email ?? 'N/A' }}
            </div>
        </div>

        <div class="invoice-details">
            <h2>Invoice Details</h2>
            <div class="details-columns">
                <div class="details-column">
                    <div>
                        <strong>Event</strong>
                        <span>{{ $checkout->event->title ?? 'Event #' . $checkout->event_id }}</span>
                    </div>
                    <div>
                        <strong>Ticket Quantity</strong>
                        <span>{{ $checkout->quantity }}</span>
                    </div>
                    <div class="total-row">
                        <strong>Total Amount</strong>
                        <span>NRs. {{ number_format($checkout->total_amount, 2) }}</span>
                    </div>
                    <div class="total-row">
                        <strong>Status</strong>
                        <span>{{ ucfirst($checkout->status) }}</span>
                    </div>
                </div>
                <div class="details-column">
                    <div>
                        <strong>Payment Method</strong>
                        <span>{{ ucfirst($checkout->payment_method) }}</span>
                    </div>
                    <div>
                        <strong>Transaction Date</strong>
                        <span>{{ $checkout->created_at->format('F j, Y, g:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <button class="download-btn" id="download-btn" onclick="downloadInvoice({{ $checkout->id }})">Download PDF</button>
        <p class="error-message" id="error-message"></p>

        <div class="terms">
            <h3>Terms & Conditions</h3>
            <p>
                - This invoice is valid for event registration only.<br>
                - Refunds, if applicable, will be processed as per the event organizer's policy.<br>
                - For support, contact us at {{ $checkout->event->organizer->email ?? 'contact@eventorganizer.com' }}.
            </p>
        </div>

        <div class="footer">
            <p>Thank you for choosing our platform!</p>
            <p>Event Organizer | Dharan, Nepal | Generated on {{ now()->format('F j, Y, g:i A') }}</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.downloadInvoice = function(checkoutId) {
                const element = document.getElementById('invoice');
                const downloadBtn = document.getElementById('download-btn');
                const errorMessage = document.getElementById('error-message');

                // Reset error message
                errorMessage.style.display = 'none';
                errorMessage.textContent = '';

                // Check if the invoice element exists
                if (!element) {
                    console.error('Error: Invoice element not found.');
                    errorMessage.textContent = 'Failed to generate PDF. Invoice content not found.';
                    errorMessage.style.display = 'block';
                    return;
                }

                // Temporarily hide download button and error message
                const originalBtnDisplay = downloadBtn.style.display;
                const originalErrorDisplay = errorMessage.style.display;
                downloadBtn.style.display = 'none';
                errorMessage.style.display = 'none';

                try {
                    html2pdf()
                        .set({
                            filename: `invoice_checkout_${checkoutId}.pdf`,
                            margin: 10,
                            jsPDF: {
                                unit: 'mm',
                                format: 'a4',
                                orientation: 'portrait'
                            },
                            html2canvas: {
                                scale: 2,
                                useCORS: true
                            }
                        })
                        .from(element)
                        .save()
                        .then(() => {
                            // Restore button and error message visibility
                            downloadBtn.style.display = originalBtnDisplay;
                            errorMessage.style.display = originalErrorDisplay;
                        })
                        .catch(error => {
                            console.error('Error generating PDF:', error);
                            errorMessage.textContent = 'Failed to generate PDF. Please try again or contact support.';
                            errorMessage.style.display = 'block';
                            // Restore button visibility on error
                            downloadBtn.style.display = originalBtnDisplay;
                        });
                } catch (error) {
                    console.error('Error initiating PDF download:', error);
                    errorMessage.textContent = 'Failed to generate PDF. Please try again or contact support.';
                    errorMessage.style.display = 'block';
                    downloadBtn.style.display = originalBtnDisplay;
                }
            };
        });
    </script>
</body>
</html>
