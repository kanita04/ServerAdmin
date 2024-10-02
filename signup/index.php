<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <style>
        /* Modal Hidden by Default */
        .modal {
            display: none;
        }
        .modal-active {
            display: block;
        }
    </style>
</head>
<body>
    <div>
    <section
    class="ezy__signup14 light flex items-center justify-center py-14 md:py-24 text-black bg-cover bg-right bg-no-repeat relative"
    style="background-image: url(https://cdn.easyfrontend.com/pictures/background/background4.jpg)"
    >
    <div class="container px-4 mx-auto">
        <div class="flex justify-center">
        <div class="w-full md:w-2/3">
            <div class="bg-white shadow-xl p-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-1/2">
                <div class="flex items-center justify-center h-full">
                    <img
                    src="https://cdn.easyfrontend.com/pictures/background/abstract-background3.jpg"
                    alt=""
                    class="max-h-[300px] w-full lg:max-h-full lg:h-full object-cover"
                    />
                </div>
                </div>
                <div class="w-full lg:w-1/2 mt-6 lg:mt-0 lg:pl-6">
                <div class="flex flex-col justify-center items-center text-center h-full p-2">
                    <h2 class="text-[26px] leading-none font-bold mb-2">REGISTRATION FORM</h2>
                    <form class="w-full mt-6" method="POST" action="">
                    <div class="flex justify-center mb-4">
                        <input
                        type="text"
                        class="border-b border-black focus:outline-none focus:border-blue-600 py-2 text-sm w-1/2 mr-2"
                        id="fname"
                        name="fname"
                        placeholder="First Name"
                        />
                        <input
                        type="text"
                        class="border-b border-black focus:outline-none focus:border-blue-600 py-2 text-sm w-1/2 ml-2"
                        id="lname"
                        name="lname"
                        placeholder="Last Name"
                        />
                    </div>
                    <div class="w-full relative mb-4">
                        <input
                        type="text"
                        class="border-b border-black focus:outline-none focus:border-blue-600 text-sm w-full py-2"
                        id="uname"
                        name="uname"
                        placeholder="Username"
                        />
                    </div>
                    <div class="w-full relative mb-4">
                        <input
                        type="email"
                        class="border-b border-black focus:outline-none focus:border-blue-600 text-sm w-full py-2"
                        id="email"
                        name="email"
                        placeholder="Email Address"
                        />
                    </div>
                    <div class="w-full relative mb-4">
                        <input
                        type="password"
                        class="border-b border-black focus:outline-none focus:border-blue-600 text-sm w-full py-2"
                        id="pass"
                        name="pass"
                        placeholder="Password"
                        />
                    </div>
                    <div class="w-full relative mb-4">
                        <input
                        type="password"
                        class="border-b border-black focus:outline-none focus:border-blue-600 text-sm w-full py-2"
                        id="con-pass"
                        name="con-pass"
                        placeholder="Confirm Password"
                        />
                    </div>

                    <input type="submit" class="bg-gray-700 py-4 px-10 text-white hover:bg-opacity-95 mt-4" value="Signup">

                    <div class="text-center mt-4">
                        <p class="mb-0 text-sm">
                        Already have an account?
                        <a href="#!" class="hover:text-blue-600">Log In</a>
                        </p>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    </div>

    <!-- Modal for Signup Failure -->
    <div id="failureModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-5 w-1/3">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Signup Failed</h2>
                <button id="closeFailureModal" class="text-gray-500">&times;</button>
            </div>
            <p class="mt-4">There was a problem with your signup. Please try again.</p>
        </div>
    </div>

    <!-- Modal for Signup Success -->
    <div id="successModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-5 w-1/3">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Signup Successful!</h2>
                <button id="closeSuccessModal" class="text-gray-500">&times;</button>
            </div>
            <p class="mt-4">You have successfully signed up. You will be redirected shortly.</p>
        </div>
    </div>

<?php
include '../config/database.php';

$db = new Database();
$showFailureModal = false; // Variable to control failure modal display
$showSuccessModal = false; // Variable to control success modal display

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $email = $_POST['email'];

    if ($db->signup($first_name, $last_name, $username, $password, $email)) {
        $showSuccessModal = true; // Show success modal
        // Add a short delay before redirection
        echo '<script>
            setTimeout(function() {
                window.location.href = "../login/index.php";
            }, 2000); // 2 seconds delay
        </script>';
    } else {
        $showFailureModal = true; // Show failure modal
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const failureModal = document.getElementById("failureModal");
        const closeFailureModal = document.getElementById("closeFailureModal");

        const successModal = document.getElementById("successModal");
        const closeSuccessModal = document.getElementById("closeSuccessModal");

        <?php if ($showFailureModal): ?>
            failureModal.classList.add("modal-active"); // Show failure modal
        <?php endif; ?>

        <?php if ($showSuccessModal): ?>
            successModal.classList.add("modal-active"); // Show success modal
        <?php endif; ?>

        closeFailureModal.addEventListener("click", function() {
            failureModal.classList.remove("modal-active"); // Hide failure modal
        });

        closeSuccessModal.addEventListener("click", function() {
            successModal.classList.remove("modal-active"); // Hide success modal
        });

        // Optional: Close modal when clicking outside of it
        failureModal.addEventListener("click", function(event) {
            if (event.target === failureModal) {
                failureModal.classList.remove("modal-active");
            }
        });

        successModal.addEventListener("click", function(event) {
            if (event.target === successModal) {
                successModal.classList.remove("modal-active");
            }
        });
    });
</script>

</body>
</html>
