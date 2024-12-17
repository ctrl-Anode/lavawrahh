<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login - Fitness Gym Administrator</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'nunito': ['Nunito', 'sans-serif'],
                        'oswald': ['Oswald', 'sans-serif'],
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
    </style>
</head>
<body class="h-full font-nunito text-white bg-gym">
    <div class="h-full bg-black bg-opacity-70 flex flex-col">
        <nav class="bg-black bg-opacity-80 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex">
                        <a class="flex items-center text-2xl font-oswald font-bold text-yellow-500" href="<?=site_url();?>">
                            PERFECT FITNESS GYM
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a class="text-gray-300 hover:text-yellow-500 px-3 py-2 rounded-md text-lg font-medium transition duration-300" href="<?=site_url('user/user_login');?>">Login</a>
                        <a class="text-gray-300 hover:text-yellow-500 px-3 py-2 rounded-md text-lg font-medium transition duration-300" href="<?=site_url('user/user_register');?>">Register</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow py-8">
            <div class="max-w-md mx-auto py-6 sm:px-6 lg:px-8">
                <div class="bg-black bg-opacity-80 rounded-lg overflow-hidden shadow-2xl">
                    <div class="px-6 py-4 bg-yellow-600 border-b border-yellow-700">
                        <h2 class="text-2xl font-oswald font-bold text-white">USER LOGIN</h2>
                    </div>
                    <div class="p-6">
                        <?php flash_alert(); ?>
                        <form id="logForm" method="POST" action="<?=site_url('user/user_login');?>">
                            <?php csrf_field(); ?>
                            <div class="mb-5">
                                <label for="username" class="block text-gray-300 text-sm font-semibold mb-2">Username</label>
                                <input id="username" type="text" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300" name="uname" minlength="5" required autocomplete="off">
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block text-gray-300 text-sm font-semibold mb-2">Email Address</label>
                                <?php $LAVA =& lava_instance(); ?>
                                <input id="email" type="email" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300 <?=$LAVA->session->flashdata('is_invalid');?>" name="email" value="" required autocomplete="email" autofocus>
                                <span class="text-red-500 text-xs italic mt-1" role="alert">
                                    <strong><?php echo $LAVA->session->flashdata('err_message'); ?></strong>
                                </span>
                            </div>
                            <div class="mb-6">
                                <label for="password" class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                                <input id="password" type="password" class="appearance-none border rounded w-full py-3 px-4 text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300" name="password" minlength="8" required autocomplete="current-password">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                                    LOGIN
                                </button>
                                <a class="inline-block align-baseline font-bold text-sm text-yellow-500 hover:text-yellow-400 transition duration-300" href="<?=site_url('user/user_password-reset');?>">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-black bg-opacity-80 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h5 class="text-xl font-oswald font-bold text-yellow-500 mb-4">PERFECT FITNESS GYM</h5>
                    </div>
                    <div>
                        <h5 class="text-xl font-oswald font-bold text-yellow-500 mb-4">Quick Links</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-yellow-500 transition duration-300">Home</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-yellow-500 transition duration-300">About</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-yellow-500 transition duration-300">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-xl font-oswald font-bold text-yellow-500 mb-4">Contact Us</h5>
                        <address class="text-gray-300">
                            123 Gym Street<br>
                            Fitness City, FC 12345<br>
                            Phone: (123) 456-7890
                        </address>
                    </div>
                </div>
                <hr class="my-6 border-gray-700">
                <div class="text-center text-gray-300">
                    <p>&copy; 2023 Perfect Fitness Gym. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var logForm = $("#logForm")
            if(logForm.length) {
                logForm.validate({
                    rules: {
                        uname: {
                            required: true,
                            minlength: 5
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        uname: {
                            required: "Please enter your username.",
                            minlength: "Your username must be at least 5 characters long."
                        },
                        email: {
                            required: "Please enter your email address.",
                            email: "Please enter a valid email address."
                        },
                        password: {
                            required: "Please enter your password.",
                            minlength: "Your password must be at least 8 characters long."
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