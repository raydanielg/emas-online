<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ClassController as AdminClassController;
use App\Http\Controllers\Admin\SchoolLevelController;
use App\Http\Controllers\Admin\SchoolCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ResultController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\DataManagementController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\User\SchoolClassController;
use App\Http\Controllers\User\RoomController;
use App\Http\Controllers\User\ExamController as UserExamController;
use App\Http\Controllers\User\MarkController;
use App\Http\Controllers\User\GradeController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\AcademicSettingController;
use App\Http\Controllers\User\TeacherController as UserTeacherController;
use App\Http\Controllers\User\UserResultController;
use App\Http\Controllers\User\ResultDraftController;
use App\Http\Controllers\User\ActivityController;
use App\Http\Controllers\User\UserController as SchoolUserController;
use App\Http\Controllers\User\SchoolSetupController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\StudentController as UserStudentController;
use App\Http\Controllers\User\SubjectController as UserSubjectController;
use App\Http\Controllers\User\TeacherManagementController;
use App\Http\Controllers\User\SchoolInfoController;

use App\Http\Controllers\PublicResourcesController;

Route::get('/', function () {
    return view('welcome');
});

// 🌍 Public Results Portal
Route::prefix('results-portal')->group(function () {
    Route::get('/', [PublicResultsController::class, 'index'])->name('public.results.index');
    Route::get('/year/{year}', [PublicResultsController::class, 'showSchools'])->name('public.results.schools');
    Route::get('/year/{year}/school/{school}', [PublicResultsController::class, 'showExams'])->name('public.results.exams');
    Route::get('/year/{year}/school/{school}/exam/{exam}', [PublicResultsController::class, 'viewResults'])->name('public.results.view');
});

// 📚 Public Resources Portal
Route::get('/resources-portal', [PublicResourcesController::class, 'index'])->name('public.resources.index');

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return view('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // 🏫 Schools Management
    Route::prefix('schools')->group(function () {
        Route::get('/', [SchoolController::class, 'index'])->name('schools.index');
        Route::get('/pending', [SchoolController::class, 'pending'])->name('schools.pending');
        Route::get('/approved', [SchoolController::class, 'approved'])->name('schools.approved');
        Route::get('/rejected', [SchoolController::class, 'rejected'])->name('schools.rejected');
        Route::get('/create', [SchoolController::class, 'create'])->name('schools.create');
        Route::post('/store', [SchoolController::class, 'store'])->name('schools.store');
        
        Route::get('/categories-list', [SchoolCategoryController::class, 'index'])->name('schools.categories.index');
        Route::post('/categories/seed', [SchoolCategoryController::class, 'seed'])->name('schools.categories.seed');
        Route::post('/categories-list', [SchoolCategoryController::class, 'store'])->name('schools.categories.store');
        Route::delete('/categories-list/{category}', [SchoolCategoryController::class, 'destroy'])->name('schools.categories.destroy');
        
        Route::get('/levels-list', [SchoolLevelController::class, 'index'])->name('schools.levels.index');
        Route::post('/levels/seed', [SchoolLevelController::class, 'seed'])->name('schools.levels.seed');
        Route::post('/levels-list', [SchoolLevelController::class, 'store'])->name('schools.levels.store');
        Route::delete('/levels-list/{level}', [SchoolLevelController::class, 'destroy'])->name('schools.levels.destroy');
        
        Route::get('/rankings', [SchoolController::class, 'rankings'])->name('schools.rankings');

        Route::patch('/{school}/quick-approve', [SchoolController::class, 'quickApprove'])
            ->name('schools.quickApprove');

        // Hizi ziwe mwisho ili zisichukue nafasi ya routes maalum hapo juu
        Route::get('/{school}', [SchoolController::class, 'show'])->name('schools.show');
        Route::get('/{school}/edit', [SchoolController::class, 'edit'])->name('schools.edit');
        Route::put('/{school}', [SchoolController::class, 'update'])->name('schools.update');
        Route::delete('/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');
    });

    // 🏫 Classes Management
    Route::prefix('classes')->group(function () {
        Route::get('/', [AdminClassController::class, 'index'])->name('admin.classes.index');
        Route::get('/create', [AdminClassController::class, 'create'])->name('admin.classes.create');
        Route::post('/store', [AdminClassController::class, 'store'])->name('admin.classes.store');
        Route::delete('/{class}', [AdminClassController::class, 'destroy'])->name('admin.classes.destroy');
    });

    // 👥 Users Management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/active', [UserController::class, 'active'])->name('users.active');
        Route::get('/suspended', [UserController::class, 'suspended'])->name('users.suspended');
        Route::patch('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
        Route::get('/school', [UserController::class, 'index'])->name('users.school');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/logs', [UserController::class, 'logs'])->name('users.logs');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // 📊 Results Management
    Route::prefix('results')->group(function () {
        Route::get('/', [ResultController::class, 'index'])->name('results.index');
        Route::get('/school', [ResultController::class, 'school'])->name('results.school');
        Route::get('/region', [ResultController::class, 'region'])->name('results.region');
        Route::get('/approvals', [ResultController::class, 'approvals'])->name('results.approvals');
        Route::get('/create', [ResultController::class, 'create'])->name('results.create');
        Route::post('/store', [ResultController::class, 'store'])->name('results.store');
        Route::get('/{result}', [ResultController::class, 'show'])->name('results.show');
        Route::get('/{result}/edit', [ResultController::class, 'edit'])->name('results.edit');
        Route::put('/{result}', [ResultController::class, 'update'])->name('results.update');
        Route::delete('/{result}', [ResultController::class, 'destroy'])->name('results.destroy');
    });

    // 🎓 Students Management
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/school', [StudentController::class, 'school'])->name('students.school');
        Route::get('/promote', [StudentController::class, 'promote'])->name('students.promote');
        Route::get('/import', [StudentController::class, 'import'])->name('students.import');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{student}', [StudentController::class, 'show'])->name('students.show');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    // 📚 Subjects Management
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');
        Route::get('/subjects-list', [SubjectController::class, 'index']);
        Route::post('/subjects/seed', [SubjectController::class, 'seed'])->name('subjects.seed');
        Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
        Route::post('/subjects/store', [SubjectController::class, 'store'])->name('subjects.store');
        Route::get('/categories', [SubjectController::class, 'index'])->name('subjects.categories');
        Route::get('/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
        Route::get('/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
        Route::put('/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
        Route::delete('/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    });

    // 📈 Analytics & Reports
    Route::prefix('reports')->group(function () {
        Route::get('/national', [AnalyticsController::class, 'national'])->name('reports.national');
        Route::get('/regional', [AnalyticsController::class, 'regional'])->name('reports.regional');
        Route::get('/rankings', [AnalyticsController::class, 'rankings'])->name('reports.rankings');
    });

    // 💰 Payments & Subscriptions
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/subscriptions', [PaymentController::class, 'subscriptions'])->name('payments.subscriptions');
        Route::get('/approvals', [PaymentController::class, 'approvals'])->name('payments.approvals');
        Route::patch('/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
    });

    // 📩 Communication
    Route::prefix('communication')->group(function () {
        Route::get('/sms', [CommunicationController::class, 'sms'])->name('communication.sms');
        Route::get('/email', [CommunicationController::class, 'email'])->name('communication.email');
        Route::get('/announcements', [CommunicationController::class, 'announcements'])->name('communication.announcements');
    });

    // ⚙️ Settings
    Route::prefix('settings')->group(function () {
        Route::get('/general', [SettingController::class, 'general'])->name('settings.general');
        Route::get('/gateways', [SettingController::class, 'gateways'])->name('settings.gateways');
        Route::get('/backup', [SettingController::class, 'backup'])->name('settings.backup');
    });

    // 📝 Exams Management
    Route::resource('exams', ExamController::class);
    Route::patch('exams/{exam}/publish', [ExamController::class, 'publish'])->name('exams.publish');

    // 👤 Profile
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // 🔐 Security & Access
    Route::get('/roles', [SecurityController::class, 'roles'])->name('security.roles');
    Route::get('/permissions', [SecurityController::class, 'permissions'])->name('security.permissions');
    Route::get('/logs', [SecurityController::class, 'logs'])->name('security.logs');

    // � Blog & News
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/store', [NewsController::class, 'store'])->name('news.store');
        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    });
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/school/setup', [SchoolSetupController::class, 'create'])
        ->name('user.school.setup');
    Route::post('/school/setup', [SchoolSetupController::class, 'store'])
        ->name('user.school.setup.store');

    Route::middleware(['ensure.school'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // 2️⃣ Student Management
    Route::prefix('students')->group(function () {
        Route::get('/', [UserStudentController::class, 'index'])->name('user.students.index');
        Route::get('/manage', [UserStudentController::class, 'manage'])->name('user.students.manage');
        Route::get('/create', [UserStudentController::class, 'create'])->name('user.students.create');
        Route::post('/store', [UserStudentController::class, 'store'])->name('user.students.store');
        Route::get('/{student}/edit', [UserStudentController::class, 'edit'])->name('user.students.edit');
        Route::put('/{student}', [UserStudentController::class, 'update'])->name('user.students.update');
        Route::delete('/{student}', [UserStudentController::class, 'destroy'])->name('user.students.destroy');
        Route::get('/promote', [UserStudentController::class, 'promote'])->name('user.students.promote');
        Route::get('/import', [UserStudentController::class, 'import'])->name('user.students.import');
    });

    // 3️⃣ Class Management
    Route::get('/classes/assign', [SchoolClassController::class, 'assign'])->name('user.classes.assign');
    Route::post('/classes/assign', [SchoolClassController::class, 'storeAssignment'])->name('user.classes.assign.store');
    Route::resource('classes', SchoolClassController::class)->except(['create', 'store'])->names('user.classes');

    // 4️⃣ Rooms Management
    Route::resource('rooms', RoomController::class)->names('user.rooms');

    // 5️⃣ Subjects Management
    Route::prefix('subjects')->group(function () {
        Route::get('/', [UserSubjectController::class, 'index'])->name('user.subjects.index');
        Route::get('/import', [UserSubjectController::class, 'import'])->name('user.subjects.import');
        Route::post('/import', [UserSubjectController::class, 'storeImport'])->name('user.subjects.import.store');
        Route::get('/assign', [UserSubjectController::class, 'assign'])->name('user.subjects.assign');
        Route::post('/assign', [UserSubjectController::class, 'storeAssignment'])->name('user.subjects.assign.store');
        Route::delete('/assign/remove-single', [UserSubjectController::class, 'removeSingleAssignment'])->name('user.subjects.assign.remove_single');
        Route::delete('/{subject}/remove', [UserSubjectController::class, 'remove'])->name('user.subjects.remove');
        
        // Subject Teachers
        Route::get('/teachers', [\App\Http\Controllers\User\SubjectTeacherController::class, 'index'])->name('user.subjects.teachers.index');
        Route::post('/teachers', [\App\Http\Controllers\User\SubjectTeacherController::class, 'store'])->name('user.subjects.teachers.store');
        Route::get('/teachers/class-subjects', [\App\Http\Controllers\User\SubjectTeacherController::class, 'getClassSubjects'])->name('user.subjects.teachers.class_subjects');
        Route::post('/teachers/assign', [\App\Http\Controllers\User\SubjectTeacherController::class, 'assignSubject'])->name('user.subjects.teachers.assign');
        Route::delete('/teachers/{teacher}', [\App\Http\Controllers\User\SubjectTeacherController::class, 'destroy'])->name('user.subjects.teachers.destroy');
    });

    // 6️⃣ Exam Management
    Route::resource('exams', ExamController::class)->names('user.exams');
    Route::get('/exams-timetable', [ExamController::class, 'index'])->name('user.exams.timetable');

    // 7️⃣ Marks Management
    Route::prefix('marks')->group(function () {
        Route::get('/entry', [MarkController::class, 'index'])->name('user.marks.entry');
        Route::get('/import', [MarkController::class, 'index'])->name('user.marks.import');
        Route::get('/rankings', [MarkController::class, 'index'])->name('user.marks.rankings');
    });

    // 8️⃣ Grades Management
    Route::prefix('grades')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('user.grades.index');
        Route::get('/gpa', [GradeController::class, 'index'])->name('user.grades.gpa');
    });

    // 9️⃣ Reports Management
    Route::prefix('reports')->group(function () {
        Route::get('/cards', [ReportController::class, 'index'])->name('user.reports.cards');
        Route::get('/class', [ReportController::class, 'index'])->name('user.reports.class');
        Route::get('/school', [ReportController::class, 'index'])->name('user.reports.school');
    });

    // 🔟 Academic Settings
    Route::get('/academic/settings', [AcademicSettingController::class, 'index'])->name('user.academic.settings');
    Route::put('/academic/years/current', [AcademicSettingController::class, 'updateCurrentYear'])->name('user.academic.years.current.update');
    Route::put('/academic/terms/current', [AcademicSettingController::class, 'updateCurrentTerm'])->name('user.academic.terms.current.update');

    // 1️⃣1️⃣ Teachers Management
    Route::prefix('teachers')->group(function () {
        Route::get('/', [TeacherManagementController::class, 'index'])->name('user.teachers.index');
        Route::get('/performance', [TeacherManagementController::class, 'performance'])->name('user.teachers.performance');
        Route::get('/assign-subjects', [TeacherManagementController::class, 'assignSubjects'])->name('user.teachers.assign_subjects');
        Route::post('/assign-subjects', [TeacherManagementController::class, 'storeAssignment'])->name('user.teachers.assign_subjects.store');
        Route::get('/assign-classes', [TeacherManagementController::class, 'assignClasses'])->name('user.teachers.assign_classes');
        Route::post('/assign-classes', [TeacherManagementController::class, 'storeClassAssignment'])->name('user.teachers.assign_classes.store');
    });

    // 1️⃣2️⃣ Results Management (Dashboard Submenu)
    Route::get('/results/latest', [UserResultController::class, 'latest'])->name('user.results.latest');
    Route::get('/results/drafts', [ResultDraftController::class, 'index'])->name('user.results.drafts');

    // 1️⃣3️⃣ Activity Management
    Route::get('/activities', [ActivityController::class, 'index'])->name('user.activities.index');

    Route::get('/academic/school-info', [SchoolInfoController::class, 'show'])->name('user.academic.school.info');
    Route::get('/academic/school-info/edit', [SchoolInfoController::class, 'edit'])->name('user.academic.school.edit');
    Route::put('/academic/school-info', [SchoolInfoController::class, 'update'])->name('user.academic.school.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
