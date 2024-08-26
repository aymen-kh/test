<!-- resources/views/orders/invoice_redirect.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script>
        // Redirect to orders index after 6 seconds
        setTimeout(function() {
            window.location.href = "{{ route('orders.index') }}";
        }, 6000);
    </script>
</head>
<body>
    <h1>Invoice</h1>
    <iframe id="invoiceFrame" style="width: 100%; height: 100vh; border: none;"></iframe>
    <p>Your invoice will be displayed for 6 seconds. You will be redirected shortly.</p>
    <script>
        // Load the PDF content into the iframe
        document.getElementById('invoiceFrame').src = 'data:application/pdf;base64,{{ $pdfContent }}';
    </script>
</body>
</html>
