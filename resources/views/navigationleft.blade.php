<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="dashboard-menu">
                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="reports-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reports</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="attendance-report-menu"><a href="{{ url('attendancedetailsreport') }}">Attendance Details</a></li>
                    <li class="onlineadmissionapplicants-menu"><a href="{{ url('onlineadmissionapplicants') }}">Admission Applicants</a></li>
                    <!--<li class="examinationmarks_report-menu"><a href="examinationmarks_report.php">Students Marks</a></li>-->
                </ul>
            </li>
            <li class="boards-menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Board</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="onlineclass-menu"><a href="{{ url('onlineclassentry') }}">Online Class</a></li>
                    <li class="notice-menu"><a href="{{ url('noticeentry') }}">Notice & Assignment</a></li>
                    <li class="onlineaddmission-menu"><a href="{{ url('admissionform') }}">Admission Form</a></li>
                </ul>
            </li>

            <li class="admin-menu">
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Admin</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="program-menu"><a href="{{ url('programentry') }}">Program Entry</a></li>
                    <li class="subject-menu"><a href="{{ url('subjectentry') }}">Subject Entry</a></li>
                    <!--<li class="designation-menu"><a href="{{ url('designationentry') }}">Designation Entry</a></li>-->
                    <li class="teachers-menu"><a href="{{ url('teachersentry') }}">Teacher Entry</a></li>
                    <li class="students-menu"><a href="{{ url('studentsentry') }}">Student Entry</a></li>
                    <li class="year-menu"><a href="{{ url('yearentry') }}">Year Entry</a></li>
                    <li class="student_registration_by_semester-menu"><a href="{{ url('studentregistration') }}">Student Registration</a></li>
                    <li class="attendance-menu"><a href="{{ url('attendanceentry') }}">Attendance Entry</a></li>
                    <li class="examination-menu"><a href="{{ url('examinationentry') }}">Examination Entry</a></li>
                    <li class="examinationmarks-menu"><a href="{{ url('examinationmarksentry') }}">Examination Marks</a></li>
                    <li class="paymententry-menu"><a href="{{ url('paymententry') }}">Payment Entry</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>