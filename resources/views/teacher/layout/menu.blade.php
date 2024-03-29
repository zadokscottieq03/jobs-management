@php($page = Request::segment(2))
@php ($user = Auth::guard('teacher')->user())


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
                        <li><a href="{{ Asset(env('teacher').'/setting') }}" style="color: purple;"><i class="mdi-action-settings"></i> Settings</a></li>
                        <li><a href="{{ Asset(env('teacher').'/logout') }}" style="color: purple;"><i class="mdi-hardware-keyboard-tab"></i> Logout</a></li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">Welcome <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal">{{ Auth::guard('teacher')->user()->name }}</p>
                </div>
            </div>
        </li>

        <?php /*<li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/dashboard') }}" class="waves-effect waves-cyan"><i class="fa fa-dashboard" style="font-size:16px"></i> Dashboard</a></li>*/ ?>

        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'dashboard' || $page == 'settings'){ ?> active <?php } ?>"><i class="fa fa-dashboard" style="color: purple;"></i> Dashboard</a>
                    <div class="collapsible-body">
                        <ul>
                            <li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/dashboard') }}"><i class="fa fa-dashboard" style="font-size:16px; color: purple;"></i> Dashboard</a></li>
                            <li class="<?php if($page == "settings"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/settings') }}"><i class="fa fa-cog" style="font-size:16px; color: purple;"></i> Profile Settings</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>


          <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'student-task' || $page == 'g-task' ){ ?> active <?php } ?>"><i class="fa fa-clipboard" style="color: purple;"></i> Assign Tasks </a>

                    <div class="collapsible-body">

                        <ul>

                            <li class="<?php if($page == "student-task"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/student-task') }}"><i class="fa fa-file" style="font-size:16px; color: purple;"></i> Individual Tasks </a></li>


                            <li class="<?php if($page == "g-task"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/g-task') }}"><i class="fa fa-files-o" style="font-size:16px; color: purple;"></i> Global Tasks </a></li>


                        </ul>

                    </div>

                </li>

            </ul>

        </li>


        <li class="<?php if($page == "self-task"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/self-task') }}" class="waves-effect waves-cyan"><i class="fa fa-file-text" style="font-size:16px; color: purple;"></i> My Tasks </a></li>


        <li class="<?php if($page == "teacher-task"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/teacher-task') }}" class="waves-effect waves-cyan"><i class="fa fa-clipboard" style="font-size:16px; color: purple;"></i> Teacher Tasks </a></li>

        <li class="<?php if($page == "work-log"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/work-log') }}" class="waves-effect waves-cyan"><i class="fa fa-suitcase" style="font-size:16px; color: purple;"></i> Work Log </a></li>


        <li class="<?php if($page == "reports"){ echo "active"; } ?>"><a href="{{ Asset(env('teacher').'/reports') }}" class="waves-effect waves-cyan"><i class="fa fa-bar-chart " style="font-size:16px; color: purple;"></i> Reports </a></li>


        <li><a href="{{ Asset(env('teacher').'/logout') }}" class="waves-effect waves-cyan"><i class="fa fa-sign-out" style="font-size:16px; color: purple;"></i> Logout</a></li>
    </ul>

    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only purple"><i class="mdi-navigation-menu"></i></a>
</aside>