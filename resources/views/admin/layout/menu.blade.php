@php($page = Request::segment(2))

@php ($user = Auth::guard('admin')->user())


<aside id="left-sidebar-nav">

    <ul id="slide-out" class="side-nav fixed leftside-navigation">

        <li class="user-details cyan darken-2">

            <div class="row">

                <div class="col col s4 m4 l4">

                    @if($user->gender == 'Male')
                    <img src="{{ Asset('images/male.png') }}" alt="" class="circle responsive-img valign profile-image">
                    @elseif($user->gender == 'Female')
                    <img src="{{ Asset('images/female.png') }}" alt="" class="circle responsive-img valign profile-image">
                    @endif


                </div>

                <div class="col col s8 m8 l8">

                    <ul id="profile-dropdown" class="dropdown-content">

                        <li><a href="{{ Asset(env('admin').'/setting') }}"><i class="mdi-action-settings" style="color: purple"></i> Settings</a></li>

                        <li><a href="{{ Asset(env('admin').'/logout') }}"><i class="mdi-hardware-keyboard-tab" style="color: purple"></i> Logout</a></li>

                    </ul>

                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">Welcome <i class="mdi-navigation-arrow-drop-down right"></i></a>

                    <p class="user-roal">{{ Auth::guard('admin')->user()->name }}</p>

                </div>

            </div>

        </li>



        <?php /*<li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/dashboard') }}" class="waves-effect waves-cyan"><i class="fa fa-dashboard" style="font-size:16px"></i> Dashboard</a></li>*/ ?>



        <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'dashboard' || $page == 'settings' || $page == 'fee-settings'){ ?> active <?php } ?>"><i class="fa fa-dashboard" style="color: purple"></i> Dashboard</a>

                    <div class="collapsible-body">

                        <ul>

                            <li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/dashboard') }}"><i class="fa fa-dashboard" style="font-size:16px; color: purple;"></i> Dashboard</a></li>

                            <li class="<?php if($page == "settings"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/settings') }}"><i class="fa fa-cog" style="font-size:16px; color: purple;"></i> Profile Settings</a></li>

        


                        </ul>

                    </div>

                </li>

            </ul>

        </li>


        <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page =='student' || $page == 'teacher'){ ?> active <?php } ?>"><i class="fa fa-users" style="color: purple;"></i> Manage Users</a>

                    <div class="collapsible-body">

                        <ul>

                            <li class="<?php if($page == "student"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/student') }}"><i class="fa fa-user" style="font-size:16px; color: purple;"></i> Student </a></li>

                            <li class="<?php if($page == "teacher"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/teacher') }}"><i class="fa fa-user" style="font-size:16px; color: purple; "></i> Teacher </a></li>

                        </ul>

                    </div>

                </li>

            </ul>

        </li>


           <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'student-task' || $page == 'teacher-task' || $page == 'task-requests' ||  $page == 'extend-requests' ){ ?> active <?php } ?>"><i class="fa fa-clipboard" style="color: purple;"></i> Manage Tasks </a>

                    <div class="collapsible-body">

                        <ul>

                             <li class="<?php if($page == "teacher-task"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/teacher-task') }}"><i class="fa fa-file-text-o" style="font-size:16px; color: purple;"></i> Teacher Tasks </a></li>

                            <li class="<?php if($page == "student-task"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/student-task') }}"><i class="fa fa-file-text-o" style="font-size:16px; color: purple;"></i> Student Tasks </a></li>


                            <li class="<?php if($page == "task-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/task-requests') }}"><i class="fa fa-check" style="font-size:16px; color: purple;"></i> Approve Requests </a></li>


                            <li class="<?php if($page == "extend-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/extend-requests') }}"><i class="fa fa-lightbulb-o" style="font-size:16px; color: purple;"></i> Extend Requests </a></li>



                        </ul>

                    </div>

                </li>

            </ul>

        </li>



         <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'g-task' || $page == 'g-task-requests' || $page == 'g-extend-requests' ){ ?> active <?php } ?>"><i class="fa fa-clone" style="color: purple;"></i> Global Tasks </a>

                    <div class="collapsible-body">

                        <ul>

                             <li class="<?php if($page == "g-task"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/g-task') }}"><i class="fa fa-file-text-o" style="font-size:16px; color: purple;"></i> Manage G-Tasks </a></li>


                            <li class="<?php if($page == "g-task-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/g-task-requests') }}"><i class="fa fa-check" style="font-size:16px; color: purple;"></i> Approve Requests </a></li>


                             <li class="<?php if($page == "g-extend-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/g-extend-requests') }}"><i class="fa fa-lightbulb-o" style="font-size:16px; color: purple;"></i> Extend Requests </a></li>



                        </ul>

                    </div>

                </li>

            </ul>

        </li>



      <li>
            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page =='student-reports' || $page == 'teacher-reports' || $page == 'reports-all'){ ?> active <?php } ?>"><i class="fa fa-bar-chart" style="color: purple;"></i> Check Reports</a>

                    <div class="collapsible-body">

                        <ul>

                            <li class="<?php if($page == "teacher-reports"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/teacher-reports') }}"><i class="fa fa-area-chart" style="font-size:16px; color: purple;"></i> Teacher Reports </a></li>

                            <li class="<?php if($page == "student-reports"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/student-reports') }}"><i class="fa fa-area-chart" style="font-size:16px; color: purple;"></i> Student Reports </a></li>


                             <li class="<?php if($page == "reports-all"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/reports-all') }}"><i class="fa fa-area-chart" style="font-size:16px; color: purple;"></i> All Reports </a></li>

                        </ul>

                    </div>

                </li>

            </ul>

        </li>



      
       

        <li><a href="{{ Asset(env('admin').'/logout') }}" class="waves-effect waves-cyan"><i class="fa fa-sign-out" style="font-size:16px; color: purple;"></i> Logout</a></li>

    </ul>



    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only purple"><i class="mdi-navigation-menu"></i></a>

</aside>