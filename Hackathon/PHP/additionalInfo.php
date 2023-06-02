<!DOCTYPE html>
<html lang="en">

<head>
    <title>Personal Information</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'K2D', sans-serif;
        }

        :root {
            --primary-color: #8c2de2;
            --secondary-color: white;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }

        .SignUP-container {
            position: relative;
            width: 330px;
            padding: 250px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        #studentForm {
            margin-top: 25px;
        }

        .SignUP-Form {
            position: absolute;
            width: 40%;
            background-color: var(--secondary-color);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            top: 0;
            left: 0;
            height: 100%;

        }

        .SignUP-Form h2 {
            text-align: center;
            margin-top: 35px;
        }

        .form-group {
            margin-bottom: 20px;
            margin-left: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 85%;
            padding: 8px;
            border-radius: 2px;
            border: 1px solid rgba(0,0,0,0.5);
            border-radius: 50px;
        }
        .form-group select{
            width: 91%;
        }
        .form-group input[type="submit"] {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            cursor: pointer;
            padding: 8px 115px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            margin-left: 20px;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #493131;
        }

        .Skip {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            border: none;
            border-radius: 2px;
            padding: 8px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin: 10px 0px 0px 413px;
        }

        .Skip:hover {
            background-color: #ff0000;
        }

        .p_Image {
            position: absolute;
            width: 60%;
            border-radius: 5px;
            top: 0px;
            right: 0px;
            z-index: 1;
        }

        .Upload_Image {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 60%;
            background-color: rgba(0, 0, 0, 0.284);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            top: 0px;
            right: 0px;
            height: 100%;
            padding: -2px;
            text-align: center;

        }

        #photoPreview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #f2f2f2;
            margin-bottom: 10px;
            overflow: hidden;
        }

        #photoPreview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        #photoUpload {
            display: none;
        }

        #photoLabel {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            border: none;
            border-radius: 2px;
            padding: 8px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .photoPreview img {
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
        }

        #photoLabel:hover {
            background-color: #493131;
        }
    </style>
</head>

<body>
    <div class="SignUP-container">

        <div class="SignUP-Form">
            <h2>Profile Information</h2>
            <form action="./updateInfo.php" method="post" id="studentForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Enter your Address" required>
                </div>

                <div class="form-group">
                    <label for="faculty">Faculty:</label>
                    <select id="faculty" name="faculty" required>
                        <option value="" disabled selected>Select Faculty</option>
                        <option value="BBA">BBA</option>
                        <option value="BIT">BIT</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="year">Year:</label>
                    <select id="year" name="year" required>
                        <option value="" disabled selected>Select Year</option>
                        <option value="Year 1">Year 1</option>
                        <option value="Year 2">Year 2</option>
                        <option value="Year 3">Year 3</option>
                        <option value="Year 4">Year 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="group">Group:</label>
                    <input type="text" id="group" name="group" placeholder="Enter Your Group" required>
                </div>

                <input type="submit" value="Update">
            </div>
            <div class="p_Image">
                <button class="Skip">Skip</button>
            </div>
            <div class="Upload_Image">
                <h2>Upload Photo</h2>
                <div id="photoPreview"> </div>
                <input type="file" id="photoUpload" accept="image/*" name="profile">
                <label for="photoUpload" id="photoLabel">Choose Photo</label>
            </div>
        </form>
    </div>

    <script>
        // Skip button event listener
        const skipButton = document.querySelector('.Skip');
        skipButton.addEventListener('click', function () {
            window.location.href = './home.php';
        });

        // Photo upload functionality
        const photoUpload = document.getElementById('photoUpload');
        const photoPreview = document.getElementById('photoPreview');

        photoUpload.addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageSrc = e.target.result;
                const image = document.createElement('img');
                image.src = imageSrc;
                photoPreview.innerHTML = '';
                photoPreview.appendChild(image);
            };
            reader.readAsDataURL(file);
        });

    </script>



</body>

</html>