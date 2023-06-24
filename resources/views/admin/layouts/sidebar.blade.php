<div class="deznav">
    <div class="deznav-scroll" style="background-color:#B3ABAB47;">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{URL::to('superadmin/dashboard')}}" class="text-dark"><i class="flaticon-381-networking text-dark"></i> Dashboard</a>
            </li>
            
            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false" >
                    <i class="flaticon-381-user text-dark" ></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">                    
                    <li>
                        <a href="{{URL::to('superadmin/users-list')}}" class="text-dark">
                            <span class="ml-0"><i class="flaticon-381-user mr-2 text-dark" ></i> </span>
                            Users List
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/add-user')}}" class="text-dark">
                            <span class="ml-0"><i class="mdi mdi-account-plus mr-2 text-dark" ></i> </span>
                            Add User
                        </a>
                    </li>
                    <!--li><a href="{{URL::to('superadmin/upload-wp-users')}}">Upload WP Users</a></li-->
                           
                </ul>
            </li>
            <li>
                <a href="{{URL::to('superadmin/groups')}}" class="text-dark"><i class="fa fa-list text-dark" ></i> Groups</a>
            </li>
            <!--li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false" >
                    <i class="fa fa-users text-dark" ></i>
                    <span class="nav-text">Groups</span>
                </a>
                <ul aria-expanded="false">                    
                    <li>
                        <a href="{{URL::to('superadmin/groups')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-list mr-2 text-dark" ></i> </span>
                            Groups
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/groups/add')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-plus mr-2 text-dark" ></i> </span>
                            Add New Group
                        </a>
                    </li> 
                </ul>
            </li-->
            
            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false" >
                    <i class="flaticon-381-list text-dark" ></i>
                    <span class="nav-text">Memberships</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{URL::to('superadmin/memberships-list')}}" class="text-dark">
                            <span class="ml-0"><i class="flaticon-381-list mr-2 text-dark"></i> </span>Memberships
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/memberships/add')}}" class="text-dark">
                            <span class="ml-0"><i class="flaticon-381-plus mr-2 text-dark" ></i> </span>Add New Membership
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/subscriptions')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-list mr-2 text-dark" ></i> </span>Subscriptions
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/transactions')}}" class="text-dark">
                            <i class="fa fa-exchange text-dark" ></i> Transactions
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/membership/reports')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-bar-chart mr-2 text-dark" ></i> </span> Reports
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{URL::to('superadmin/membership/setting')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-gear mr-2 text-dark" ></i> </span>Settings
                        </a>
                    </li>
                </ul>
            </li>           
            
            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-briefcase text-dark" ></i>
                    <span class="nav-text">Jobs</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{URL::to('superadmin/jobs')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-briefcase text-dark" ></i></span> Jobs List
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/jobs/add-job')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-plus text-dark" ></i></span> Add New Jobs
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false" >
                    <i class="fa fa-download text-dark" ></i>
                    <span class="nav-text">Import</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{URL::to('superadmin/import-data')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-download mr-2 text-dark" ></i> </span>
                            Import
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-sticky-note-o text-dark" ></i>
                    <span class="nav-text">Helps</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{URL::to('superadmin/helps')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-list text-dark" ></i></span> Helps
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('/superadmin/help/categories')}}" class="text-dark">
                            <span class="ml-0"><i class="fa fa-tags text-dark" ></i></span> Help Category
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-envelope text-dark" ></i>
                    <span class="nav-text">Emails</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{URL::to('superadmin/memberships-emails')}}" class="text-dark">
                            <i class="fa fa-envelope text-dark" ></i> Memberships Emails
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/ninja-emails')}}" class="text-dark">
                            <i class="fa fa-envelope text-dark" ></i> Ninja Emails
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('superadmin/reminders-emails')}}" class="text-dark">
                            <i class="fa fa-envelope text-dark" ></i> Reminders
                        </a>
                    </li> 
                </ul>
            </li> 

            <li>
                <a class="has-arrow ai-icon text-dark" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-search text-dark" ></i>
                    <span class="nav-text">SEO</span>
                </a>
                <ul aria-expanded="false">
                    </li>
                        <a href="{{URL::to('superadmin/seo')}}" class="text-dark">
                            <i class="fa fa-list text-dark" ></i> SEO List
                        </a>
                    </li>
                    </li>
                        <a href="{{URL::to('superadmin/add-seo')}}" class="text-dark">
                            <i class="fa fa-plus text-dark" ></i> Add SEO
                        </a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="{{URL::to('superadmin/general-setting')}}" class="text-dark"><i class="flaticon-381-controls-3 text-dark" ></i> General Setting</a>
            </li> 
                       
        </ul>    
    </div>
</div>