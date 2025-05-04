<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
            <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
            </span>
    </div>
    <div class="scrollbar-sidebar">
        <!-- Dropdown list-->
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <br>
                <li class="app-sidebar__heading"><a href="{{ route('app.dashboard') }}"
                                                    class="{{ Route::is('app.dashboard') ? 'mm-active' : ''}}"><i
                            class="metismenu-icon pe-7s-rocket"></i>Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">
                    <a href="#"><i class="metismenu-icon pe-7s-settings"></i>Access Control<i
                            class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @permission('role-index')
                        <li class="{{Request::is('app/roles*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/roles*') ? 'mm-active' : ''}}"
                               href="{{ route('app.roles.index') }}">
                                <i class="metismenu-icon pe-7s-check"></i>Role Management
                            </a>
                        </li>
                        @endpermission
                        @permission('permission-index')
                        <li class="{{ Request::is('app/permissions*') ? 'mm-active' : ''}}">
                            <a class="{{ Request::is('app/permissions*') ? 'mm-active' : ''}}"
                               href="{{ route('app.permissions.index') }}">
                                <i class="metismenu-icon pe-7s-cloud"></i>Permissions
                            </a>
                        </li>
                        @endpermission

                        @permission('module-index')
                        <li class="{{ Request::is('app/modules*') ? 'mm-active' : ''}}">
                            <a class="{{ Request::is('app/modules*') ? 'mm-active' : ''}}"
                               href="{{ route('app.modules.index') }}">
                                <i class="metismenu-icon pe-7s-cloud"></i>Modules
                            </a>
                        </li>
                        @endpermission

                        @permission('user-index')
                        <li class="{{ Request::is('app/users*') ? 'mm-active' : ''}}">
                            <a class="{{ Request::is('app/users*') ? 'mm-active' : ''}}"
                               href="{{ route('app.users.index') }}">
                                <i class="metismenu-icon pe-7s-users"></i>User Management
                            </a>
                        </li>
                        @endpermission

                        @permission('backup-index')
                        <li class="{{Request::is('app/backups*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/backups*') ? 'mm-active' : ''}}"
                               href="{{ route('app.backups.index') }}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Backups
                            </a>
                        </li>
                        @endpermission

                    </ul>
                </li>
                <li class="app-sidebar__heading">
                    <a href="#"><i class="metismenu-icon pe-7s-diamond"></i>Settings<i
                            class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @permission('appointment-index')
                        <li class="{{Request::is('app/blood-group*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/blood-group*') ? 'mm-active' : ''}}"
                               href="{{route('app.blood-group.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Blood Group
                            </a>
                        </li>
                        @endpermission
                        @permission('appointment-index')
                        <li class="{{Request::is('app/appointments*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/appointments*') ? 'mm-active' : ''}}"
                               href="{{route('app.appointments.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Appointment
                            </a>
                        </li>
                        @endpermission
                        @permission('area-index')
                        <li class="{{Request::is('app/area*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/area*') ? 'mm-active' : ''}}"
                               href="{{route('app.area.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Area
                            </a>
                        </li>
                        @endpermission
                        @permission('award-index')
                        <li class="{{Request::is('app/award*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/award*') ? 'mm-active' : ''}}"
                               href="{{route('app.award.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Award
                            </a>
                        </li>
                        @endpermission
                        @permission('club-index')
                        <li class="{{Request::is('app/clubs*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/clubs*') ? 'mm-active' : ''}}"
                               href="{{route('app.clubs.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Club
                            </a>
                        </li>
                        @endpermission
                        @permission('category-index')
                        <li class="{{Request::is('app/categories*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/categories*') ? 'mm-active' : ''}}"
                               href="{{route('app.categories.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Category
                            </a>
                        </li>
                        @endpermission
                        @permission('page-index')
                        <li class="{{Request::is('app/pages*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/pages*') ? 'mm-active' : ''}}"
                               href="{{route('app.pages.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Page
                            </a>
                        </li>
                        @endpermission

                        @permission('award-index')
                        <li class="{{Request::is('app/footers*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/footers*') ? 'mm-active' : ''}}"
                               href="{{ route('app.footers.index') }}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Footer Management
                            </a>
                        </li>
                        @endpermission
                        @permission('social-index')
                        <li class="{{Request::is('app/socials*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/socials*') ? 'mm-active' : ''}}"
                               href="{{ route('app.socials.index') }}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Social Link
                            </a>
                        </li>
                        @endpermission
                        @permission('rank-index')
                        <li class="{{Request::is('app/ranks*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/ranks*') ? 'mm-active' : ''}}"
                               href="{{ route('app.ranks.index') }}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Rank
                            </a>
                        </li>
                        @endpermission

                    </ul>
                </li>

                <li class="app-sidebar__heading">
                    <a href="#"><i class="metismenu-icon pe-7s-tools"></i>Application Setup<i
                            class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @permission('access-unit')
                        <li class="{{Request::is('app/unit*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/unit*') ? 'mm-active' : ''}}"
                               href="{{route('app.unit.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Unit
                            </a>
                        </li>
                        @endpermission
                        @permission('content-index')
                        <li class="{{Request::is('app/page_contents*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/page_contents*') ? 'mm-active' : ''}}"
                               href="{{route('app.page_contents.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Page Content
                            </a>
                        </li>
                        @endpermission
                        @permission('slider-index')
                        <li class="{{Request::is('app/sliders*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/sliders*') ? 'mm-active' : ''}}"
                               href="{{route('app.sliders.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Slider
                            </a>
                        </li>
                        @endpermission
                        @permission('message-index')
                        <li class="{{Request::is('app/messages*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/messages*') ? 'mm-active' : ''}}"
                               href="{{route('app.messages.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Messages
                            </a>
                        </li>
                        @endpermission
                        {{--                        @permission('program-index')--}}
                        {{--                        <li class="{{Request::is('app/programs*') ? 'mm-active' : ''}}">--}}
                        {{--                            <a class="{{Request::is('app/programs*') ? 'mm-active' : ''}}" href="{{route('app.programs.index')}}" class="">--}}
                        {{--                                <i class="metismenu-icon pe-7s-cloud"></i>Program--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        @endpermission--}}
                        @permission('training-index')
                        <li class="{{Request::is('app/training*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/training*') ? 'mm-active' : ''}}"
                               href="{{route('app.training.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Event
                            </a>
                        </li>
                        @endpermission
                        {{--                    @permission('event-index')--}}
                        {{--                    <li class="{{Request::is('app/events*') ? 'mm-active' : ''}}">--}}
                        {{--                        <a href="{{route('app.events.index')}}" class="">--}}
                        {{--                            <i class="metismenu-icon pe-7s-cloud"></i>Event(ইভেন্ট)--}}
                        {{--                        </a>--}}
                        {{--                    </li>--}}
                        {{--                    @endpermission--}}

                        @permission('product-index')
                        <li class="{{Request::is('app/products*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/products*') ? 'mm-active' : ''}}"
                               href="{{route('app.products.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Product
                            </a>
                        </li>
                        @endpermission

                        @permission('notice-index')
                        <li class="{{Request::is('app/notices*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/notices*') ? 'mm-active' : ''}}"
                               href="{{route('app.notices.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Notice
                            </a>
                        </li>
                        @endpermission
                        @permission('gallery-index')
                        <li class="{{Request::is('app/gallery*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/gallery*') ? 'mm-active' : ''}}"
                               href="{{route('app.gallery.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Gallery
                            </a>
                        </li>
                        @endpermission
                        @permission('leader-index')
                        <li class="{{Request::is('app/leader*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/leader*') ? 'mm-active' : ''}}"
                               href="{{route('app.leader.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Board Member
                            </a>
                        </li>
                        @endpermission
                        @permission('showroome-index')
                        <li class="{{Request::is('app/showroome*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/showroome*') ? 'mm-active' : ''}}"
                               href="{{route('app.showroome.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Show Room
                            </a>
                        </li>
                        @endpermission

                        @permission('calender-index')
                        <li class="{{Request::is('app/calender*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/calender*') ? 'mm-active' : ''}}"
                               href="{{route('app.calender.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Calender
                            </a>
                        </li>
                        @endpermission
                        @permission('policy-index')
                        <li class="{{Request::is('app/policy*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/policy*') ? 'mm-active' : ''}}"
                               href="{{route('app.policy.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Policy
                            </a>
                        </li>
                        @endpermission
                        @permission('publication-index')
                        <li class="{{Request::is('app/publications*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/publications*') ? 'mm-active' : ''}}"
                               href="{{route('app.publications.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Publication
                            </a>
                        </li>
                        @endpermission
                        @permission('welfare-index')
                        <li class="{{Request::is('app/welfares*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/welfares*') ? 'mm-active' : ''}}"
                               href="{{route('app.welfares.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Welfare activities
                            </a>
                        </li>
                        @endpermission

                        @permission('education-index')
                        <li class="{{Request::is('app/educations*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/educations*') ? 'mm-active' : ''}}"
                               href="{{route('app.educations.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Education activities
                            </a>
                        </li>
                        @endpermission

                        @permission('chif-calender-index')
                        <li class="{{Request::is('app/chipCalenders*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/chipCalenders*') ? 'mm-active' : ''}}"
                               href="{{route('app.chipCalenders.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Chif Calender
                            </a>
                        </li>
                        @endpermission

                        @permission('vipgallery-index')
                        <li class="{{Request::is('app/vipGallery*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/vipGallery*') ? 'mm-active' : ''}}"
                               href="{{route('app.vipGallery.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Important Gallery
                            </a>
                        </li>

                        @endpermission
                        @permission('tutorial-index')
                        <li class="{{Request::is('app/tutorial*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/tutorial*') ? 'mm-active' : ''}}"
                               href="{{route('app.tutorial.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Tutorial
                            </a>
                        </li>
                        @endpermission
                        @permission('course-index')
                        <li class="{{Request::is('app/course*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/course*') ? 'mm-active' : ''}}"
                               href="{{route('app.course.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Course
                            </a>
                        </li>
                        @endpermission
                        @permission('course-result-index')
                        <li class="{{Request::is('app/courseResult*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/courseResult*') ? 'mm-active' : ''}}"
                               href="{{route('app.courseResult.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Course Result
                            </a>
                        </li>
                        @endpermission
                    </ul>
                </li>

                <li class="app-sidebar__heading">
                    <a href="#"><i class="metismenu-icon pe-7s-tools"></i>Army Ladies Club<i
                            class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @permission('lcn-index')
                        <li class="{{Request::is('app/ladies-club-notice*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/ladies-club-notice*') ? 'mm-active' : ''}}"
                               href="{{route('app.ladies-club-notice.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Notice
                            </a>
                        </li>
                        @endpermission
                        @permission('lce-index')
                        <li class="{{Request::is('app/ladies-club-event*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/ladies-club-event*') ? 'mm-active' : ''}}"
                               href="{{route('app.ladies-club-event.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Event
                            </a>
                        </li>
                        @endpermission
                        @permission('lc-all-action')
                        <li class="{{Request::is('app/event-member-list*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/event-member-list*') ? 'mm-active' : ''}}"
                               href="{{route('app.eventMemberList.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Member Event Code
                            </a>
                        </li>
                        <li class="{{Request::is('app/event-member-attended-list*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/event-member-attended-list*') ? 'mm-active' : ''}}"
                               href="{{route('app.eventAttendedMemberList.list')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Attended Member List
                            </a>
                        </li>
                        <li class="{{Request::is('app/send-sms*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/send-sms*') ? 'mm-active' : ''}}"
                               href="{{route('app.sendsms.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Send Event SMS
                            </a>
                        </li>
                        @endpermission
                        @permission('lcm-index')
                        <li class="{{Request::is('app/member-registration*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/member-registration*') ? 'mm-active' : ''}}"
                               href="{{route('app.member-registration.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Members
                            </a>
                        </li>
                        @endpermission
                        @permission('lc-all-action')
                        <li class="{{Request::is('app/admin-pay-management*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/admin-pay-management*') ? 'mm-active' : ''}}"
                               href="{{route('app.pay.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Payment Management
                            </a>
                        </li>
                        <li class="{{Request::is('app/device*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/device*') ? 'mm-active' : ''}}"
                               href="{{route('app.device.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Device Management
                            </a>
                        </li>
                        <li class="{{Request::is('app/user-assign-device-list*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/user-assign-device-list*') ? 'mm-active' : ''}}"
                               href="{{route('app.user.device.list')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Member Assign Device
                            </a>
                        </li>
                        <li class="{{Request::is('app/attendance-report*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/attendance-report*') ? 'mm-active' : ''}}"
                               href="{{route('app.attendance.report.index')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Attendance Report
                            </a>
                        </li>
                        @endpermission
                        <li class="{{Request::is('app/in-person-sms*') ? 'mm-active' : ''}}">
                            <a class="{{Request::is('app/in-person-sms*') ? 'mm-active' : ''}}"
                               href="{{route('app.inPersonSms')}}" class="">
                                <i class="metismenu-icon pe-7s-cloud"></i>Single SMS
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!-- End Dropdown-->
        </div>
    </div>
    <!-- Example -->
    <!-- End -->
</div>

