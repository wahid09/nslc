<?php

use App\Http\Controllers\Backend\FooterManagementController;
use App\Http\Controllers\Backend\SocialLinkController;
use App\Http\Controllers\Backend\TutorialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\AwardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProgramController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\PageContentController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\NoticeController;
use App\Http\Controllers\Backend\ShowRoomeController;
use App\Http\Controllers\Backend\SobanetryController;
use App\Http\Controllers\Backend\TrainingController;
use App\Http\Controllers\Backend\CalenderController;
use App\Http\Controllers\Backend\PolicyController;
use App\Http\Controllers\Backend\ClubController;
use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\UserProfileController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\WelfareController;
use App\Http\Controllers\Backend\EducationController;
use App\Http\Controllers\Backend\ChipCalenderController;
use App\Http\Controllers\Backend\RankController;
use App\Http\Controllers\Backend\VipGalleryController;
use App\Http\Controllers\Backend\UnitController;
use App\Models\Role;
use Laravel\Ui\Presets\React;

Route::get('/dashboard', DashboardController::class)->name('dashboard');
//Roles
Route::resource('/roles', RoleController::class);

//User
Route::resource('/users', UserController::class);
Route::resource('/profile', ProfileController::class);

//Backup
Route::resource('/backups', BackupController::class)->only(['index', 'store', 'destroy']);
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');

//Permission
Route::resource('/permissions', PermissionController::class);

//Modules
Route::resource('/modules', ModuleController::class);
//Application Setup
Route::resource('/area', AreaController::class);
Route::resource('/pages', PageController::class);
Route::resource('/sliders', SliderController::class);
Route::resource('/messages', MessageController::class);
Route::resource('/programs', ProgramController::class);
Route::resource('/events', EventController::class);
Route::resource('/page_contents', PageContentController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/products', ProductController::class);
Route::resource('/notices', NoticeController::class);
Route::resource('/gallery', GalleryController::class);
Route::resource('/leader', SobanetryController::class);
Route::resource('/showroome', ShowRoomeController::class);
Route::resource('/training', TrainingController::class);
Route::resource('/award', AwardController::class);
Route::resource('/calender', CalenderController::class);
Route::resource('/policy', PolicyController::class);
Route::resource('/clubs', ClubController::class);
Route::resource('/appointments', AppointmentController::class);
Route::resource('/publications', PublicationController::class);
Route::resource('/welfares', WelfareController::class);
Route::resource('/educations', EducationController::class);
Route::resource('/chipCalenders', ChipCalenderController::class);
Route::resource('/ranks', RankController::class);
Route::resource('/vipGallery', VipGalleryController::class);
Route::resource('/tutorial', TutorialController::class);
Route::resource('unit', UnitController::class);
Route::resource('blood-group', \App\Http\Controllers\LadiesClub\BloodGroupController::class);
Route::resource('course', \App\Http\Controllers\Backend\CourseController::class);
Route::resource('courseResult', \App\Http\Controllers\Backend\CourseResultController::class);
Route::resource('ladies-club-notice', \App\Http\Controllers\LadiesClub\LadiesClubNoticeController::class);
Route::resource('ladies-club-event', \App\Http\Controllers\LadiesClub\LadiesClubEventController::class);


Route::get('/footers', [FooterManagementController::class, 'index'])->name('footers.index');
Route::get('/footers/{id}', [FooterManagementController::class, 'footerEdit'])->name('footers.edit');
Route::post('/footers/{id}', [FooterManagementController::class, 'footerUpdate'])->name('footers.update');
Route::get('/socials', [SocialLinkController::class, 'index'])->name('socials.index');
Route::get('/socials/{id}', [SocialLinkController::class, 'edit'])->name('socials.edit');
Route::post('/socials/{id}', [SocialLinkController::class, 'update'])->name('socials.update');

//User Profile
Route::get('/userprofile', [UserProfileController::class, 'index'])->name('userprofile.index');
Route::get('/update-profile', [UserProfileController::class, 'getUpdate'])->name('userprofile.edit');
Route::post('/update-user-profile', [UserProfileController::class, 'getUpdateData'])->name('userprofile.update');

Route::get('/password-edit', [UserProfileController::class, 'passwordEdit'])->name('password.edit');
Route::post('/user-password-edit', [UserProfileController::class, 'passwordUpdate'])->name('password.update');
//Army Ladies  Club
Route::resource('/member-registration', \App\Http\Controllers\LadiesClub\MemberRegistration::class);
Route::post('/members-data', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'getMembersData'])->name('members.data');
Route::get('/member-view/{id}', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'MemberView'])->name('member.view');
Route::post('/update-id-card-no/{id}', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'idCardNoUpdate'])->name('member.idCardNoUpdate');
Route::post('/update-member-pass/{id}', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'updateMemberPassword'])->name('member.updateMemberPassword');
Route::get('admin-pay-management', [\App\Http\Controllers\LadiesClub\Backend\MemberPaymentManagementController::class, 'index'])->name('pay.index');
Route::get('pay-update/{id}', [\App\Http\Controllers\LadiesClub\Backend\MemberPaymentManagementController::class, 'paymentUpdate'])->name('pay.paymentUpdate');
Route::get('/device', [\App\Http\Controllers\LadiesClub\Backend\DeviceController::class, 'index'])->name('device.index');
Route::get('/device-create', [\App\Http\Controllers\LadiesClub\Backend\DeviceController::class, 'create'])->name('device.create');
Route::post('/device-create', [\App\Http\Controllers\LadiesClub\Backend\DeviceController::class, 'store'])->name('device.store');
Route::get('/device-update/{id}', [\App\Http\Controllers\LadiesClub\Backend\DeviceController::class, 'edit'])->name('device.edit');
Route::put('/device-update/{id}', [\App\Http\Controllers\LadiesClub\Backend\DeviceController::class, 'update'])->name('device.update');
Route::get('/user-assign-device/{id}', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'assignDeviceForm'])->name('user.assignDeviceForm');
Route::post('/user-assign-device/', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'assignDeviceSave'])->name('user.assignDeviceSave');
Route::get('/user-assign-device-list', [\App\Http\Controllers\LadiesClub\Report\UserAssignDeviceListController::class, 'index'])->name('user.device.list');
Route::post('/member_assign_device_search', [\App\Http\Controllers\LadiesClub\Report\UserAssignDeviceListController::class, 'sreachMemberDevice'])->name('user.device.search');


//Ladies Club Member Dashboard
Route::get('/member-dashboard', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'index'])->name('member.dashboard');
Route::get('/member-change-password', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberChangePassword'])->name('member.change_password');
Route::get('/member-profile', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberProfile'])->name('member.profile');
Route::get('/member-notice', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberNotice'])->name('member.notice');
Route::get('/member-notice-view/{id}', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberNoticeView'])->name('member.notice.view');
Route::get('/member-event', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberEvent'])->name('member.event');
Route::get('/member-event-view/{id}', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberEventView'])->name('member.event.view');
Route::post('/member-attend-event/{id}', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberAttendEvent'])->name('member.attend.event');
Route::get('/member-gallery', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberGallery'])->name('member.gallery');
Route::get('/member-payment', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberPayment'])->name('member.payment');
Route::get('/member-payBill', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'memberPayBill'])->name('member.payBill');
Route::post('/member-payBill', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'makePayment'])->name('member.makePayment');
Route::post('/member-change-password', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'updatePassword'])->name('member.updatePassword');
Route::get('/update-profile', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateProfile'])->name('member.updateProfile');
Route::post('/update-profile', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateSave'])->name('member.updateSave');
Route::get('/update-profile-picture', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateProfilePicture'])->name('member.updateProfile.picture');
Route::post('/update-profile-picture', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateProfilePictureSave'])->name('member.updateProfile.picture.save');

Route::get('/update-signature', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateSignature'])->name('update.signature');
Route::post('/update-signature', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateSignatureSave'])->name('save.signature');
Route::post('/update-signature', [\App\Http\Controllers\LadiesClub\Member\MemberDashboardController::class, 'uodateSignatureSave'])->name('save.signature');
Route::post('/submit-member-feedback', [\App\Http\Controllers\LadiesClub\MemberFeedbackController::class, 'store'])->name('feedback.store');

Route::get('id-card-front/{id}', [\App\Http\Controllers\LadiesClub\IDCard\IDCardPrintController::class, 'index'])->name('card.front');
Route::get('id-card-back/{id}', [\App\Http\Controllers\LadiesClub\IDCard\IDCardPrintController::class, 'idcardBack'])->name('card.back');
Route::get('attendance-report', [\App\Http\Controllers\LadiesClub\Report\AttendanceReportController::class, 'index'])->name('attendance.report.index');
Route::post('attendance-report', [\App\Http\Controllers\LadiesClub\Report\AttendanceReportController::class, 'attendanceSearch'])->name('attendance.report.search');


View::composer('ladiesClub.partials.left_sidebar', function ($view) {
    $member = \DB::table('users')->select('users.*')->where('users.id', Auth::user()->id)->first();
    $view->with('member', $member);
});

Route::get('/get-user-list', [SobanetryController::class, 'getUserList'])->name('get.user');
Route::get('send-sms', [\App\Http\Controllers\LadiesClub\SendEventSmsController::class, 'index'])->name('sendsms.index');
Route::get('/events-by-area/{area}', [\App\Http\Controllers\LadiesClub\SendEventSmsController::class, 'getEventsByArea'])->name('event.area');
Route::post('send-sms', [\App\Http\Controllers\LadiesClub\SendEventSmsController::class, 'sendSms'])->name('sendsms.send');
Route::get('event-member-list', [\App\Http\Controllers\LadiesClub\MemberEventAttendListController::class, 'index'])->name('eventMemberList.index');
Route::post('member-is-attended/{id}', [\App\Http\Controllers\LadiesClub\MemberEventAttendListController::class, 'isAttend'])->name('eventMemberList.is_attend');
Route::post('/event-member-list-search', [\App\Http\Controllers\LadiesClub\MemberEventAttendListController::class, 'sreachMemberWithCode'])->name('memberwithcode.search');
Route::get('event-member-attended-list', [\App\Http\Controllers\LadiesClub\MemberEventAttendListController::class, 'getAttendedMemberList'])->name('eventAttendedMemberList.list');
Route::post('event-member-attended-list-search', [\App\Http\Controllers\LadiesClub\MemberEventAttendListController::class, 'getAttendedMemberSearch'])->name('eventAttendedMemberList.search');
Route::get('in-person-sms', [\App\Http\Controllers\LadiesClub\SendEventSmsController::class, 'inPersonSMS'])->name('inPersonSms');
Route::post('in-person-sms', [\App\Http\Controllers\LadiesClub\SendEventSmsController::class, 'inPersonSMSSend'])->name('inPersonSms.send');
