

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-y:scroll !important;">
    <!-- Brand Logo -->
    <a href="{{ url('') }}" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GuruKailash</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('admin') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>

          </li>
          <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-calendar-check nav-icon"></i>
              <p>
                 Appointments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/appointments/') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Pending Appointments</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('/admin/appointments/reply') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>Replied Appointments</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="far fa-question-circle nav-icon"></i>
              <p>
                 AskQuestion
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
           
              <li class="nav-item">
                <a href="{{ route('ask_question.index') }}" class="nav-link">
                <i class="fas fa-question nav-icon"></i>
                  <p> View Ask Question</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('order_question.index') }}" class="nav-link">
                <i class="fas fa-question nav-icon"></i>
                  <p> Pending Question</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url( 'admin/order/question/delivery') }}" class="nav-link">
                <i class="fas fa-question nav-icon"></i>
                  <p> Deliverd Question</p>
                </a>
              </li>




            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">

               <i class="nav-icon fas fa-file"></i>
              <p>
                  Manage Contents
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="{{ route('page.index') }}" class="nav-link">
                <i class="fas fa-file-alt nav-icon"></i>
                  <p>View pages</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('media.index') }}" class="nav-link">
                <i class="fas fa-photo-video nav-icon"></i>
                  <p>View  Media</p>
                </a>
              </li>



             
               <li class="nav-item">
                <a href="{{ route('people.index') }}" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>View Testimonals</p>
                </a>
              </li>


               <li class="nav-item">
                <a href="{{ url('admin/all/newsletter') }}" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                  <p>News Letter</p>
                </a>
              </li>

           


                <li class="nav-item">
                <a href="{{ route('setting.index') }}" class="nav-link">
                <i class="fas fa-cogs nav-icon"></i>
                  <p>General Settings</p>
                </a>
              </li>

            </ul>
          </li>


        

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fas fa-shopping-cart nav-icon"></i>
                    <p>
                        Product section
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview nav-open">
                  

                    <li class="nav-item">
                        <a href="{{ route('subcategory.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Serice category</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('subundercategory.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Service products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="fas fa-cart-plus nav-icon"></i>

                        <p>Products</p>
                        </a>
                    </li>
                    
                      <li class="nav-item">
                        <a href="{{ url('/admin/product/review') }}" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>

                        <p>Review Products</p>
                        </a>
                    </li>


                  


                </ul>
            </li>
          

          

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Blog section
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview nav-open">
                    <li class="nav-item">
                        <a href="{{ route('blogcategory.index') }}" class="nav-link">
                        <i class="fas fa-edit nav-icon"></i>
                        <p>Category Blog</p>
                        </a>
                    </li>
                   <li class="nav-item">
                        <a href="{{ route('tag.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Tag Blog</p>
                        </a>
                    </li>

                     <li class="nav-item">
                        <a href="{{ route('blog.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Blogs</p>
                        </a>
                    </li> 
 



                </ul>
            </li>
          {{-- franchise ends here  --}}







          <li class="nav-item">
            <a href="#" class="nav-link">

             <i class="nav-icon fas fa-users-cog"></i>
              <p>
                 Manage Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>View users</p>
                </a>
              </li>
{{--
              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>View roles</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>View permission</p>
                </a>
              </li> --}}

            </ul>
          </li>


 <li class="nav-item">
            <a href="#" class="nav-link">

             <i class="nav-icon fas fa-address-card"></i>
              <p>
              Company Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('contactus.create') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Add </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('contactus.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item">
            <a href="#" class="nav-link">

            <i class="fas fa-cart-arrow-down nav-icon"></i>
              <p>
              Order Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ url('/admin/products/pending') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Pending Products </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/products/processing') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>Processing Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/products/completed') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>Completed Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('/admin/products/cancel') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Cancel Products</p>
                </a>
              </li>
            

              
            </ul>
          </li>






        
         
             <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="nav-icon fab fa-accusoft"></i>
              <p>
                 Seo
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('seo.create') }}" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                  <p>Add seo</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('seo.index') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>View seo</p>
                </a>
              </li>

            </ul>
          </li>

  <!--<li class="nav-item">-->
  <!--                      <a href="{{ url('/admin/clear-cache') }}" class="nav-link">-->
  <!--                      <i class="fas fa-broom nav-icon"></i>-->
  <!--                      <p>Clear Cache</p>-->
  <!--                      </a>-->
  <!--                  </li>-->
      

          <li class="nav-item">
            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-cogs"></i>
              <p>
                 Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">


              <li class="nav-item">
                <a href="{{ url('/admin/profile') }}" class="nav-link">
                <i class="fas fa-user-alt nav-icon"></i>
                  <p>My profiles</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{ url('/admin/profilechange') }}" class="nav-link">
                <i class="fas fa-eye nav-icon"></i>
                  <p>Change profiles</p>
                </a>
              </li>

                             <li class="nav-item">
                                   <a class="nav-link"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
              </li>

            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



