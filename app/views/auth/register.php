<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitness Gym Registration</title>  
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Roboto|Oswald:400,700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'oswald': ['Oswald', 'sans-serif'],
                        'roboto': ['Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .bg-gym {
            background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
        }
        .visually-hidden-focusable {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap; /* Prevent text wrap */
        border: 0;
    }

    /* Make the links visible when focused */
    .visually-hidden-focusable:focus {
        position: static;
        width: auto;
        height: auto;
        padding: 0.5rem;
        margin: 0;
        overflow: visible;
        clip: auto;
        white-space: normal; /* Allow text wrap */
        background: #f8f9fa; /* Optional: background color for focus */
        border: 1px solid #007bff; /* Optional: border color for focus */
        border-radius: 4px; /* Optional: rounded corners */
    }
    </style>
</head>
<body class="h-full font-roboto text-white bg-gym">
    <div class="h-full bg-black bg-opacity-70">
    <nav class="bg-black bg-opacity-80 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex">
                <a class="flex items-center text-2xl font-oswald font-bold text-yellow-500" href="<?=site_url();?>">
                    PERFECT FITNESS GYM
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a class="visually-hidden-focusable" href="<?=site_url('auth/login');?>">Login</a>
                <a class="visually-hidden-focusable" href="<?=site_url('auth/register');?>">Register</a>
            </div>
        </div>
    </div>
</nav>
        <main class="py-8">
            <div class="max-w-md mx-auto py-6 sm:px-6 lg:px-8">
                <div class="bg-black bg-opacity-80 rounded-lg overflow-hidden shadow-2xl">
                    <div class="px-6 py-4 bg-yellow-600 border-b border-yellow-700">
                        <h2 class="text-2xl font-oswald font-bold text-white">REGISTER YOUR ACCOUNT</h2>
                    </div>
                    <div class="p-6">
                        <?php flash_alert(); ?>
                        <form id="regForm" method="POST" action="<?=site_url('auth/register');?>">
                            <?php csrf_field(); ?>
                            <div class="mb-5">
                                <label for="username" class="block text-gray-300 text-sm font-semibold mb-2">Username</label>
                                <input id="username" type="text" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300" name="username" required>
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block text-gray-300 text-sm font-semibold mb-2">Email Address</label>
                                <input id="email" type="email" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300" name="email" value="" required>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                                <input id="password" type="password" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300" name="password" required>
                            </div>
                            <div class="mb-6">
                                <label for="password_confirmation" class="block text-gray-300 text-sm font-semibold mb-2">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300" name="password_confirmation" required>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                                    REGISTER
                                </button>
                                <a class="inline-block align-baseline font-bold text-sm text-yellow-500 hover:text-yellow-400 transition duration-300" href="<?=site_url('auth/login');?>">
                                    Already have an account?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var regForm = $("#regForm")
            if(regForm.length) {
                regForm.validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        username: {
                            required: "Please enter your username.",
                            minlength: "Your username must be at least 3 characters long."
                        },
                        email: {
                            required: "Please enter your email address.",
                            email: "Please enter a valid email address."
                        },
                        password: {
                            required: "Please enter your password.",
                            minlength: "Your password must be at least 8 characters long."
                        },
                        password_confirmation: {
                            required: "Please confirm your password.",
                            equalTo: "Passwords do not match."
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('text-red-500 text-xs italic mt-1');
                        element.closest('div').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('border-red-500');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('border-red-500');
                    }
                })
            }
        })
    </script>
</body>
</html>