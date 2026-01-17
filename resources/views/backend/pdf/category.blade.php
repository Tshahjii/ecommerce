<!DOCTYPE html>
<html>

<head>
    <title>Categories</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Additional CSS Libraries -->
    <style>
        body {
            position: relative;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            /* Adjusted alignment */
            margin-bottom: 20px;
            padding: 10px;
        }

        .logo img {
            height: auto;
            width: 170px;
            /* Adjusted to a more reasonable width */
        }

        .company-info {
            text-align: right;
            font-size: 0.9em;
            line-height: 0.5;
            /* Reduced line height for closer spacing */
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.1;
            font-size: 4em;
            color: #000;
            font-weight: bold;
            z-index: -1;
            width: 100%;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            right: 10px;
            text-align: right;
            font-size: 0.9em;
            color: #555;
        }

        .footer-line {
            position: fixed;
            bottom: 30px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.2) 50%, rgba(0, 0, 0, 0.2) 100%);
            border-top: 1px solid #555;
            border-bottom: 1px solid #555;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .page-number {
            position: fixed;
            bottom: 10px;
            left: 10px;
            font-size: 0.9em;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 1px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .rounded-circle {
            width: 50px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="https://themesbrand.com/velzon/html/minimal/assets/images/logo-dark.png" alt="Company Logo">
        </div>
        <div class="company-info">
            <p><strong>ShahShop App</strong></p>
            <p>1234 Market St, Suite 500</p>
            <p>San Francisco, CA 94103</p>
            <p>Phone: (123) 456-7890</p>
            <p>Fax: (123) 456-7891</p>
            <p>GST: 27XXXXXXXXX1Z5</p>
        </div>
    </div>

    <div class="watermark">TINKU KUMAR SHAH</div>

    <h3>Categories:-</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Category</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $category)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $category->categories }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        @if ($category->status == 'active')
                            <span class="badge bg-primary-subtle text-primary"><i
                                    class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>
                        @elseif ($category->status == 'inactive')
                            <span class="badge bg-warning-subtle text-warning"><i
                                    class="ri-eye-off-line align-middle text-warning"></i>In-active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger"><i
                                    class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-line"></div>
    <div class="footer">
        &copy; 2026 ShahShop App. All rights reserved.
    </div>
    <div class="page-number">
        Page <span id="page-number"></span>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pageNumber = document.getElementById("page-number");
            var currentPage = 1; // Set this dynamically if needed
            pageNumber.innerText = currentPage;
        });
    </script>
</body>

</html>
