<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eMaS - Electronic Marking System</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('prem.icon.png')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #004d40 0%, #00695c 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-pattern {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            opacity: 0.1;
            background-image: radial-gradient(#fff 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .hero-circle {
            position: absolute;
            width: 400px; height: 400px;
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 50%;
            top: -100px; left: -100px;
        }
        .feature-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
            border-color: #cbd5e1;
        }
        .btn-outline {
            border: 1px solid rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="hero-gradient text-white pb-20 pt-6">
        <div class="hero-pattern"></div>
        <div class="hero-circle"></div>
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex justify-between items-center mb-16">
                <div class="flex items-center space-x-3 text-left">
                    <div class="bg-white p-2 rounded-lg text-teal-800 font-bold text-2xl tracking-tighter">
                        <span class="text-yellow-500">e</span>MaS
                    </div>
                    <div class="hidden md:block">
                        <p class="text-xs uppercase opacity-80 leading-tight">Electronic Marking System</p>
                        <p class="text-sm font-semibold">eMaS - SIS</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?php echo e(route('public.results.index')); ?>" class="hidden lg:block px-4 py-2 text-sm btn-outline rounded-lg">Results</a>
                    <a href="<?php echo e(route('public.resources.index')); ?>" class="hidden lg:block px-4 py-2 text-sm btn-outline rounded-lg">Resources</a>
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>" class="px-6 py-2 bg-white text-teal-900 font-bold rounded-lg hover:bg-gray-100 transition shadow-lg">Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="px-6 py-2 btn-outline text-white font-bold rounded-lg transition border-white">Sign In</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </nav>

            <div class="flex flex-col lg:flex-row items-center justify-between text-left">
                <div class="lg:w-2/3 mb-12 lg:mb-0">
                    <h2 class="text-teal-300 text-lg font-semibold mb-2">Regional Administration and Local Government</h2>
                    <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">eMaS - Electronic <br>Marking System</h1>
                    <p class="text-lg opacity-90 max-w-2xl mb-8">A comprehensive platform designed to streamline examination results management and educational operations for academic excellence and efficient student assessments.</p>
                    
                    <!-- Mobile Buttons (Visible only on small screens) -->
                    <div class="flex items-center space-x-3 md:hidden mb-8">
                        <a href="<?php echo e(route('public.results.index')); ?>" class="flex-1 text-center px-4 py-2 text-sm btn-outline rounded-lg">Results</a>
                        <a href="<?php echo e(route('public.resources.index')); ?>" class="flex-1 text-center px-4 py-2 text-sm btn-outline rounded-lg">Resources</a>
                    </div>
                </div>
                <div class="hidden lg:block lg:w-1/3">
                    <div class="relative text-center">
                        <div class="absolute -inset-4 bg-teal-400/20 blur-3xl rounded-full"></div>
                        <i class="fas fa-university text-[200px] text-teal-400/20 relative z-10"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-12 bg-white border-b text-left">
        <div class="container mx-auto px-6">
            <p class="text-gray-600 leading-relaxed max-w-5xl">This comprehensive suite of services provides a robust system for managing various aspects of school operations, from <strong>Student Registration</strong> to <strong>Continuous Assessment</strong> and <strong>Student Promotions</strong>. Key features include tracking <strong>Student and Teacher Attendance</strong> to ensure consistent participation, as well as <strong>Behavioral Assessment</strong> tools to support students' personal development.</p>
            <div class="mt-8 flex items-center">
                <span class="inline-block w-1 h-6 bg-teal-600 mr-3"></span>
                <span class="text-xs font-bold uppercase tracking-widest text-teal-700">Services</span>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl feature-card text-center shadow-sm">
                    <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6"><i class="fas fa-user-graduate text-teal-600 text-2xl"></i></div>
                    <h3 class="text-xl font-bold mb-4">Students Registration</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Register and manage student records including personal details, enrollment information, and more.</p>
                </div>
                <div class="bg-white p-8 rounded-xl feature-card text-center shadow-sm">
                    <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6"><i class="fas fa-calendar-check text-teal-600 text-2xl"></i></div>
                    <h3 class="text-xl font-bold mb-4">Students Attendance</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Track student attendance records to monitor class participation and presence.</p>
                </div>
                <div class="bg-white p-8 rounded-xl feature-card text-center shadow-sm">
                    <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6"><i class="fas fa-smile text-teal-600 text-2xl"></i></div>
                    <h3 class="text-xl font-bold mb-4">Behavioral Assessment</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Manage student behaviors and disciplinary records to support positive development.</p>
                </div>
                <div class="bg-white p-8 rounded-xl feature-card text-center shadow-sm">
                    <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6"><i class="fas fa-chart-line text-teal-600 text-2xl"></i></div>
                    <h3 class="text-xl font-bold mb-4">Continuous Assessment</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Record and track student academic progress through regular tests and assignments.</p>
                </div>
                <div class="bg-white p-8 rounded-xl feature-card text-center shadow-sm">
                    <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6"><i class="fas fa-book-reader text-teal-600 text-2xl"></i></div>
                    <h3 class="text-xl font-bold mb-4">Teaching Materials</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Access and manage educational resources, lesson plans, and teaching aids for staff.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-teal-950 text-white py-12 text-center">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="bg-white p-1 rounded">
                    <span class="text-teal-900 font-bold text-xl tracking-tighter px-2">
                        <span class="text-yellow-600">e</span>MaS
                    </span>
                </div>
                <span class="text-lg font-semibold">Electronic Marking System</span>
            </div>
            <p class="text-teal-400 text-sm opacity-80">&copy; <?php echo e(date('Y')); ?> <span class="text-yellow-600">e</span>MaS. All rights reserved.</p>
        </div>
    </footer>
</body>
</html><?php /**PATH E:\ZERIXA\WebApps\emas\resources\views/welcome.blade.php ENDPATH**/ ?>