<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration & Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group input, textarea {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
        }
        .btn {
            width: 100%;
        }
        /* Centering login modal */
        .modal-content {
            padding: 20px;
        }
        #loginTable {
            margin-top: 20px;
        }

        .table-responsive {
    overflow-x: auto;
    max-width: 100%;
}
.table {
    width: 100%;
    white-space: nowrap;
}

    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Registration Form</h2>
    <form action="process.php" method="post">
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <input type="number" name="phone" placeholder="Mobile No" required>
        </div>
        <div class="form-group">
            <textarea name="add" placeholder="Enter Address" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
    <br>
    <button class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button>
</div>

<!-- LOGIN POPUP MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="form-group">
                        <input type="email" id="loginEmail" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="loginPassword" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table to Show Data After Login -->
<div class="container" id="loginTable" style="display: none;">
    <h3 class="text-center">Student Data</h3>
    <div class="table-responsive"> <!-- ✅ Makes table scrollable -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody id="studentData"></tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#loginForm").submit(function (e) {
            e.preventDefault();
            var email = $("#loginEmail").val();
            var password = $("#loginPassword").val();

            $.post("login.php", { email: email, password: password }, function (data) {
                if (data == "invalid") {
                    alert("Invalid Credentials!");
                } else {
                    $("#loginModal").modal("hide");
                    $("#loginTable").show();
                    $("#studentData").html(data);
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
